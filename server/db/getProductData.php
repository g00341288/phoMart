<?php
	include('config.php');

	$db = new DB();

	$data = $db->executeQuery(null, "product");

	echo json_encode($data);