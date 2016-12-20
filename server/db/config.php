<?php
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'wad');

	class DB {
		private $con = false;
		private $data = array();

		public function __construct() {
			$this->con = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
			
			if(mysqli_connect_errno()) {
				die("DB connection failed:" . mysqli_connect_error());
			}
		}

		public function qryPop() {
			$sql = "SELECT * FROM `product`";
			$qry = $this->con->query($sql);
			if($qry->num_rows > 0) {
				while($row = $qry->fetch_object()) {
					$this->data[] = $row;
				}
			} else {
				$this->data[] = null;
			}
			//$this->con->close(); find out when to perform the close call, as it stands this throws a mysqli error
		}

		public function qryFire($sql=null) {
			if($sql == null) {
				$this->qryPop();
			} else {
				$this->con->query($sql);
				$this->qryPop();	
			}
			$this->con->close();
			return $this->data;
		}
	}
?>
