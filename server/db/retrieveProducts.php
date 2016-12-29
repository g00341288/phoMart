<?php

/** Include config.php which contains some basic config info shared by all queries */
include('config.php');

/** If the request is a GET request against the product table only  */
if($_SERVER['REQUEST_METHOD'] == 'GET' AND $_GET['table'] == 'product'){

	/** @var Set the table name */
	$table = $_GET['table']; 

	/** @var Open a new connection to the MySQL server  */
	$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

	/** Check connection */
	if(mysqli_connect_errno()){
		echo "Failed to connect to DB: " . mysqli_connect_error();
	}

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
	$data = "This module accepts GET requests only! Please contact the system admin for more info at: admin@phomart.com"; 
	echo json_encode($data);
}
?>