<?php
include '../../database/security.php';

if(isset($_POST["notesId"])){
	$id = $_POST['notesId'];
	$query = "SELECT * FROM notes WHERE Id = $id";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);

	echo json_encode($row);
}

?>
