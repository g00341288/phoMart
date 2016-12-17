<?php
  /** Turn on output buffering - output buffering is off by default
  Without it, HTML is sent over the wire piecemeal. With it, HTML
  is stored in a variable and sent to the browser all in one chunk
  at the end of the script. This improves performance and reduces the
  number of request necessary. */
	ob_start();

    /**
   * Create a session or resume the current one based on a session identifier passed via GET or POST request or passed via cookie. 
   */
	session_start();

  /** Like include, require, and require_once include and evaluate a given file.
  require_once, however, checks first if the file has been included and if not 
  attempts to do so. dbconnect.php opens a connection to the MySQL server.*/
	require_once 'dbconnect.php';
	
	/** If session is not set, redirect to the login page (index.php) */
	if( !isset($_SESSION['user']) ) {
    /** Send a raw HTTP header with the given location */
		header("Location: index.php");
		exit;
	}
	
  /** @var Get logged in users details from MySQL user table  */
	$res=mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['user']);

  /** @var Fetch the result row */
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Welcome - <?php echo $userRow['username']; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
  <link rel="stylesheet" href="style.css" type="text/css" />
  </head>

  <body>
    <!-- Set up responsive navbar -->
  	<nav class="navbar navbar-default navbar-fixed-top">

      <div class="container">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>

          <a class="navbar-brand" href="">phoMart</a>

        </div>

        <div id="navbar" class="navbar-collapse collapse">

          <ul class="nav navbar-nav">

            <li class="active">
              <a href="">About</a>
            </li>
            <li>
              <a href="">Contact</a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <!-- <form class="" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <div class="form-group">
                <select ng-model="$ctrl.orderProp" class="btn btn-defaultng-valid ng-not-empty ng-dirty ng-valid-parse ng-touched" style="">
                  <option value="name">Alphabetical</option>
                  <option value="age">Newest</option>
                </select>
              </div>
            </form> -->
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            
            <!-- Extract the username from the fetched result row, and display-->
			       <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span>
             </a>

              <ul class="dropdown-menu">
                <li>
                  <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Cart</a>
                </li>
                <li>
                  <a href="checkout.php"><span class="glyphicon glyphicon-euro"></span>&nbsp;Checkout</a>
                </li>
                <li>
                  <a href="register.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Register</a>
                </li>
                <li>
                  <a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
                </li>
              </ul>

            </li>

          </ul>

        </div><!--/.nav-collapse -->

      </div>

    </nav> 

  	<div id="wrapper">

    	<div class="container">
        
      	<div class="page-header">

      	 <h3>Welcome to my store!</h3>

      	</div>
          
        <div class="row">

          <div class="col-lg-12">
            <h1>Templates should go here.</h1>
          </div>

        </div>
        
      </div>
      
    </div>
      
    <!-- [TODO] A newer version? -->
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
      
  </body>
</html>
<?php ob_end_flush(); ?>