<?php
	include('config.php');

	$db = new DB();

	$data = $db->executeQuery(null, "product");


	echo($_POST['shitehawk']);

	echo json_encode($data);