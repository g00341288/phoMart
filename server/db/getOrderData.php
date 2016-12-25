<?php
	include('config.php');

	$db = new DB();

	$data = $db->executeQuery(null, "order");

	echo json_encode($data);