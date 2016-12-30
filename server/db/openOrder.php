<?php

/** Include config.php which contains some basic config info shared by all queries */
include('config.php');

/** @var Construct and store current timestamp  */
$timestamp = date('Y-m-d G:i:s');

/** @var Construct and store payment due date */
$payment_due_date = date('Y-m-d H:i:s', strtotime('+24 hours')); 

/** @var Deductions default to 0 for now - in the future this may change */
$deductions = 0; 

/** Get and decode JSON data from AJAX request in a format suitable for consumption by PHP */
$json_input = file_get_contents('php://input');

if($json_input){
	$_REQUEST = json_decode($json_input, true);
}

/** If the request is a POST request, and the table parameter is equal to '_order' */
if($_SERVER['REQUEST_METHOD'] == 'POST' AND $_REQUEST['params']['table'] == '_order'){

	/** @var Set variables from request params to pass to MySQL queries  */
	$table = '_order';
	$items = json_decode(stripslashes($_REQUEST['params']['items']));
	$user_id = $_REQUEST['params']['user_id']; 
	$reference_id = $_REQUEST['params']['reference_id'];
	$complete = $_REQUEST['params']['complete'];
	$vat = $_REQUEST['params']['vat'];
	$subtotal = $_REQUEST['params']['subtotal'];
	$total = $_REQUEST['params']['total'];
	$added = $timestamp;

	/** @var Open and store a new connection to the MySQL server  */
	$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

	/** Check connection */
	if(mysqli_connect_errno()){
		echo "Failed to connect to DB: " . mysqli_connect_error();
	}

	/** Set autocommit to off */
	mysqli_autocommit($con, FALSE); 

		/** @var Construct and store SQL query for _order INSERT query */
	$sql_insert_order = "INSERT INTO " . $table . "(user_id, reference_id, complete, added) " . "VALUES(" . $user_id . ", '" . $reference_id . "', '" . $complete . "', '" . $added . "');";

	/** @var Construct and store SQL query to retrieve order id of recently created order */
	$sql_select_order_id = "SELECT _order_id FROM _order WHERE reference_id = '" . $reference_id . "' LIMIT 1;"; 

	/** Execute insert query on _order table with given params*/
	mysqli_query($con, $sql_insert_order); 

	/** @var Retrieve order_id of recently created order  */
	$res = mysqli_query($con, $sql_select_order_id);
	$res = mysqli_fetch_object($res);
	$order_id = $res->_order_id;

	/** Iterate over $items array and perform an INSERT query against the _order_products table for each item */
	foreach($items as &$value){
		
		mysqli_query($con, "INSERT INTO _order_product(_order_id, product_id, qty, added) VALUES(" . $order_id .", " . $value .", " . 1 .", '" . $added ."');");
	}

	/** Construct and store SQL query to insert new invoice record into invoice table */
	$sql_insert_invoice = "INSERT INTO invoice(_order_id, payment_due_date, vat, deductions, subtotal, total, added) VALUES(" . $order_id . ", '" . $payment_due_date . "', " . $vat . ", " . $deductions . ", " . $subtotal . ", " . $total . ", '" . $added . "');"; 
	
	/** @var string Construct and store SQL query to get all invoices where the _order_id is equal to the current order */
	$sql_select_invoice_id = "SELECT * FROM invoice WHERE _order_id = " . $order_id . " LIMIT 1"; 

	/** Execute insert query on invoice table with given params */
	mysqli_query($con, $sql_insert_invoice); 

	/** @var Retrieve invoice_id of recently created invoice */
	$res = mysqli_query($con, $sql_select_invoice_id);
	$res = mysqli_fetch_object($res);
	$invoice_id = $res->invoice_id; 

	/** @var Set an array with basic data associated with the transaction to send back to AJAX requestor */
	$data_arr = array('transaction' => 'committed', '_order_id' => $order_id, 'invoice_id' => $invoice_id);

	/** Commit the transaction */
	mysqli_commit($con);

	/** Return a json string representation of an object with basic data associated with the transaction*/
	echo json_encode($data_arr); 

	/** Close the connection */
	mysqli_close($con); 

} 

