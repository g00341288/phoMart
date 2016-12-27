<?php
	include('config.php');

	// foreach (getallheaders() as $name => $value) {
 //    echo "$name: $value\n";
	// }

	$db = new DB();

	$data = $db->executeQuery(null, "product");

	echo json_encode($data);