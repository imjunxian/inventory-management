<?php
    include '../../database/security.php';

    //Add User
    if(isset($_POST['addBtn'])){

        $name = $_POST['categoryName'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM category WHERE categoryName='$name'";
        $name_query_run = mysqli_query($connection, $name_query);

        if(mysqli_num_rows($name_query_run) > 0)
        {
            $_SESSION['statusEmail'] = "Category already exists. Please try again.";;
            header("Location: index.php?categoryexists");
        }else{
            if($name != '' && $status != ''){
                $query = "INSERT INTO category (categoryName, categoryStatus) VALUES ('$name','$status')";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Category Added";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?addsuccess");
                }
                else{
                    $_SESSION['status'] = "Category Not Added";
                    $_SESSION['status_code'] = "error";
                    header("Location: index.php?addfailed");
                }
            }else{
                $_SESSION['status'] = "Category Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: index.php?addfailed");
            }

        }

    }

    // let edit user info display each of the edit user data
    if(isset($_POST['editBtn'])){
        $id = $_POST['edit_id'];
        $query = "SELECT * FROM category WHERE categoryId=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['editid'] = $id;
            header("Location: edit.php?categoryid={$id}");
        }else{
            header('Location: index.php?editfailed');
        }
    }

    //Update data
    if(isset($_POST['edit_btn'])){

        $id = $_POST['categoryid'];
        $name = $_POST['categoryName'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM category WHERE categoryName='$name' AND categoryId!='$id'";
        $name_query_run = mysqli_query($connection, $name_query);

        if(mysqli_num_rows($name_query_run) > 0)
        {
            $_SESSION['statusEmail'] = "Category already exists. Please try again";
            $_SESSION['status_code'] = "error";
            header("Location: edit.php?categoryexists");
        }else{
            $query = "UPDATE category SET categoryName='$name', categoryStatus='$status' WHERE categoryId='$id'";
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
        $query = "UPDATE category SET categoryStatus='Deactivate' WHERE categoryId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: index.php?categoryid{$id}=deactivate");
        }else{

            header('Location: index.php?error=updatefailed');
        }
    }

    //update status deactive to active
    if(isset($_POST['deactivate_submit'])){
        $id = $_POST['deactivate_id'];
        $query = "UPDATE category SET categoryStatus='Activate' WHERE categoryId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: index.php?categoryid{$id}=activate");
        }else{

            header('Location: index.php?error=updatefailed');
        }
    }

    //Delete data
    if(isset($_POST['delete_btn'])){

        $id = $_POST['deleteid'];

        //$query = "DELETE FROM category WHERE categoryId='$id'";
        //$query_run = mysqli_query($connection, $query);

        $query = $connection -> prepare("DELETE FROM category WHERE categoryId=?");
        $query -> bind_param("i", $id);
        $query->execute();

        if($query){
            $_SESSION['status'] = "Successfully Deleted";
            $_SESSION['status_code'] = "success";
            header("Location: ../recycle/category.php?categoryid{$id}=deletesuccess");
        }else{
            $_SESSION['status'] = "Failed to Delete";
            $_SESSION['status_code'] = "error";
            header("Location: ../recycle/category.php?categoryid{$id}=deletefail");
        }
        $query->close();
        $connection->close();
    }

    if(isset($_POST["recycleBtn"])){
     $id = $_POST['deleteid'];
     $sta = "Inactive";
     $query = $connection -> prepare("UPDATE category SET categoryStatus=? WHERE categoryId=?");
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
     $query = $connection -> prepare("UPDATE category SET categoryStatus=? WHERE categoryId=?");
    $query -> bind_param("si", $sta, $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Recovered";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/category.php?recoveredsuccess");
    } else {
        $_SESSION['status'] = "Failed to Recover";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/category.php?recoveredfail");
    }
    $query->close();
    $connection->close();
}

?>