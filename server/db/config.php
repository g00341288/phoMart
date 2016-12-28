<?php

	// The define() statements set up constants for the 
	// application representing the host, user, password
	// and database name for the application. See the 
	// application manual for guidance on setting them!
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'wad');

	class DB {
		/** @var In general, class properties in PHP are defined as public, private, 
		or protected, not unlike other object-oriented languages.  [TODO - flesh this out] */
		private $con = false;
		private $data = array();

		public function __construct() {
			$this->con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
			
			if(mysqli_connect_errno()) {
				die("DB connection failed:" . mysqli_connect_error());
			}
		}
		/**
		 * Given an optional query string and a table name retrieve 
		 * the given data - in the event the query string is not present
		 * execute a SELECT * query on the given table - this may or may
		 * not be a reasonable default depending on the size of the table
		 * @param  [string] $sql   	A query string or null (default)
		 * @param  [string] $table  A table name
		 */
		public function queryDatabase($sql=null, $table) {
			if($sql == null) {
				$sql = "SELECT * FROM " . $table;
				$qry = $this->con->query($sql);
				if($qry->num_rows > 0) {
					while($row = $qry->fetch_object()) {
						$this->data[] = $row;
					}
				} else {
					$this->data[] = null;
				}
			}
			else {
				$qry = $this->con->query($sql);
				if($qry->num_rows > 0) {
					while($row = $qry->fetch_object()) {
						$this->data[] = $row;
					}
				} else {
					$this->data[] = null;
				}
			}

		}
		/**
		 * Execute the given query, close the connection and return the data
		 * @param  [string] 	$sql   [description]
		 * @param  [string] 	$table [description]
		 * @return [type]        [TODO - find out type]
		 */
		public function executeQuery($sql=null, $table) {
			$this->queryDatabase($sql, $table);
			$this->con->close();
			return $this->data;
		}
	}
?>
