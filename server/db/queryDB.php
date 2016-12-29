<?php
	include('config.php');

	/** @var Current timestamp  */
	$timestamp = date('Y-m-d G:i:s');

	/** Decode JSON data from AJAX request in a format suitable for consumption by PHP */
	$json_input = file_get_contents('php://input');

	if($json_input){
		$_REQUEST = json_decode($json_input, true);
	}

	/** If the request is a POST request, and the table parameter is equal to '_order' */
	if($_SERVER['REQUEST_METHOD'] == 'POST' AND $_REQUEST['params']['table'] == '_order'){

		/** @var Set variables from request for MySQL query  */
		$table = '_order';
		$user_id = $_REQUEST['params']['user_id']; 
		$reference_id = $_REQUEST['params']['reference_id'];
		$complete = $_REQUEST['params']['complete'];
		$added = $timestamp;

		/** @var Construct SQL query for order insert */
		$sql = "INSERT INTO " . $table . "(user_id, reference_id, complete, added) " . "VALUES(" . $user_id . ", '" . $reference_id . "', '" . $complete . "', '" . $added . "');"; 

		/** @var object New DB instance to handle queries against the wad MySQL/MariaDB database */
		$db = new DB();

		/** @var [type] execute SQL query on db and store response */
		$data = $db->executeQuery($sql, $table);

		$sql = null; 

		$data = $db->executeQuery($sql, $table);

	}
	// else if ($_SERVER['REQUEST_METHOD'] == 'POST' AND $_POST['table'] == 'payment'){

	// }
	else if($_SERVER['REQUEST_METHOD'] == 'GET'){

		/** @var string Table identifier is passed as a param by the AngularJS AJAX .get()
		method */
		$table = $_GET['table']; 
		$sql = null;

		/** @var object New DB instance to handle queries against the wad MySQL/MariaDB database */
		$db = new DB();

		/** @var [type] execute SQL query on db and store response */
		$data = $db->executeQuery($sql, $table);

	}
	// else if($_SERVER['REQUEST_METHOD'] == 'PUT'){

	// }
	// else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

	// }
 

	echo json_encode($data);