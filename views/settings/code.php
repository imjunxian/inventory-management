<?php

include '../../database/security.php';

if (isset($_POST['editpass_btn'])){

    $id = $_POST['userid'];
    $oldpass = $_POST['oldpass'];
    $newpassword = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $newhpassword = password_hash($newpassword, PASSWORD_DEFAULT);

    if($newpassword != '' && $cpassword != '' && $newpassword == $cpassword && $oldpass != ''){
        //get current user password from database
        $query_pass = "SELECT userPassword FROM users WHERE userId='$id'";
        $result = mysqli_query($connection,$query_pass);

         while($row = mysqli_fetch_assoc($result)){ 

            $dbpass = $row['userPassword'];
            //current password must corrent then update
            if(password_verify($oldpass, $dbpass)){

                $query_newpass = "UPDATE users SET userPassword='$newhpassword' WHERE userId='$id'";
                $query_newpass_run = mysqli_query($connection, $query_newpass);

                if($query_newpass_run){
                    $_SESSION['status'] = "Sucessfully Updated";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?updatesuccess");
                }else{
                    $_SESSION['status'] = "Failed to Update";
                    $_SESSION['status_code'] = "error";
                    header("Location: editPassword.php?updatefail");
                }
            }else{
                $_SESSION['statusPassword'] = "Invalid Current Password. Please try again.";
                $_SESSION['status_code'] = "error";
                header("Location: editPassword.php?currentpasswordnotmatch");
            }
        }
    }

}

?>

<?php

if (isset($_POST['editprofile_btn'])){

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

    $email_query = "SELECT * FROM users WHERE userEmail='$email' AND userId != $id";
    $email_query_run = mysqli_query($connection, $email_query);

    $contact_query = "SELECT * FROM users WHERE userContact='$contact' AND userId != '$id'";
    $contact_query_run = mysqli_query($connection, $contact_query);



    if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['statusProfile'] = "Email already exists. Please try again.";
        $_SESSION['status_code'] = "error";
        header("Location: edit.php?emailexists");

    }else if(mysqli_num_rows($contact_query_run) > 0){
        $_SESSION['statusProfile'] = "Contact already exists. Please try again";
        $_SESSION['status_code'] = "error";
        header("Location: edit.php?emailexists");

    }else{

        $query = "UPDATE users SET userName='$username', userEmail='$email', userContact='$contact',
        userBirthDate='$dob', userGender='$gender' WHERE userId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){                       
            $_SESSION['status'] = "Profile Updated";
            $_SESSION['status_code'] = "success";
            header("Location: index.php?updatesuccess");

        }else{
            $_SESSION['status'] = "Failed to Update";
            $_SESSION['status_code'] = "error";
            header("Location: edit.php?updatefail");
        }

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
        }else{
            $_SESSION['status'] = "Failed to Update";
            $_SESSION['status_code'] = "error";
            header("Location: edit.php?updatefail");
        }

    }

}

//backup
if(isset($_POST["exportBtn"])){

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("d-m-Y_(H-i-s)");
    $indate = date("d M Y H:i:s");
    $file_name = 'Backup_' . $date . '.sql';
    $users = $_SESSION['user_id'];

    $dir = "../../database/backup/";
    $target_file = $dir . basename($file_name);

    $sql = "INSERT INTO backup(name, dateTime, users) VALUES ('$file_name', '$indate','$users')";
    $sql_run = mysqli_query($connection, $sql);

    //backup and download sql file
    $connect = new PDO("mysql:host=localhost;dbname=fyp", "root", "");
    $get_all_table_query = "SHOW TABLES";
    $statement = $connect->prepare($get_all_table_query);
    $statement->execute();
    $results = $statement->fetchAll();

     $output = '';
     foreach($results as $table){
      $output .= "\n\n" . "DROP TABLE " . $table["Tables_in_fyp"] . ";\n";
      $show_table_query = "SHOW CREATE TABLE " . $table["Tables_in_fyp"] . "";
      $statement = $connect->prepare($show_table_query);
      $statement->execute();
      $show_table_result = $statement->fetchAll();

      foreach($show_table_result as $show_table_row){
       $output .= "\n" . $show_table_row["Create Table"] . ";\n";
      }
      $select_query = "SELECT * FROM " . $table["Tables_in_fyp"] . "";
      $statement = $connect->prepare($select_query);
      $statement->execute();
      $total_row = $statement->rowCount();

      for($count=0; $count<$total_row; $count++){
       $single_result = $statement->fetch(PDO::FETCH_ASSOC);
       $table_column_array = array_keys($single_result);
       $table_value_array = array_values($single_result);
       $output .= "\nINSERT INTO ".$table['Tables_in_fyp']." (";
       $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
       $output .= "'" . implode("','", $table_value_array) . "');\n";
      }
     }
     
     $file_handle = fopen($file_name, 'w+');
     fwrite($file_handle, $output);
     fclose($file_handle);
     header('Content-Description: File Transfer');
     header('Content-Type: application/octet-stream');
     header('Content-Disposition: attachment; filename=' . basename($file_name));
     header('Content-Transfer-Encoding: binary');
     header('Expires: 0');
     header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_name));
    ob_clean();
    flush();
    file_put_contents($target_file, $output);
    readfile($file_name);
    unlink($file_name);

    /*if($sql_run){
        $_SESSION['successState'] = "Data Backup Successfully";   
    }else{
        $_SESSION['statusE'] = "Data Backup Failed";
    }*/
    if($sql_run){
        $_SESSION['status'] = "Backup Successfully";
        $_SESSION['status_code'] = "success";
        header("Location: backup.php?backupsuccess");  
    }else{
        $_SESSION['status'] = "Failed to Backup";
        $_SESSION['status_code'] = "error";
        header("Location: backup.php?backupfail");
    }

}

