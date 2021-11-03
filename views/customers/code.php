<?php
include '../../database/security.php';
//Add User

if (isset($_POST['addBtn'])) {

    $name = $_POST['custName'];
    $email = $_POST['custEmail'];
    //$dob = $_POST['dob'];
    $contact = $_POST['custContact'];
    $gender = $_POST['gender'];
    $addedBy = $_SESSION['user_id'];
    $status = "Active";
    
    $email_query = "SELECT * FROM customers WHERE customerEmail='$email'";
    $email_query_run = mysqli_query($connection, $email_query);
    //$query = $connection -> prepare($email_query);
    //$query->execute(); 
    //$result = $query->get_result(); 
    //$row = $result->fetch_assoc();

    $contact_query = "SELECT * FROM customers WHERE customerContact='$contact'";
    $contact_query_run = mysqli_query($connection, $contact_query);

    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['statusEmail'] = "Email already exists. Please try again";
        header("Location: index.php?emailexists");
    } elseif (mysqli_num_rows($contact_query_run) > 0) {
        $_SESSION['statusEmail'] = "Contact already exists. Please try again";
        header("Location: index.php?contactexists");
    } else {
        if($name != "" && $email!="" && $contact!="" && $gender!=""){
            
            $query = "INSERT INTO customers (customerName,customerEmail,customerContact,customerGender,status,AddedBy)
                VALUES ('$name','$email','$contact','$gender','$status','$addedBy')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['status'] = "Customer Added";
                $_SESSION['status_code'] = "success";
                header("Location: index.php?addsuccess");
            } else {
                $_SESSION['status'] = "Customer Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: index.php?addfailed");
            }
        }else{
            $_SESSION['status'] = "Customer Not Added";
            $_SESSION['status_code'] = "error";
            header("Location: index.php?addfailed");
        }
    }
}

// let edit user info display each of the edit user data
if (isset($_POST['editBtn'])) {
    $id = $_POST['edit_id'];
    $query = "SELECT * From customers WHERE customerId=$id";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['editid'] = $id;
        header("Location:edit.php?customerid={$id}");
    } else {
        header('Location: index.php?editfailed');
    }
}

//Update data
if (isset($_POST['edit_btn'])) {

    $id = $_POST['custid'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    //$dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];

    $email_query = "SELECT * FROM customers WHERE customerEmail='$email' AND customerId != '$id'";
    $email_query_run = mysqli_query($connection, $email_query);

    $contact_query = "SELECT * FROM customers WHERE customerContact='$contact' AND customerId != '$id'";
    $contact_query_run = mysqli_query($connection, $contact_query);

    if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['statusEmail'] = "Email already exists. Please try again.";
        header("Location: edit.php?emailexists");

    }else if(mysqli_num_rows($contact_query_run) > 0){
        $_SESSION['statusEmail'] = "Contact already exists. Please try again.";
        header("Location: edit.php?emailexists");

    }else{ 
        $query = "UPDATE customers SET customerName='$name', customerEmail='$email', customerContact='$contact',
        customerGender='$gender' WHERE customerId='$id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['status'] = "Sucessfully Updated";
            $_SESSION['status_code'] = "success";
            header("Location: index.php?customerid{$id}=updatesuccess");
            unset($_SESSION['editid']);
        } else {
            $_SESSION['status'] = "Failed to Update";
            $_SESSION['status_code'] = "error";
            header("Location: edit.php?customer=updatefail");
        }
    }
}

//Delete data
if (isset($_POST['delete_btn'])) {

    $id = $_POST['deleteid'];

    //$query = "DELETE FROM customers WHERE customerId='$id'";
    //$query_run = mysqli_query($connection, $query);
    $query = $connection -> prepare("DELETE FROM customers WHERE customerId=?");
    $query -> bind_param("i", $id);
    $query->execute(); 
  
    if ($query) {
        $_SESSION['status'] = "Successfully Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/customers.php?customer=deletesuccess");
    } else {
        $_SESSION['status'] = "Failed to Delete";
        $_SESSION['status_code'] = "error";
        header("Location:  ../recycle/customers.php?customerid{$id}=deletefail");
    }
    $query->close();
    $connection->close();
}

if(isset($_POST["recycleBtn"])){
     $id = $_POST['deleteid'];
     $query = $connection -> prepare("UPDATE customers SET status='Inactive' WHERE customerId=?");
    $query -> bind_param("i", $id);
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
     $query = $connection -> prepare("UPDATE customers SET status='Active' WHERE customerId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Recovered";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/customers.php?recoveredsuccess");
    } else {
        $_SESSION['status'] = "Failed to Recover";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/customers.php?recoveredfail");
    }
    $query->close();
    $connection->close();
}
?>