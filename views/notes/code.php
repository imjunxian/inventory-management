<?php
    include '../../database/security.php';

     //Add
    if(isset($_POST['addBtn'])){

        $id = $_SESSION['user_id'];
        $title = $_POST['title'];
        $desc = $_POST["desc"];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('D, d M Y, H:i:s');

        if($title == ''){
            $_SESSION['statusEmail'] = "Title is required";
            header("Location: index.php?addfailed");
        }elseif($desc == ''){
            $_SESSION['statusEmail'] = "Desciption is required";
            header("Location: index.php?addfailed");
        }else{
            $query_notes = $connection -> prepare("INSERT INTO notes(title, description, userId, date) VALUES (?,?,?,?)");
            $query_notes -> bind_param("ssis", $title, $desc, $id, $date);
            $query_notes ->execute();
            /*$query = "INSERT INTO notes(title, description, userId) VALUES ('$title', '$desc', '$id')";
            $query_run = mysqli_query($connection, $query);*/

            if($query_notes){
                $_SESSION['statusSuccess'] = "Note Added Successfully";
                header("Location: index.php?addsuccess");
            }
            else{
                $_SESSION['statusEmail'] = "Note Added Fail";
                header("Location: index.php?addfailed");
            }
        }
        $query_notes->close();
        $connection->close();
    }


//Update Notes
    if(isset($_POST["updateBtn"])){

        $id = $_POST['upnoteid'];
        $title = $_POST['uptitle'];
        $desc = $_POST["updesc"];

        if($title == ''){
            $_SESSION['statusEmail'] = "Title is required";
            header("Location: index.php?editfailed");
        }elseif($desc == ''){
            $_SESSION['statusEmail'] = "Desciption is required";
            header("Location: index.php?editfailed");
        }else{
            $query_notes = $connection -> prepare("UPDATE notes SET title=?, description=? WHERE Id=?");
            $query_notes -> bind_param("ssi", $title, $desc, $id);
            $query_notes ->execute();
            /*$query = "INSERT INTO notes(title, description, userId) VALUES ('$title', '$desc', '$id')";
            $query_run = mysqli_query($connection, $query);*/

            if($query_notes){
                $_SESSION['statusSuccess'] = "Note Updated Successfully";
                header("Location: index.php?editsuccess");
            }
            else{
                $_SESSION['statusEmail'] = "Note Updated Fail";
                header("Location: index.php?editfailed");
            }
        }
        $query_notes->close();
        $connection->close();
    }



    //Delete data
if (isset($_POST['delete_btn'])) {

    $id = $_POST['deleteid'];

    $query = $connection -> prepare("DELETE FROM notes WHERE Id=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['statusSuccess'] = "Note Deleted Successfully";
        header("Location: index.php?deletedsuccess");
    } else {
       $_SESSION['statusEmail'] = "Note Deleted Fail";
        header("Location: index.php?addfailed");
    }
    $query->close();
    $connection->close();
}

?>