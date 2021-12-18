<?php
include '../../database/security.php';

//add product
if(isset($_POST["addBtn"])){

	$image = $_POST["product_image"];
	$img = $_FILES["product_image"]["name"];
	$storeName = $_FILES["product_image"]["tmp_name"];
	$dir = "../../dist/img/productImage/";
	$target_file = $dir . basename($img);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$error = $_FILES["product_image"]["error"];
	$exist = file_exists($target_file);


	$name = $_POST["name"];
	$sku = $_POST["sku"];
	$qtt = $_POST["quantity"];
	$price = $_POST["price"];
	$cost = $_POST["cost"];
	$des = $_POST["description"];
	$state = $_POST["status"];
	$ava = $_POST["availability"];
	$brand = $_POST["brand"];

	//category array
	$cat = array();
	foreach($_POST["category"] as $key => $value){
		$cat[$key] = $value;
	}
	$category = json_encode($cat);

	//attribute value array
	$attv = array();
	foreach($_POST["attvalue"] as $key => $value){
		$attv[$key] = $value;
	}
	$attvalue = json_encode($attv);

	//supplier array
	$sup = array();
	foreach($_POST["supplier"] as $key => $value){
		$sup[$key] = $value;
	}
	$supplier = json_encode($sup);

	$checkSKU = "SELECT productSKU FROM products WHERE productSKU = $sku";
	$checkSKU_run = mysqli_query($connection, $checkSKU);

	if($img == ""){
		$_SESSION['statusSKU'] = "Image is required";
	    $_SESSION['status_code'] = "error";
	    header("Location: add.php?error=empty");
	}
	/*if($exist){
		$_SESSION['statusSKU'] = "Image already exists";
	    $_SESSION['status_code'] = "error";
	    header("Location: add.php?imageexists");

	}*/else if($_FILES["product_image"]["size"] > 500000){
		$_SESSION['statusSKU'] = "Image size too large";
	    $_SESSION['status_code'] = "error";
	    header("Location: add.php?imgsizeerror");

	}else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ){
		$_SESSION['statusSKU'] = "Only Support jpg, jpeg and png";
	    $_SESSION['status_code'] = "error";
	    header("Location: add.php?imagenotsupport");

	}else if($sku == '' && $name == '' && $img == '' && $qtt == '' && $price == '' && $cost == '' && $brand == '' && $state == '' && $ava == ""){
	    $_SESSION['statusSKU'] = "Product Details shouldn't be empty";
		$_SESSION['status_code'] = "error";
		header("Location: add.php?error=empty");

	}else{
		/*$query = $connection -> prepare("INSERT INTO products (productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ");
	    $query -> bind_param("ssssssssssss", $sku, $name, $img, $qtt, $price, $cost, $des, $brand, $category, $attvalue, $supplier, $state);
	    $query->execute();*/
	    if(mysqli_num_rows($checkSKU_run) > 0){
		    $_SESSION['statusSKU'] = "Product SKU already exists. Please try again.";
			header("Location: add.php?skuexists");
		}
		else{
			$query = "INSERT INTO products (productSKU, productName, productImage, productQuantity, productPrice, productCost, productDescription, brandId, categoryId, attvalueId, supplierId,status,availability) VALUES ('$sku', '$name', '$img', '$qtt', '$price', '$cost', '$des', '$brand', '$category', '$attvalue', '$supplier', '$state', '$ava')";
			$query_run = mysqli_query($connection, $query);

			if($query_run){
				unlink($target_file);
			   	move_uploaded_file($storeName, $target_file);
				$_SESSION['status'] = "Product Added";
			    $_SESSION['status_code'] = "success";
			    header("Location: index.php?addsuccess");
			}else{
			   	$_SESSION['status'] = "Product Not Added";
			    $_SESSION['status_code'] = "error";
			    header("Location: add.php?addfailed");
		    }
		}
	}
}

//POST in product page to view product details
if(isset($_POST['viewBtn'])){
	$id = $_POST['view_id'];
	$query = $connection -> prepare("SELECT * FROM products WHERE productId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['viewid'] = $id;
        header("Location:detail.php?id={$id}");
    } else {
        header('Location: index.php?viewfailed');
    }
		$query->close();
		$connection->close();
}


//GET from dashboard to view product details
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query = $connection -> prepare("SELECT * FROM products WHERE productId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['viewid'] = $id;
        header("Location:detail.php?id={$id}");
    } else {
        header('Location: index.php?viewfailed');
    }
		$query->close();
		$connection->close();
}


//POST in product page to edit product details
if(isset($_POST['editBtn'])){
	$id = $_POST['edit_id'];
	$query = $connection -> prepare("SELECT * FROM products WHERE productId=?");
    $query -> bind_param("i", $id);
    $query->execute();

    if ($query) {
        $_SESSION['editid'] = $id;
        header("Location:edit.php?id={$id}");
    } else {
        header('Location: index.php?editfailed');
    }
		$query->close();
		$connection->close();
}


/*$file = $_POST["product_image"];
$img = $_FILES["product_image"]["name"];
$dir = "../../dist/img/productImage/";
$target_file = $dir . basename($img);
if(file_exists($target_file)){
echo "file exits";
unlink($target_file);
else{
echo "the file you want to delete does nto exist ";
}*/


/*
retrieve array data from database
$record=mysql_query($connection, "SELECT * FROM myTable");
$list = array();
while($row=mysql_fetch_assoc($record)){
    //fill array how to fill array that will look like bellow from database???
    $list[] = $row;
}

in edit.php file
<?php foreach ($category as $k => $v): ?>
<option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
<?php endforeach ?>
*/

