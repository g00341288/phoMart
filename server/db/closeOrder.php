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

	// do transactions here!

}