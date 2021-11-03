<?php

include '../../database/security.php';

if(isset($_POST["row_id"])){
	$json = array();
    $sta = "Active";
    $ava = "Available";
    $qtt = "0";
	$query = $connection -> prepare("SELECT * FROM products WHERE availability =? AND productQuantity != ? AND status=? ORDER BY productId DESC");
    $query -> bind_param("sss", $ava, $qtt, $sta);
    $query->execute(); 
    $result = $query->get_result(); 
	while($re = $result -> fetch_assoc()){
		$json[] = $re;
	}
	echo json_encode($json);
  
}

if(isset($_POST["product_id"])){

    $sta = "Active";
    $ava = "Available";
    $qtt = "0";
    $id = $_POST['product_id'];
	$query = $connection -> prepare("SELECT * FROM products WHERE productId=? AND availability =? AND productQuantity != ? AND status=?");
    $query -> bind_param("isss", $id, $ava, $qtt, $sta);
    $query->execute(); 
    $result = $query->get_result(); 
    $re = $result -> fetch_assoc();
	echo json_encode($re);
}

?>