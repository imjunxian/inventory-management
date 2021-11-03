<?php
    include '../../database/security.php';

    //Add User
    if(isset($_POST['addBtn'])){

        $name = $_POST['supplierName'];
        $email = $_POST['supplierEmail'];
        $contact = $_POST['supplierContact'];
        $status = $_POST['status'];

        $name_query = "SELECT * FROM suppliers WHERE supplierName='$name'";
        $name_query_run = mysqli_query($connection, $name_query);

        $email_query = "SELECT * FROM suppliers WHERE supplierEmail='$email'";
        $email_query_run = mysqli_query($connection, $email_query);

        $contact_query = "SELECT * FROM suppliers WHERE supplierContact='$contact'";
        $contact_query_run = mysqli_query($connection, $contact_query);

        if (mysqli_num_rows($email_query_run) > 0) {
            $_SESSION['statusEmail'] = "Email already exists. Please try again.";
            header("Location: index.php?emailexists");
        } elseif (mysqli_num_rows($contact_query_run) > 0) {
            $_SESSION['statuEmail'] = "Contact already exists. Please try again.";
            header("Location: index.php?contactexists");
        } elseif (mysqli_num_rows($name_query_run) > 0) {
            $_SESSION['statusEmail'] = "Supplier Name already exists. Please try again.";
            header("Location: index.php?nameexists");
        }else{
            if($name != '' && $email != '' && $contact != '' && $status != ''){
                $query = "INSERT INTO suppliers (supplierName, supplierEmail, supplierContact, supplierStatus) VALUES ('$name', '$email', '$contact', '$status')";
                $query_run = mysqli_query($connection, $query);

                if($query_run){
                    $_SESSION['status'] = "Supplier Added";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?addsuccess");
                }
                else{
                    $_SESSION['status'] = "Supplier Not Added";
                    $_SESSION['status_code'] = "error";
                    header("Location: index.php?addfailed");
                }
            }else{
                $_SESSION['status'] = "Supplier Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: index.php?addfailed");
            }

        }

    }

    // let edit user info display each of the edit user data
    if(isset($_POST['editBtn'])){
        $id = $_POST['edit_id'];
        $query = "SELECT * FROM suppliers WHERE supplierId=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['editid'] = $id;
            header("Location: edit.php?supplierid={$id}");
        }else{
            header('Location: index.php?editfailed');
        }
    }

    //Update data
    if(isset($_POST['edit_btn'])){

        $id = $_POST['supplierid'];
        $name = $_POST['supplierName'];
        $email = $_POST['supplierEmail'];
        $contact = $_POST['supplierContact'];
        $status = $_POST['status'];

        /*$query = $connection -> prepare("DELETE FROM suppliers WHERE supplierId=?");
        $query -> bind_param("i", $id);
        $query->execute();*/

        $email_query = "SELECT * FROM suppliers WHERE supplierEmail='$email' AND supplierId !='$id'";
        $email_query_run = mysqli_query($connection, $email_query);

        $contact_query = "SELECT * FROM suppliers WHERE supplierContact='$contact' AND supplierId != '$id'";
        $contact_query_run = mysqli_query($connection, $contact_query);

       if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['statusEmail'] = "Email already exists. Please try again.";
        header("Location: edit.php?emailexists");

        }else if(mysqli_num_rows($contact_query_run) > 0){
            $_SESSION['statusEmail'] = "Contact already exists. Please try again.";
            header("Location: edit.php?emailexists");

        }else{
            $query = "UPDATE suppliers SET supplierName='$name', supplierEmail='$email', supplierContact='$contact', supplierStatus='$status' WHERE supplierId='$id'";
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

    // let edit user info display each of the edit user data
    if(isset($_POST['editBtn'])){
        $id = $_POST['edit_id'];
        $query = "SELECT * From suppliers WHERE supplierId=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['editid'] = $id;
            header("Location: edit.php?supplierid={$id}");
        }else{
            header('Location: edit.php?editfailed');
        }
    }

    //update status active to deactive
    /*if(isset($_POST['activate_submit'])){
        $id = $_POST['activate_id'];
        $query = "UPDATE suppliers SET supplierStatus='Deactivate' WHERE supplierId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: index.php?supplierid{$id}=deactivate");
        }else{

            header('Location: index.php?error=updatefailed');
        }
    }*/

    //update status deactive to active
    /*if(isset($_POST['deactivate_submit'])){
        $id = $_POST['deactivate_id'];
        $query = "UPDATE suppliers SET supplierStatus='Activate' WHERE supplierId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){

            header("Location: index.php?supplierid{$id}=activate");
        }else{

            header('Location: index.php?error=updatefailed');
        }
    }*/

    //Delete data
    if(isset($_POST['delete_btn'])){

        $id = $_POST['deleteid'];

        //$query = "DELETE FROM suppliers WHERE supplierId='$id'";
        //$query_run = mysqli_query($connection, $query);
        $query = $connection -> prepare("DELETE FROM suppliers WHERE supplierId=?");
        $query -> bind_param("i", $id);
        $query->execute();
        
        if($query){
            $_SESSION['status'] = "Successfully Deleted";
            $_SESSION['status_code'] = "success";
            header("Location: ../recycle/suppliers.php?supplierid{$id}=deletesuccess");
        }else{
            $_SESSION['status'] = "Failed to Delete";
            $_SESSION['status_code'] = "error";
            header("Location: ../recycle/suppliers.php?supplierid{$id}=deletefail");
        }
        $query->close();
        $connection->close();
    }

    if(isset($_POST["recycleBtn"])){
     $id = $_POST['deleteid'];
     $sta = "Inactive";
     $query = $connection -> prepare("UPDATE suppliers SET supplierStatus=? WHERE supplierId=?");
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
     $query = $connection -> prepare("UPDATE suppliers SET supplierStatus=? WHERE supplierId=?");
    $query -> bind_param("si", $sta, $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Recovered";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/suppliers.php?recoveredsuccess");
    } else {
        $_SESSION['status'] = "Failed to Recover";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/suppliers.php?recoveredfail");
    }
    $query->close();
    $connection->close();
}

?>