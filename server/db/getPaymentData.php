<?php
	include('config.php');

	$db = new DB();

	$data = $db->executeQuery(null, "payment");

	echo json_encode($data);