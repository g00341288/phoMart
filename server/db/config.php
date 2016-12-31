<?php
/**---------------------------------- Shared config for db-related code -------------------------------- */


	/** Suppress occasional mysqli deprecation errors - it is generally 
	a bad practice to allow error reporting of this kind to leak 
	into the user experience */
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );


	/** The define() statements set up constants for the 
	application representing the host, user, password
	and database name for the application. See the 
	application manual for guidance on setting them! */
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'wad');

	/** @var Open and store a new connection to the MySQL server  */
	$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

	/** Check connection */
	if(mysqli_connect_errno()){
	  echo "Failed to connect to DB: " . mysqli_connect_error();
	}

?>