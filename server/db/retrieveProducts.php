<?php
/**---------------------------------- Retrieve Products from DB  -------------------------------- */

/** This file has responsibility for retrieving product records from the DB and sharing them with 
an AJAX caller who will populate the home view with that data 
*/


/** Include config.php which contains some basic config info shared by all queries */
include('config.php');

/** If the request is a GET request against the product table only  */
if($_SERVER['REQUEST_METHOD'] == 'GET' AND $_GET['table'] == 'product'){

	/** @var Set the table name */
	$table = $_GET['table']; 

	/** Set autocommit to off */
	mysqli_autocommit($con, FALSE); 

	/** @var Construct SQL query to retrieve products from product table of wad database*/
	$sql_select_all_products = "SELECT * FROM " . $table ." ;";

	/** @var Execute the query and store the result for further processing */
	$qry = mysqli_query($con, $sql_select_all_products);

	/** If the number of rows in the result is greater than 0, store the results row by row to $data  */
	if($qry->num_rows > 0) {
		while($row = $qry->fetch_object()) {
			$data[] = $row;
		}
	} else {
		$data[] = null;
	}

	/** Commit the transaction */
	mysqli_commit($con);

	/** Encode the result of the query and pass back to the client */
	echo json_encode($data);

	/** Close the connection */
	mysqli_close($con);

}
else {
	$data = "This module accepts a GET request on the product table only! Please contact the system admin for more info at: admin@phomart.com"; 
	echo json_encode($data);
}
?>