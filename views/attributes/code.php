<?php
    include '../../database/security.php';

    //Add User
    if(isset($_POST['addBtn'])){

        $name = $_POST['attName'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM attributes WHERE attributeName='$name'";
        $name_query_run = mysqli_query($connection, $name_query);

        if(mysqli_num_rows($name_query_run) > 0)
        {
            $_SESSION['statusEmail'] = "Attribute already exists. Please try again.";
            header("Location: index.php?attributeexists");
        }else{
            if($name != '' && $status != ''){
                $query = "INSERT INTO attributes (attributeName, status) VALUES ('$name','$status')";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Attribute Added";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?addsuccess");
                }
                else{
                    $_SESSION['status'] = "Attribute Not Added";
                    $_SESSION['status_code'] = "error";
                    header("Location: index.php?addfailed");
                }
            }else{
                $_SESSION['status'] = "Attribute Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: index.php?addfailed");
            }

        }

    }

    // let edit user info display each of the edit user data
    if(isset($_POST['editBtn'])){
        $id = $_POST['edit_id'];
        $query = "SELECT * FROM attributes WHERE attributeId=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['editid'] = $id;
            header("Location: edit.php?attributeid={$id}");
        }else{
            header('Location: index.php?editfailed');
        }
    }

    //Update data
    if(isset($_POST['edit_btn'])){

        $id = $_POST['attid'];
        $name = $_POST['attName'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM attributes WHERE attributeName='$name' AND attributeId!='$id'";
        $name_query_run = mysqli_query($connection, $name_query);

        if(mysqli_num_rows($name_query_run) > 0)
        {
            $_SESSION['statusEmail'] = "Attribute already exists. Please try again.";
            header("Location: edit.php?attributeexists");
        }else{

            $query = "UPDATE attributes SET attributeName='$name', status='$status' WHERE attributeId='$id'";
            $query_run = mysqli_query($connection, $query);

            if($query_run){
                $_SESSION['status'] = "Sucessfully Updated";
                $_SESSION['status_code'] = "success";
                header('Location: index.php?update=success');
                unset($_SESSION['editid']);
            }else{
                $_SESSION['status'] = "Failed to Update";
                $_SESSION['status_code'] = "error";
                header('Location: index.php?update=fail');
            }
        }
    }

    //update status active to deactive
    if(isset($_POST['activate_submit'])){
        $id = $_POST['activate_id'];
        $query = "UPDATE attributes SET status='Deactivate' WHERE attributeId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: index.php?attributeid{$id}=deactivate");
        }else{

            header('Location: index.php?error=updatefailed');
        }
    }

    //update status deactive to active
    if(isset($_POST['deactivate_submit'])){
        $id = $_POST['deactivate_id'];
        $query = "UPDATE attributes SET status='Activate' WHERE attributeId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: index.php?attributeid{$id}=activate");
        }else{

            header('Location: index.php?error=updatefailed');
        }
    }

    //Delete data
    if(isset($_POST['delete_btn'])){

        $id = $_POST['deleteid'];

        $query = "DELETE FROM attributes WHERE attributeId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $queryDeleteValue = "DELETE FROM attributes_value WHERE parentId='$id'";
            $queryDeleteValue_run = mysqli_query($connection, $queryDeleteValue);
            if($queryDeleteValue_run){
                $_SESSION['status'] = "Successfully Deleted";
                $_SESSION['status_code'] = "success";
                header("Location: ../recycle/attributes.php?attributeid{$id}=deletesuccess");
            }else{
                $_SESSION['status'] = "Failed to Delete";
                $_SESSION['status_code'] = "error";
                header("Location: ../recycle/attributes.php?attributeid{$id}=deletefail");
            }
        }else{
            $_SESSION['status'] = "Failed to Delete";
            $_SESSION['status_code'] = "error";
            header("Location: ../recycle/attributes.php?attributeid{$id}=deletefail");
        }
    }

    // let attribute_value display each of the attribute data
    if(isset($_POST['addValueBtn'])){
        $id = $_POST['addvalue_id'];
        $query = "SELECT * From attributes;";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['attid'] = $id;
           header("Location:attribute_value.php?parentid={$id}");
        }else{

            header('Location: index.php?addfailed');
        }
    }

    if(isset($_POST["recycleBtn"])){
     $id = $_POST['deleteid'];
     $sta = "Inactive";
     $query = $connection -> prepare("UPDATE attributes SET status=? WHERE attributeId=?");
    $query -> bind_param("si", $sta, $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Moved";
        $_SESSION['status_code'] = "success";
        header("Location: index.php?movedsuccess");
    } else {
        $_SESSION['status'] = "Failed to Moved";
        $_SESSION['status_code'] = "error";
        header("Location: index.php?movedfail");
    }
    $query->close();
    $connection->close();
}

if(isset($_POST["recoverBtn"])){
     $id = $_POST['recover_id'];
     $sta = "Active";
     $query = $connection -> prepare("UPDATE attributes SET status=? WHERE attributeId=?");
    $query -> bind_param("si", $sta, $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Recovered";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/attributes.php?recoveredsuccess");
    } else {
        $_SESSION['status'] = "Failed to Recover";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/attributes.php?recoveredfail");
    }
    $query->close();
    $connection->close();
}

?>