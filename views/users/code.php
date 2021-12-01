<?php
include '../../database/security.php';
//Add User
if (isset($_POST['addUserBtn'])) {

    $image = $_POST["profile_image"];
    $img = $_FILES["profile_image"]["name"];
    $storeName = $_FILES["profile_image"]["tmp_name"];
    $dir = "../../dist/img/profile/";
    $target_file = $dir . basename($img);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $error = $_FILES["profile_image"]["error"];
    $exist = file_exists($target_file);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $status = "Active";
    $onoff = "Offline";
    //encrypt password then store it to database
    $hpassword = password_hash($password, PASSWORD_DEFAULT);

    $email_query = "SELECT * FROM users WHERE userEmail='$email'";
    $email_query_run = mysqli_query($connection, $email_query);

    $contact_query = "SELECT * FROM users WHERE userContact='$contact'";
    $contact_query_run = mysqli_query($connection, $contact_query);

    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['statusEmail'] = "Email Already Taken. Please try again.";
        header("Location: add.php?emailexists");
    } elseif (mysqli_num_rows($contact_query_run) > 0) {
        $_SESSION['statusEmail'] = "Phone Number already exists. Please try again.";
        header("Location: add.php?contactexists");
    } else {
        /*if ($username=='' && $email=='' && $password == '' && $cpassword == '' && $dob =='' && $contact == '' && $gender =='' && $role == '') {
            $_SESSION['status'] = "Please don't leave em";
            $_SESSION['status_code'] = "warning";
            header("Location: add.php?error=empty");
        }*/
        if ($username=='') {
            $_SESSION['statusEmail'] = "Username Cannot Be Empty";
            header("Location: add.php?error=empty");
        } else if ($email == ''){
            $_SESSION['statusEmail'] = "Email Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($dob == ''){
            $_SESSION['statusEmail'] = "Date of Birth Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($contact == ''){
            $_SESSION['statusEmail'] = "Contact Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($gender == ''){
            $_SESSION['statusEmail'] = "Gender Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($role == ''){
            $_SESSION['statusEmail'] = "Role Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($password == ''){
            $_SESSION['statusEmail'] = "Password Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($cpassword == ''){
            $_SESSION['statusEmail'] = "Please Confirm Your Password";
            header("Location: add.php?error=empty");
        }
        else if($password !== $cpassword){
            $_SESSION['statusEmail'] = "Password and Confirm Password Does Not Match";
            header("Location: add.php?passwordnotmatch");
        } else {
            $query = "INSERT INTO users (userName,userEmail,userContact,userGender,userBirthDate,userRoles,userPassword,status,currentStatus,profileImg)
                VALUES ('$username','$email','$contact','$gender','$dob','$role','$hpassword','$status', '$onoff','$img')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                move_uploaded_file($storeName, $target_file);
                $_SESSION['status'] = "User Added";
                $_SESSION['status_code'] = "success";
                header("Location: index.php?addsuccess");
            } else {
                $_SESSION['status'] = "User Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: add.php?addfailed");
            }
        }
    }

}

// let view user info display each of the view user data
if (isset($_POST['viewBtn'])) {
    $id = $_POST['view_id'];
    $query = "SELECT * From users WHERE userId=$id";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['viewid'] = $id;
        header("Location:detail.php?userid={$id}");
    } else {
        header('Location: index.php?viewfailed');
    }
}

// let edit user info display each of the edit user data
if (isset($_POST['editBtn'])) {
    $id = $_POST['edit_id'];
    $query = "SELECT * From users WHERE userId=$id";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['editid'] = $id;
        header("Location:edit.php?userid={$id}");
    } else {
        header('Location: index.php?editfailed');
    }
}

