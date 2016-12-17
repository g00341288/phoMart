<?php

	// suppress deprecation error - 	it would be better to use PDO or MySQLi. [TODO PDO]
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );

	/** Define named constants for host, user, password and database name */
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'wad');
	
	/** @var Open a connection to MySQL Server, passing in host, username and password */
	$conn = mysql_connect(DBHOST,DBUSER,DBPASS);

	/** @var Select the given database */
	$dbcon = mysql_select_db(DBNAME);
	
	/** If the MySQL server connection is unsuccessful raise an error and exit - not a best
	practise from a UX point of view - review [TODO] */
	if ( !$conn ) {
		die("Connection failed : " . mysql_error());
	}
	
	/** If the database connection is unsuccessful raise an error and exit */
	if ( !$dbcon ) {
		die("Database Connection failed : " . mysql_error());
	}