//Delete data
    if(isset($_POST['delete_btn'])){

        $id = $_POST['deleteid'];

        //$query = "DELETE FROM brands WHERE brandId='$id'";
        //$query_run = mysqli_query($connection, $query);
        $query = $connection -> prepare("DELETE FROM products WHERE productId=?");
        $query -> bind_param("i", $id);
        $query->execute();

        if($query){
            $_SESSION['status'] = "Successfully Deleted";
            $_SESSION['status_code'] = "success";
            header("Location: ../recycle/products.php?product=deletesuccess");
        }else{
            $_SESSION['status'] = "Failed to Delete";
            $_SESSION['status_code'] = "error";
            header("Location: ../recycle/products.php?product=deletefail");
        }
        $query->close();
        $connection->close();
    }

    if(isset($_POST["recycleBtn"])){
     $id = $_POST['deleteid'];
     $sta = "Inactive";
     $query = $connection -> prepare("UPDATE products SET status=? WHERE productId=?");
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
     $query = $connection -> prepare("UPDATE products SET status=? WHERE productId=?");
    $query -> bind_param("si", $sta, $id);
    $query->execute();

    if ($query) {
        $_SESSION['status'] = "Successfully Recovered";
        $_SESSION['status_code'] = "success";
        header("Location: ../recycle/products.php?recoveredsuccess");
    } else {
        $_SESSION['status'] = "Failed to Recover";
        $_SESSION['status_code'] = "error";
        header("Location: ../recycle/products.php?recoveredfail");
    }
    $query->close();
    $connection->close();
}



//update product
if(isset($_POST["editprod_btn"])){

	$img = $_FILES["product_image"]["name"];
	$storeName = $_FILES["product_image"]["tmp_name"];
	$dir = "../../dist/img/productImage/";
	$target_file = $dir . basename($img);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$error = $_FILES["product_image"]["error"];
	$exist = file_exists($target_file);

	$id= $_POST['prodid'];
	$name = $_POST["name"];
	$sku = $_POST["sku"];
	$qtt = $_POST["quantity"];
	$price = $_POST["price"];
	$cost = $_POST["cost"];
	$des = $_POST["description"];
	$state = $_POST["status"];
	$ava = $_POST["availability"];
	$brand = $_POST["brand"];

	//category array
	$cat = array();
	foreach($_POST["category"] as $key => $value){
		$cat[$key] = $value;
	}
	$category = json_encode($cat);

	//attribute value array
	$attv = array();
	foreach($_POST["attvalue"] as $key => $value){
		$attv[$key] = $value;
	}
	$attvalue = json_encode($attv);

	//supplier array
	$sup = array();
	foreach($_POST["supplier"] as $key => $value){
		$sup[$key] = $value;
	}
	$supplier = json_encode($sup);

	$checkSKU = "SELECT * FROM products WHERE productSKU = '$sku' AND productId != $id";
	$checkSKU_run = mysqli_query($connection, $checkSKU);


	    if(mysqli_num_rows($checkSKU_run) > 0){
		    $_SESSION['statusSKU'] = "Product SKU already exists. Please try again.";
			header("Location: edit.php?skuexists");

		}else if(mysqli_num_rows($checkSKU_run) == 0){
			$query = $connection -> prepare("UPDATE products SET productSKU=?, productName=?, productQuantity=?, productPrice=?, productCost=?, productDescription=?, brandId=?, categoryId=?, attvalueId=?, supplierId=?, status=?, availability=? WHERE productId=?");
			    $query -> bind_param("ssssssssssssi",$sku, $name, $qtt, $price, $cost, $des, $brand, $category, $attvalue, $supplier,$state, $ava, $id);
    			$query->execute();

			if($query){
				$_SESSION['status'] = "Product Updated";
			    $_SESSION['status_code'] = "success";
			    header("Location: index.php?updatesuccess");
			    unset($_SESSION['editid']);
			}else{
			   	$_SESSION['status'] = "Product Updated Failed";
			    $_SESSION['status_code'] = "error";
			    $_SESSION['editid'] = $id;
			    header("Location: edit.php?editfailed");
		    }
		}else{
			$_SESSION['statusSKU'] = "Something went wrong. Please try again.";
			header("Location: edit.php?error");
		}

		if($img != null){

	        $query_img = $connection -> prepare("UPDATE products SET productImage=? WHERE productId=?");
			$query_img -> bind_param("si",$img, $id);
	    	$query_img ->execute();

	        if($query_img){
	            unlink($target_file);
	            move_uploaded_file($storeName, $target_file);
	            $_SESSION['status'] = "Product Updated";
	            $_SESSION['status_code'] = "success";
	            header("Location: index.php?updatesuccess");
	            unset($_SESSION['editid']);
	        }else{
	            $_SESSION['status'] = "Product Updated Failed";
	            $_SESSION['status_code'] = "error";
	            $_SESSION['editid'] = $id;
	            header("Location: edit.php?updatefail");

	    	}
    	}
	}

	if(isset($_POST["submit_Btn"])){
		
		$s = $_POST["status"];

		if($s == "All"){
			 header("Location: ../products/");
		}else if($s == "Available"){
			header("Location: index.php?stock=".$s);
		}else if($s == "Unavailable"){
			header("Location: index.php?stock=".$s);
		}else if($s == "LowStock"){
			header("Location: index.php?stock=".$s);
		}else if($s == "StockOut"){
			header("Location: index.php?stock=".$s);
		}
	}

?>