//Update data
if (isset($_POST['edituser_btn'])) {

    $image = $_POST["profile_image"];
    $img = $_FILES["profile_image"]["name"];
    $storeName = $_FILES["profile_image"]["tmp_name"];
    $dir = "../../dist/img/profile/";
    $target_file = $dir . basename($img);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $error = $_FILES["profile_image"]["error"];
    $exist = file_exists($target_file);

    $id = $_POST['userid'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $status=$_POST['status'];
    
    $oldpass = $_POST['oldpass'];
    $newpassword = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $newhpassword = password_hash($newpassword, PASSWORD_DEFAULT);

    $email_query = "SELECT * FROM users WHERE userEmail='$email' AND userId != '$id'";
    $email_query_run = mysqli_query($connection, $email_query);

    $contact_query = "SELECT * FROM users WHERE userContact='$contact' AND userId != '$id'";
    $contact_query_run = mysqli_query($connection, $contact_query);

    if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['statusEmail'] = "Email already exists. Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: edit.php?emailexists");

    }else if(mysqli_num_rows($contact_query_run) > 0){
        $_SESSION['statusEmail'] = "Contact already exists. Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: edit.php?contactexists");

    }else{

        if ($username=='') {
            $_SESSION['statusEmail'] = "Username Cannot Be Empty";
            header("Location: add.php?error=empty");
        } else if ($email == ''){
            $_SESSION['statusEmail'] = "Email Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($dob == ''){
            $_SESSION['statusEmail'] = "Date of Birth Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($contact == ''){
            $_SESSION['statusEmail'] = "Contact Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($gender == ''){
            $_SESSION['statusEmail'] = "Gender Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else if ($role == ''){
            $_SESSION['statusEmail'] = "Role Cannot Be Empty";
            header("Location: add.php?error=empty");
        }else{
            $query = "UPDATE users SET userName='$username', userEmail='$email', userContact='$contact',
                userBirthDate='$dob', userGender='$gender', userRoles='$role', status='$status' WHERE userId='$id'";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['status'] = "Sucessfully Updated";
                $_SESSION['status_code'] = "success";
                header("Location: index.php?userid{$id}=updatesuccess");
                 unset($_SESSION['editid']);
            } else {
                $_SESSION['status'] = "Failed to Update";
                $_SESSION['status_code'] = "error";
                header("Location: edit.php?userid{$id}=updatefail");
            }
        }
    }    

    //edit password only if fill in password and confirm password
    if ($newpassword != '' && $cpassword != '' && $newpassword == $cpassword && $oldpass != '' ) {

        $query_pass = "SELECT userPassword FROM users WHERE userId='$id'";
        $result = mysqli_query($connection,$query_pass);

         while($row = mysqli_fetch_assoc($result)){

            $dbpass = $row['userPassword'];

            if(!password_verify($oldpass, $dbpass)){
                $_SESSION['status'] = "Invalid Current Password";
                 $_SESSION['status_code'] = "error";
                $_SESSION['editid'] = $id;
                header("Location: edit.php?userid{$id}=currentpasswordnotmatch");  
            }else{
                $query_newpass = "UPDATE users SET userPassword='$newhpassword' WHERE userId='$id'";
                $query_newpass_run = mysqli_query($connection, $query_newpass);
                if ($query_newpass_run) {
                    $_SESSION['status'] = "Sucessfully Updated";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?userid{$id}=updatesuccess");
                    unset($_SESSION['editid']);
                } else {
                    $_SESSION['status'] = "Failed to Update";
                    $_SESSION['status_code'] = "error";
                    header("Location: edit.php?userid{$id}=updatefail");
                }
            }
            
        }
    }elseif(($oldpass != '' && $newpassword == '' && $cpassword == '') || ($oldpass == '' && $newpassword != '' && $cpassword != '')){
        $_SESSION['status'] = "Failed to Change Password";
         $_SESSION['status_code'] = "error";
        $_SESSION['editid'] = $id;
        header("Location: edit.php?userid{$id}=changepasswordfailed");
    }

    if($img != null){
        $query_pro = "UPDATE users SET profileImg='$img' WHERE userId='$id'";
        $query_pro_run = mysqli_query($connection, $query_pro);

        if($query_pro_run){
            unlink($target_file);
            move_uploaded_file($storeName, $target_file);
            $_SESSION['status'] = "Profile Updated";
            $_SESSION['status_code'] = "success";
            header("Location: index.php?updatesuccess");
             unset($_SESSION['editid']);
        }else{
            $_SESSION['status'] = "Failed to Update";
            $_SESSION['status_code'] = "error";
            $_SESSION['editid'] = $id;
            header("Location: edit.php?updatefail");
        }

    }
}



