<?php
	include('config.php');

	/** @var string Table identifier is passed as a param to the AngularJS AJAX .get()
	method */
	$table = $_GET['table']; 

	/** @var object New DB instance to handle queries against the wad MySQL/MariaDB database */
	$db = new DB();

	/** @var [type] [description] */
	$data = $db->executeQuery(null, $table);

	/** Encode the data as JSON and return to the AJAX requestor */
	echo json_encode($data);