<?php
include '../../database/security.php';
//Add Customer
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

    $contact_query = "SELECT * FROM customers WHERE customerContact='$contact'";
    $contact_query_run = mysqli_query($connection, $contact_query);

    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['statusEmail'] = "Email already exists. Please try again";
        header("Location: add.php?emailexists");
    } elseif (mysqli_num_rows($contact_query_run) > 0) {
        $_SESSION['statusEmail'] = "Contact already exists. Please try again";
        header("Location: add.php?contactexists");
    } else {

            $query = "INSERT INTO customers (customerName,customerEmail,customerContact,customerGender,status,AddedBy)
                VALUES ('$name','$email','$contact','$gender','$status','$addedBy')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['status'] = "Customer Added";
                $_SESSION['status_code'] = "success";
                header("Location: add.php?addsuccess");
            } else {
                $_SESSION['status'] = "CustomerNot Added";
                $_SESSION['status_code'] = "error";
                header("Location: add.php?addfailed");
            }

    }
}

if(isset($_POST["addPO_btn"])){
    //orders
    //insert to orders table
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('d M Y H:i:s');
    $odate = date('d M Y');
    $otime = date('H:i:s');
    $oMonth = date('M');
    $oYear = date('Y');
    $inv = $_POST["invid"];
    $person = $_SESSION["user_id"];
    $value = $_POST['orderCustName'];
    $explode = explode("_",$value,2);
    $name = $explode[0];
    $contact = $_POST["orderCustContact"];
    $email = $_POST["orderCustEmail"];
    $sales = $_POST["total_value"];
    $dis = $_POST["discount"];
    $status = $_POST["orderstatus"];
    $profit = $_POST["profit_value"];
    $note = $_POST["orderNote"];
    $method = $_POST["paymentmethod"];
    $sub = $_POST["subtotal_value"];
    $cost = $_POST["subcost_value"];

    if($name=="" || $contact=="" || $email=="" ){
        $_SESSION['statusPO'] = "Customer's Information cannot be Empty";
        header("Location: add.php?error=empty");
    }else{
        $query = "INSERT INTO orders (invoiceNo, orderCustName, orderCustContact, orderCustEmail, sales, discount, subtotal, subcost, method, orderStatus, orderDateTime, orderMonth, orderYear, orderDate, orderTime, profit, salesperson, orderNote) VALUES ('$inv', '$name', '$contact', '$email', '$sales', '$dis', '$sub', '$cost', '$method', '$status', '$date', '$oMonth', '$oYear', '$odate', '$otime', '$profit', '$person', '$note')";
        $query_run = mysqli_query($connection, $query);

        //get id from last inserted auto increment id (orders table's orderId)
        $order_id = mysqli_insert_id($connection);

        //order_item
        //insert to order item table
        $size = $_POST["product"];
        $count_product = sizeof($size);

        for($x = 0; $x < $count_product; $x++) {
            $order = $order_id;
            $product_id = $_POST["product"][$x];
            $qtt = $_POST["qty"][$x]; //user selected quantity
            $quan = $_POST["qtt"][$x]; //current stock quantity on database
            $perprice = $_POST["rate_value"][$x];
            $amount = $_POST["amount_value"][$x];

            //insert query
            $query_item = "INSERT INTO orderitem (orderId, productId, quantity, unitAmount, sumAmount) VALUES ('$order', '$product_id', '$qtt', '$perprice', '$amount')";
            $query_item_run = mysqli_query($connection, $query_item);
            //update product quantity
            $query_qtt = "UPDATE products SET productQuantity = productQuantity - '$qtt' WHERE productId='$product_id'";
            $query_qtt_run = mysqli_query($connection, $query_qtt);

            if($query_item_run && $query_qtt_run){
                $_SESSION['status'] = "Order Added";
                $_SESSION['status_code'] = "success";
                header("Location: index.php?addsuccess");
            }else{
                $_SESSION['status'] = "Order Not Added";
                $_SESSION['status_code'] = "error";
                header("Location: add.php?addfailed");
            }

        }
    }

}


if(isset($_POST["editBtn"])){
    $id = $_POST['edit_id'];
    $query = "SELECT * From orders WHERE orderId=$id";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['editid'] = $id;
        header("Location:edit.php?id={$id}");
    } else {
        header('Location: index.php?viewfailed');
    }
}

if(isset($_GET["id"])){
    $id = $_GET['id'];
    $query = "SELECT * From orders WHERE orderId=$id";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['editid'] = $id;
        header("Location:edit.php?id={$id}");
    } else {
        header('Location: ../dashboard/index.php?viewfailed');
    }
}

