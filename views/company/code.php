<?php

include '../../database/security.php';

if (isset($_POST['edit_btn'])){

    $id = $_POST['companyid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];

    //change user profile without changing the password
    $query = "UPDATE company SET companyName='$name', email='$email', contact='$contact',
    address1='$add1', address2='$add2', postcode='$postcode', city='$city', state='$state', country='$country' WHERE companyId='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status'] = "Sucessfully Updated";
        $_SESSION['status_code'] = "success";
        header("Location: index.php?updatesuccess");

    }else{
        $_SESSION['status'] = "Failed to Update";
        $_SESSION['status_code'] = "error";
        header("Location: edit.php?updatefail");
    }
}

// let edit user info display each of the edit user data
if (isset($_POST['editBtn'])) {
    $id = 1;
    $query = "SELECT * From company WHERE companyId=$id";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['editid'] = $id;
        header("Location:edit.php?id={$id}");
    } else {
        header('Location: index.php?editfailed');
    }

}

?>
