<?php

/** Include config.php which contains some basic config info shared by all 
queries */
include('config.php');

/** @var Construct current timestamp  */
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
	$items = json_decode(stripslashes($_REQUEST['params']['items']));
	$user_id = $_REQUEST['params']['user_id']; 
	$reference_id = $_REQUEST['params']['reference_id'];
	$complete = $_REQUEST['params']['complete'];
	$added = $timestamp;


	/** @var Open a new connection to the MySQL server  */
	$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

	/** Check connection */
	if(mysqli_connect_errno()){
		echo "Failed to connect to DB: " . mysqli_connect_error();
	}

	/** Set autocommit to off */
	mysqli_autocommit($con, FALSE); 

		/** @var Construct SQL query for order insert */
	$sql_insert_order = "INSERT INTO " . $table . "(user_id, reference_id, complete, added) " . "VALUES(" . $user_id . ", '" . $reference_id . "', '" . $complete . "', '" . $added . "');";

	/** @var Construct SQL query to retrieve order id of recently created order */
	$sql_select_order_id = "SELECT _order_id FROM _order WHERE reference_id = '" . $reference_id . "' LIMIT 1;"; 

	/** Execute first insert query on _order table */
	mysqli_query($con, $sql_insert_order); 

	/** @var Retrieve order_id of recently created order  */
	$res = mysqli_query($con, $sql_select_order_id);
	$res = mysqli_fetch_object($res);
	$order_id = $res->_order_id;

	/** Iterate over $items array and perform an INSERT query against the _order_products table for each item */
	foreach($items as &$value){
		$string = "INSERT INTO _order_product(_order_id, product_id, qty, added) VALUES(" . $order_id .", " . $value .", " . 1 .", '" . $added ."');";
		mysqli_query($con, "INSERT INTO _order_product(_order_id, product_id, qty, added) VALUES(" . $order_id .", " . $value .", " . 1 .", '" . $added ."');");
	}

	/** Commit the transaction */
	mysqli_commit($con);

	echo json_encode($string); 

	/** Close the connection */
	mysqli_close($con); 

} 

