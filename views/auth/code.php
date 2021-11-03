<?php
include '../../database/security.php';

//login code
if (isset($_POST['loginBtn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $rme = $_POST['rememberme'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $last = date('D H:i:s d/m/Y');

    $current = "Online";

    $stmt = $connection -> prepare("SELECT * FROM users WHERE userEmail = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if(!mysqli_num_rows($result) > 0){
        $_SESSION['status'] = 'Email Not Found. Please try again.';
        $_SESSION['loginEmail'] = $email;
        header('Location: ../auth/index.php?error=emailnotfound');
        exit();
    }

    while ($row = $result->fetch_assoc()) {

        $dbpass = $row['userPassword'];
        $status = $row['status'];

        if (password_verify($password, $dbpass)) {
            if($status == "Active"){
                if(isset($rme)){
                    setcookie('email', $email, time()+86400, '/');
                    setcookie('password', $password, time()+86400, '/');
                }
                if ($row['userRoles'] == "Admin" || $row['userRoles'] == "Staff" || $row['userRoles'] == "SuperUser") {
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_onoff'] = "Online";
                    $_SESSION['user_id'] = $row['userId'];
                    $_SESSION['user_name'] = $row['userName'];
                    $_SESSION['user_role'] = $row['userRoles'];
                    $_SESSION['company'] = $row['companyId'];
                    $_SESSION['welcome'] = "Welcome Back, ".$row['userName']."";
                    $_SESSION['timeout'] = time();
                    $lastLogin = $connection -> prepare("UPDATE users SET lastLogin=?, currentStatus=? WHERE userEmail = ?");
                    $lastLogin->bind_param('sss', $last, $current ,$email);
                    $lastLogin->execute();
                    header('Location: ../dashboard/index.php?login='.$row["userRoles"]);
                } else {
                    $_SESSION['status'] = 'Role Not Found. Please try again.';
                    $_SESSION['loginEmail'] = $email;
                    header('Location: ../auth/index.php?invalidroles');
                }
            }else if($status == "Banned"){
                $_SESSION['status'] = 'Account Banned. Please contact admin.';
                $_SESSION['loginEmail'] = $email;
                header('Location: ../auth/index.php?error=accbanned');
                exit();
            }else if($status == "Closed"){
                $_SESSION['status'] = 'Account Closed. Please contact admin.';
                $_SESSION['loginEmail'] = $email;
                header('Location: ../auth/index.php?error=accclosed');
                exit();
            }
        } else {
            $_SESSION['status'] = 'Invalid Password. Please try again.';
            $_SESSION['loginEmail'] = $email;
            header('Location: ../auth/index.php?error=invalidpassword');
            exit();
        }
    }
    $stmt->close();
    $connection->close();
}


//Logout
if (isset($_POST['logout_btn'])) {

    $current = "Offline";
    $email = $_SESSION["user_email"];

    $lastLogin = $connection -> prepare("UPDATE users SET currentStatus=? WHERE userEmail = ?");
    $lastLogin->bind_param('ss', $current ,$email);
    $lastLogin->execute();

    unset($_SESSION['user_id']);   //user id
    unset($_SESSION['user_email']); //user email
    unset($_SESSION['user_name']);  //user name
    unset($_SESSION['loginEmail']); // login keep login unchanged
    unset($_SESSION['user_role']); // user role for admin or staff
    unset($_SESSION['attid']); // for attribute_value parent id
    unset($_SESSION['editid']); // for edit id session
    unset($_SESSION['timeout']);
    unset($_SESSION['company']);
    unset($_SESSION['user_onoff']);
    session_unset();
    session_destroy();

    header("Location: index.php?logout=success");
    $lastLogin->close();
    $connection->close();
}



//Send Email
function send_email($email_sent,$url){
    $subject = "Reset Password";
    $message = "";
    if(file_exists("email.php")){
        $message = file_get_contents('email.php');
        $parts_to_mod = array("url");
        $replace_with = array($url);
        for($i=0; $i<count($parts_to_mod); $i++){
            $message = str_replace($parts_to_mod[$i], $replace_with[$i], $message);
        }
    }else{
        $message = "Something Wrong. Please try again.";
    }
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // More headers
    $headers .= 'From: noreply<noreply@gmail.com>' . "\r\n";
    $headers .= "To: <".$email_sent.">\r\n";
    $header .= "Reply-To: noreply@gmail.com\r\n";

    mail($email_sent,$subject,$message,$headers);
}



//send email button click
if (isset($_POST['sendBtn'])) {

    //token
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $email = $_POST['email'];
    $url = "http://localhost:8080/inv/views/auth/resetPassword.php?selector=".$selector."&validator=".bin2hex($token)."&email=".$email;
    $expires = date("U") + 1800; // 30 minutes will be expired

    $stmt = $connection -> prepare("SELECT * FROM users WHERE userEmail = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    //$query = "SELECT * FROM users WHERE userEmail = '$email' LIMIT 1";
    //$query_run = mysqli_query($connection, $query);

    if(!mysqli_num_rows($result) > 0){
        $_SESSION['sendStatus'] = 'Email Not Found. Please try again.';
        $_SESSION['sendEmail'] = $email;
        header('Location: ../auth/forgetPassword.php?error=emailnotfound');
        exit();
    }

    while ($row = $result -> fetch_assoc()) {
        $status = $row['status'];

        if($status != "Active"){
            $_SESSION['sendStatus'] = 'Account Banned. Please contact admin.';
            $_SESSION['sendEmail'] = $email;
            header('Location: ../auth/forgetPassword.php?error=accbanned');
            exit();
        }else{

            $sql = "DELETE FROM password_reset WHERE email = ?;";
            $sql_stmt = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($sql_stmt, $sql)){
                $_SESSION['sendStatus'] = 'Error';
                header('Location: ../auth/forgetPassword.php?error');
                exit();
            }else{
                mysqli_stmt_bind_param($sql_stmt, "s", $email);
                mysqli_stmt_execute($sql_stmt);
            }

            $sql_in = "INSERT INTO password_reset (email, selector, token, expires) VALUES (?,?,?,?);";
            $sql_in_stmt = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($sql_in_stmt, $sql_in)){
                $_SESSION['sendStatus'] = 'Error';
                header('Location: ../auth/forgetPassword.php?error');
                exit();
            }else{
                $hashToken = password_hash($token, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($sql_in_stmt, "ssss", $email, $selector, $hashToken, $expires);
                mysqli_stmt_execute($sql_in_stmt);
            }

            mysqli_stmt_close($sql_in_stmt);
            mysqli_close($connection);

            //weired condition
            if(send_email($email, $url)){
                $_SESSION['sendStatus'] = 'Email has been failed to send.';
                $_SESSION['sendEmail'] = $email;
                header('Location: ../auth/forgetPassword.php?sendfailed');
            }else{
                //email sent notification
                $_SESSION['sendsuccessStatus'] = 'Email has been sent to '.$email.'';
                $_SESSION['sendEmail'] = $email;
                header('Location: ../auth/forgetPassword.php?sendsuccess');
            }
        }
    }

    $stmt->close();
    $connection->close();

}


//Reset Password
//get token
//select pass reset table to get token to compare
//if expired , delete row
//update user password where email = password reset email
if(isset($_POST['resetPasswordBtn'])){

    $email = $_POST["email"];
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $newpassword = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $newhpassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $currentDate = date("U");

    $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";

    if($newpassword == ''){
        $_SESSION['status'] = "Password cannot be empty";
        header("Location: resetPassword.php?selector={$selector}&validator={$validator}&email={$email}");
    }else if($cpassword == ''){
        $_SESSION['status'] = "Please confirm your password";
        header("Location: resetPassword.php?selector={$selector}&validator={$validator}&email={$email}");
    }else if((preg_match($pattern, $newpassword)) && (preg_match($pattern, $cpassword))){
        $_SESSION['status'] = "Password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter";
        header("Location: resetPassword.php?selector={$selector}&validator={$validator}&email={$email}");
    }else if($newpassword != $cpassword){
        $_SESSION['status'] = "Password not match";
        header("Location: resetPassword.php?selector={$selector}&validator={$validator}&email={$email}");
    }else if($newpassword != '' && $cpassword != '' && $newpassword == $cpassword){

        $stmt = $connection -> prepare("SELECT * FROM password_reset WHERE selector=?");
        $stmt->bind_param('s', $selector);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $token = $row["token"];
            $tokenBin = hex2bin($validator);
            $exp = $row["expires"];
            $email = $row["email"];

            if($currentDate >= $exp){
                $query_del = $connection -> prepare("DELETE FROM password_reset WHERE email = ?");
                $query_del->bind_param('s', $email);
                $query_del->execute();
                header("Location: ../error/404.php");

            }else if($currentDate < $exp){
                if(password_verify($tokenBin, $token)){
                    $query_newpass = $connection -> prepare("UPDATE users SET userPassword=? WHERE userEmail=?");
                    $query_newpass->bind_param('ss', $newhpassword, $email);
                    $query_newpass->execute();

                    $query_dele = $connection -> prepare("DELETE FROM password_reset WHERE email=?");
                    $query_dele->bind_param('s', $email);
                    $query_dele->execute();

                    if($query_newpass && $query_dele){
                        $_SESSION['successStatus'] = "Password Updated Successfully.";
                        header("Location: index.php?passwordupdated");
                    }else{
                        $_SESSION['status'] = "Failed to Reset";
                        header("Location: resetPassword.php?resetfailed");
                    }

                }else{
                    $_SESSION['status'] = "Something went wrong.";
                    header("Location: resetPassword.php?error");
                }
            }else{
                header("Location: ../error/404.php");
            }
        }
    }else{
        header("Location: ../error/404.php");
    }

}


?>
