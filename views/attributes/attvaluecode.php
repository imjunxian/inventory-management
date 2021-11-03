<?php
    include '../../database/security.php';

    //Add
    if(isset($_POST['addBtn'])){

        $id = $_POST['parentid'];
        $name = $_POST['attvalueName'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM attributes_value WHERE attvalueName='$name'";
        $name_query_run = mysqli_query($connection, $name_query);

        if(mysqli_num_rows($name_query_run) > 0)
        {
            $_SESSION['statusEmail'] = "Attribute value already exists";
            header("Location: attribute_value.php?attributevalueexists");
        }else{
            if($name != '' && $status != ''){
                $query = "INSERT INTO attributes_value (attvalueName, parentId, status) VALUES ('$name', '$id', '$status')";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Attribute Value Added";
                    $_SESSION['status_code'] = "success";
                    header("Location: attribute_value.php?addsuccess");
                }
                else{
                    $_SESSION['status'] = "Attribute Value Not Added";
                    $_SESSION['status_code'] = "error";
                    header("Location: attribute_value.php?addfailed");
                }
            }else{
                $_SESSION['status'] = "Attribute Value Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: attribute_value.php?addfailed");
            }

        }

    }

    // let edit user info display each of the edit user data
    if(isset($_POST['editBtn'])){
        $id = $_POST['edit_id'];
        $query = "SELECT * FROM attributes_value WHERE attvalueId=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['editid'] = $id;
            header("Location: attvalue_edit.php?attributevalueid={$id}");
        }else{
            header('Location: attribute_value.php?editfailed');
        }
    }

    //Update data
    if(isset($_POST['edit_btn'])){

        $id = $_POST['attvalueid'];
        $name = $_POST['attvalueName'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM attributes_value WHERE attvalueName='$name' AND attvalueId!='$id'";
        $name_query_run = mysqli_query($connection, $name_query);

        if(mysqli_num_rows($name_query_run) > 0)
        {
             $_SESSION['statusEmail'] = "Attribute already exists. Please try again.";
            $_SESSION['status_code'] = "error";
            header("Location: attvalue_edit.php?attributevalueexists");
        }else{

            $query = "UPDATE attributes_value SET attvalueName='$name', status='$status' WHERE attvalueId='$id'";
            $query_run = mysqli_query($connection, $query);

            if($query_run){
                $_SESSION['status'] = "Sucessfully Updated";
                $_SESSION['status_code'] = "success";
                header('Location: attribute_value.php?update=success');
                unset($_SESSION['editid']);
            }else{
                $_SESSION['status'] = "Failed to Update";
                $_SESSION['status_code'] = "error";
                header('Location: attvalue_edit.php?update=fail');
            }
        }
    }

    //update status active to deactive
    if(isset($_POST['activate_submit'])){
        $id = $_POST['activate_id'];
        $query = "UPDATE attributes_value SET status='Deactivate' WHERE attvalueId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: attribute_value.php?attributevalueid{$id}=deactivate");
        }else{

            header('Location: attribute_value.php?error=updatefailed');
        }
    }

    //update status deactive to active
    if(isset($_POST['deactivate_submit'])){
        $id = $_POST['deactivate_id'];
        $query = "UPDATE attributes_value SET status='Activate' WHERE attvalueId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: attribute_value.php?attributevalueid{$id}=activate");
        }else{

            header('Location: attribute_value.php?error=updatefailed');
        }
    }

    //Delete data
    if(isset($_POST['delete_btn'])){

        $id = $_POST['deleteid'];

        //$query = "DELETE FROM attributes_value WHERE attvalueId='$id'";
        //$query_run = mysqli_query($connection, $query);

        $query = $connection -> prepare("DELETE FROM attributes_value WHERE attvalueId=?");
        $query -> bind_param("i", $id);
        $query->execute();

        if($query){
            $_SESSION['status'] = "Successfully Deleted";
            $_SESSION['status_code'] = "success";
            header("Location: attribute_value.php?attributevalueid{$id}=deletesuccess");
        }else{
            $_SESSION['status'] = "Failed to Delete";
            $_SESSION['status_code'] = "error";
            header("Location: attribute_value.php?attributevalueid{$id}=deletefail");
        }
        $query->close();
        $connection->close();
    }

?>