//Restore
if(isset($_POST["importBtn"])){

    $filename = $_FILES["importFile"]["name"];
    $target = "../../database/backup/".$filename."";
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'fyp';
    $maxRuntime = 15; // less then your max script execution limit

    $deadline = time()+$maxRuntime; 
    $progressFilename = $filename.'_filepointer'; // tmp file for progress
    $errorFilename = $filename.'_error'; // tmp file for erro

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass) OR die('connecting to host: '.$dbHost.' failed: '.mysql_error());
    mysqli_select_db($conn, $dbName) OR die('select db: '.$dbName.' failed: '.mysql_error());

    ($fp = fopen($target, 'r')) OR die('failed to open file:'.$filename);

    // check for previous error
    if( file_exists($errorFilename) ){
        die('<pre> previous error: '.file_get_contents($errorFilename));
    }

    // activate automatic reload in browser
    echo '<html><head> <meta http-equiv="refresh" content="'.($maxRuntime+2).'"><pre>';

    // go to previous file position
    $filePosition = 0;
    if( file_exists($progressFilename) ){
        $filePosition = file_get_contents($progressFilename);
        fseek($fp, $filePosition);
    }

    $queryCount = 0;
    $query = '';
    while( $deadline>time() AND ($line=fgets($fp, 1024000)) ){
        if(substr($line,0,2)=='--' OR trim($line)=='' ){
            continue;
        }

        $query .= $line;
        if( substr(trim($query),-1)==';' ){
            if( !mysqli_query($conn, $query) ){
                $error = 'Error performing query \'<strong>' . $query . '\': ' . mysql_error();
                file_put_contents($errorFilename, $error."\n");
                exit;
            }
            $query = '';
            file_put_contents($progressFilename, ftell($fp)); // save the current file position for 
            $queryCount++;
        }
    }

    /*if(feof($fp)){
        unlink($progressFilename);
        $_SESSION['successState'] = "Data Restore Successfully"; 
        header("Location: backup.php?restoresuccess");
    }else{
        $_SESSION['statusE'] = "Data Backup Failed";
        header("Location: backup.php?restorefailed");
    }*/
    if(feof($fp)){
        unlink($progressFilename);
        $_SESSION['status'] = "Restore Successfully";
        $_SESSION['status_code'] = "success";
        header("Location: backup.php?restoresuccess");  
    }else{
        $_SESSION['status'] = "Failed to Restore";
        $_SESSION['status_code'] = "error";
        header("Location: backup.php?restorefail");
    }
        
}


if(isset($_POST["delete_btn"])){
    $id = $_POST['deleteid'];
    $name = $_POST['filename'];
    $dir = "../../database/backup/";
    $target_file = $dir . basename($name);
    $query = $connection -> prepare("DELETE FROM backup WHERE backupId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        unlink($target_file);
        $_SESSION['status'] = "Successfully Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: backup.php?deletesuccess");
    } else {
        $_SESSION['status'] = "Failed to Delete";
        $_SESSION['status_code'] = "error";
        header("Location: backup.php?deletefail");
    }
    $query->close();
    $connection->close();
}

?>