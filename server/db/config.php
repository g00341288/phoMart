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
		or protected, not unlike other object-oriented languages.  [description] */
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
		 * the given ata
		 * @param  [type] $sql   a query string or null (default)
		 * @param  [type] $table a table name
		 */
		public function retrieveData($sql=null, $table) {
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

		public function executeQuery($sql=null, $table) {
			$this->retrieveData($sql, $table);
			$this->con->close();
			return $this->data;
		}
	}
?>
