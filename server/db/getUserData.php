<?php
	include('config.php');

	$db = new DB();

	$data = $db->executeQuery(null, "user");

	echo json_encode($data);