<?php

/** Include config.php which contains some basic config info shared by all queries */
include('config.php');

/** @var Construct and store current timestamp  */
$timestamp = date('Y-m-d G:i:s');

/** Get and decode JSON data from AJAX request in a format suitable for consumption by PHP */
$json_input = file_get_contents('php://input');

if($json_input){
	$_REQUEST = json_decode($json_input, true);
}

/** If the request is a POST request, and the table parameter is equal to 'payment' */
if($_SERVER['REQUEST_METHOD'] == 'POST' AND $_REQUEST['params']['table'] == 'payment'){

	/** @var Set variables from request params to pass to MySQL queries  */
	$table = $_REQUEST['params']['table'];
	$order_id = $_REQUEST['params']['_order_id'];
	$invoice_id = $_REQUEST['params']['invoice_id'];
	$amount = $_REQUEST['params']['amount'];
	$payment_method = $_REQUEST['params']['payment_method'];
	$authorised = $_REQUEST['params']['authorised'];
	$delivery_firstname = $_REQUEST['params']['delivery_firstname'];
	$delivery_surname = $_REQUEST['params']['delivery_surname'];
	$addr_line1 = $_REQUEST['params']['addr_line1'];
	$addr_line2 = $_REQUEST['params']['addr_line2'];
	$addr_line3 = $_REQUEST['params']['addr_line3'];
	$city = $_REQUEST['params']['city'];
	$cnty = $_REQUEST['params']['cnty'];
	$zip = $_REQUEST['params']['zip'];
	$tel = $_REQUEST['params']['tel'];
	$mobile = $_REQUEST['params']['mobile'];
	$added = $timestamp;

	/** Set autocommit to off */
	mysqli_autocommit($con, FALSE); 

		/** @var Construct and store SQL query for payment table INSERT query */
	$sql_insert_payment = "INSERT INTO payment(invoice_id, amount, payment_method, authorised, added) VALUES(" . $invoice_id . ", " . $amount . ", '" . $payment_method . "', '" . $authorised . "', '" . $added . "');" ;

	/** Execute INSERT query on payment table with given params*/
	mysqli_query($con, $sql_insert_payment); 

	/** @var Construct and store SQL query for payment table SELECT query */
	$sql_select_payment_id = "SELECT payment_id FROM payment WHERE invoice_id = " . $invoice_id . ";";

	/** @var Retrieve payment_id of recently created payment record */
	$res = mysqli_query($con, $sql_select_payment_id);
	$res = mysqli_fetch_object($res);
	$payment_id = $res->payment_id;

	/** Construct and store SQL query to insert new delivery record into delivery table */
	$sql_insert_delivery = "INSERT INTO delivery(_order_id, delivery_firstname, delivery_surname, addr_line1, addr_line2, addr_line3, city, cnty, zip, tel, mobile, added) VALUES(" . $order_id . ", '" . $delivery_firstname . "', '" . $delivery_surname . "', '" . $addr_line1 . "', '" . $addr_line2 . "', '" . $addr_line3 . "', '" . $city . "', '" . $cnty . "', '" . $zip . "', '" . $tel . "', '" . $mobile . "', '" . $added ."'); "; 
	
	/** Execute insert query on delivery table with given params */
	mysqli_query($con, $sql_insert_delivery); 

	/** Construct and store SQL query to retrieve delivery_id of recently created delivery record */
	$sql_select_delivery_id = "SELECT delivery_id FROM delivery WHERE _order_id = " . $order_id;

	/** @var Retrieve delivery_id of recently created delivery record */
	$res = mysqli_query($con, $sql_select_delivery_id);
	$res = mysqli_fetch_object($res);
	$delivery_id = $res->delivery_id; 

	/** Construct and store SQL query to update _order table to reflect the status of the order (closed) */
	$sql_update_order = "UPDATE _order SET complete = true WHERE _order_id = " . $order_id;

	/** Execute update query on _order table with given params */
	mysqli_query($con, $sql_update_order);

	/** @var Set an array with basic data associated with the transaction to send back to AJAX requestor */
	$data_arr = array('transaction' => 'committed', 'order' => 'closed', '_order_id' => $order_id, 'invoice_id' => $invoice_id, 'payment_id' => $payment_id, 'delivery_id' => $delivery_id);

	/** Commit the transaction */
	mysqli_commit($con);

	/** Return a json string representation of an object with basic data associated with the transaction */
	echo json_encode($data_arr); 

	/** Close the connection */
	mysqli_close($con); 

} 