//Delete data
if (isset($_POST['delete_btn'])) {

    $id = $_POST['deleteid'];

    //$query = "DELETE FROM users WHERE userId='$id'";
    //$query_run = mysqli_query($connection, $query);
    $query = $connection -> prepare("DELETE FROM users WHERE userId=? AND status='Closed'");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/users.php?deletesuccess");
    } else {
        $_SESSION['status'] = "Failed to Delete";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/users.php?deletefail");
    }
    $query->close();
    $connection->close();
}

if(isset($_POST["recycleBtn"])){
     $id = $_POST['deleteid'];
     $query = $connection -> prepare("UPDATE users SET status='Closed' WHERE userId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Closed";
        $_SESSION['status_code'] = "success";
        header("Location: index.php?movedsuccess");
    } else {
        $_SESSION['status'] = "Failed to Closed";
        $_SESSION['status_code'] = "error";
        header("Location: index.php?movedfail");
    }
    $query->close();
    $connection->close();
}

if(isset($_POST["recoverBtn"])){
     $id = $_POST['recover_id'];
     $query = $connection -> prepare("UPDATE users SET status='Active' WHERE userId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Recovered";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/users.php?recoveredsuccess");
    } else {
        $_SESSION['status'] = "Failed to Recover";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/users.php?recoveredfail");
    }
    $query->close();
    $connection->close();
}

/*if(isset($_POST["onBtn"])){
    $id = $_SESSION['user_id'];
    $current = "Offline";
     $query = $connection -> prepare("UPDATE users SET currentStatus=? WHERE userId=?");
    $query -> bind_param("si",$current, $id);
    $query->execute();

    if ($query) {

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $query->close();
    $connection->close();
}

if(isset($_POST["offBtn"])){
    $id = $_SESSION['user_id'];
    $current = "Online";
    $query = $connection -> prepare("UPDATE users SET currentStatus=? WHERE userId=?");
    $query -> bind_param("si", $current, $id);
    $query->execute();

    if ($query) {

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $query->close();
    $connection->close();
}*/





     /*//on edit user only can change user detail after the user input valid password
        $query_pass = "SELECT userPassword FROM users WHERE userId='$id'";
        $result = mysqli_query($connection,$query_pass);

        $query_admin = "SELECT userPassword FROM users WHERE userRoles='Admin'";
        $result_admin = mysqli_query($connection,$query_admin);

        //get admin password, admin or user himself have permission to update user profile
        while ($admin = mysqli_fetch_array($result_admin)){
            $adminPass = $admin['userPassword'];
            //decrypt password then compare the decrypted password with user or admin password (line 103)
            //$dehash = password_verify($password, $adminPass) -> forget liao google search
        }

        //get password from users table on database
        while($row = mysqli_fetch_assoc($result)){
            $dbpass = $row['userPassword'];

            //compare the password with the user's input password OR the password is admin password
            if($dbpass == $password && $dbpass == $cpassword || $adminPass == $password && $adminPass == $cpassword){

                //for others, category,suppliers direct start from here
                $query = "UPDATE users SET userName='$username', userEmail='$email', userContact='$contact',
                userBirthDate='$dob', userGender='$gender', userRoles='$role' WHERE userId='$id'";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Sucessfully Updated";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?userid{$id}=updatesuccess");

                }else{
                    $_SESSION['status'] = "Failed to Update";
                    $_SESSION['status_code'] = "error";
                    header("Location: edit.php?userid{$id}=updatefail");
                }
            }else{
                $_SESSION['status'] = "Invalid Password";
                $_SESSION['status_code'] = "error";
                header("Location: edit.php?userid{$id}=invalidpassword");
            }
        }*/
