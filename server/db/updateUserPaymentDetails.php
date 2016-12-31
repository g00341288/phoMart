<?php
/**---------------------------------- Update User Payment Details -------------------------------- */

/** This file has responsibility for updating the user account payment details in the user table 
when a user attempts to make a new payment in the context of a phoMart order. */


/** Include config.php which contains some basic config info shared by all queries */
include('config.php');

/** @var Construct and store current timestamp  */
$timestamp = date('Y-m-d G:i:s');

/** Get and decode JSON data from AJAX request in a format suitable for consumption by PHP */
$json_input = file_get_contents('php://input');

if($json_input){
	$_REQUEST = json_decode($json_input, true);
}

/** If the request is a POST request, and the table parameter is equal to 'user' */
if($_SERVER['REQUEST_METHOD'] == 'PUT' AND $_REQUEST['params']['table'] == 'user'){

	/** @var Set variables from request params to pass to MySQL queries  */
	$table = $_REQUEST['params']['table'];
	$user_id = $_REQUEST['params']['user_id']; 
	$cc_number = $_REQUEST['params']['cc_number'];
	$cc_cvv = $_REQUEST['params']['cc_cvv'];
	$cc_expiry = $_REQUEST['params']['cc_expiry'];
	$added = $timestamp;

	/** Set autocommit to off */
	mysqli_autocommit($con, FALSE); 

	/** @var Construct and store SQL query for user table update query */
	$sql_update_user = "UPDATE user SET cc_number = '" . $cc_number ."', cc_cvv = '" . $cc_cvv . "', cc_expires = '" . $cc_expiry . "' WHERE user_id = " . $user_id . ";"; 

	/** Execute insert query on _order table with given params*/
	mysqli_query($con, $sql_update_user); 

	/** @var Set an array with basic data associated with the transaction to send back to AJAX requestor */
	$data_arr = array('transaction' => 'committed', 'table' => $table, 'user_id' => $user_id, 'cc_number' => $cc_number, 'cc_cvv' => $cc_cvv, 'cc_expiry' => $cc_expiry);

	/** Commit the transaction */
	mysqli_commit($con);

	/** Return a json string representation of an object with basic data associated with the transaction*/
	echo json_encode($data_arr); 

	/** Close the connection */
	mysqli_close($con); 

} 