if(isset($_POST["editPO_btn"])){
    //orders
    //update to orders table
    $cstatus = $_POST["currentsta"];
    $id = $_SESSION['editid'];
    $value = $_POST['orderCustName'];
    $explode = explode("_",$value,2);
    $name = $explode[0];
    $contact = $_POST["orderCustContact"];
    $email = $_POST["orderCustEmail"];

    $status = $_POST["orderstatus"];

    $note = $_POST["orderNote"];
    $method = $_POST["paymentmethod"];


    if($name=="" || $contact=="" || $email=="" ){
        $_SESSION['statusPO'] = "Customer's Information cannot be Empty";
        header("Location: add.php?error=empty");
    }else{
        $query = "UPDATE orders SET orderCustName='$name', orderCustContact='$contact', orderCustEmail='$email', method='$method', orderStatus='$status', orderNote='$note' WHERE orderId='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
                $_SESSION['status'] = "Order Updated";
                $_SESSION['status_code'] = "success";
                header("Location: index.php?editsuccess");
        }else{
                $_SESSION['status'] = "Order Not Updated";
                $_SESSION['status_code'] = "error";
                header("Location: edit.php?editfailed");
        }

        if($status == "Cancelled" && ($cstatus == "Pending" || $cstatus == "Completed")){
        //Pending || Completed -> Cancelled (+ quantity)
            $size = $_POST["product"];
            $count_product = sizeof($size);

            for($x = 0; $x < $count_product; $x++) {

                $product_id = $_POST["product"][$x];
                $qtt = $_POST["qty"][$x];

                //update product quantity
                $query_qtt = "UPDATE products SET productQuantity = productQuantity + '$qtt' WHERE productId='$product_id'";
                $query_qtt_run = mysqli_query($connection, $query_qtt);

                if($query_qtt_run){
                    $_SESSION['status'] = "Order Updated";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?editsuccess");
                    unset($_SESSION['editid']);
                }else{
                    $_SESSION['status'] = "Order Not Updated";
                    $_SESSION['status_code'] = "error";
                    header("Location: edit.php?editfailed");
                }
            }
        }else if((($status == "Completed" || $status=="Pending") && ($cstatus == "Pending" || $cstatus == "Completed")) || ($status == "Cancelled" && $cstatus == "Cancelled")){
        //Pending || Completed -> Pending || Completed (Remain)
        //Cancelled -> Cancelled (Remain)
            $size = $_POST["product"];
            $count_product = sizeof($size);

            for($x = 0; $x < $count_product; $x++) {

                $product_id = $_POST["product"][$x];
                $qtt = $_POST["qty"][$x];

                //update product quantity (remain unchanged)
                $query_qtt = "UPDATE products SET productQuantity = productQuantity WHERE productId='$product_id'";
                $query_qtt_run = mysqli_query($connection, $query_qtt);

                if($query_qtt_run){
                    $_SESSION['status'] = "Order Updated";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?editsuccess");
                    unset($_SESSION['editid']);
                }else{
                    $_SESSION['status'] = "Order Not Updated";
                    $_SESSION['status_code'] = "error";
                    header("Location: edit.php?editfailed");
                }
            }
        }else if(($status == "Completed" || $status == "Pending") && $cstatus="Cancelled"){
        //cancelled -> Completed || Pending (- quantity)
            $size = $_POST["product"];
            $count_product = sizeof($size);

            for($x = 0; $x < $count_product; $x++) {

                $product_id = $_POST["product"][$x];
                $qtt = $_POST["qty"][$x];

                //update product quantity
                $query_qtt = "UPDATE products SET productQuantity = productQuantity - '$qtt' WHERE productId='$product_id'";
                $query_qtt_run = mysqli_query($connection, $query_qtt);

                if($query_qtt_run){
                    $_SESSION['status'] = "Order Updated";
                    $_SESSION['status_code'] = "success";
                    header("Location: index.php?editsuccess");
                    unset($_SESSION['editid']);
                }else{
                    $_SESSION['status'] = "Order Not Updated";
                    $_SESSION['status_code'] = "error";
                    header("Location: edit.php?editfailed");
                }
            }
        }else{
            $_SESSION['status'] = "Something went wrong";
            $_SESSION['status_code'] = "error";
            header("Location: edit.php?editfailed");
        }
    }
}

if(isset($_POST['submit_Btn'])){
    $s = $_POST['status'];
    if($s == "All"){
        header("Location: ../orders/");
    }else{
        header("Location: index.php?status=".$s);
    }

}


?>
