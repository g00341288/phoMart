<?php
  /** Turn on output buffering - output buffering is off by default
  Without it, HTML is sent over the wire piecemeal. With it, HTML
  is stored in a variable and sent to the browser all in one chunk
  at the end of the script. This improves performance and reduces the
  number of requests necessary. */
  ob_start();

    /**
   * Create a session or resume the current one based on a session identifier 
   * passed via GET or POST request or passed via cookie. 
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
  $res = mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['user']);

  /** @var Fetch the result row */
  $userRow = mysql_fetch_array($res);

  /** Get and store session id */
  $sessionId = session_id();

?>

<!-- Include the main site head template -->
<?php include('templates/head.php') ?>

<body ng-app="phoMart">

  <!-- Include the main site nav template -->
  <?php include('templates/nav.php') ?>

  <div id="wrapper">

    <div class="container">
      
      <div class="row">
        <div class="col-md-12">
          <h3>Payment Details</h3>
        </div>
      </div>
      
      <!-- Payment form container row - identify the Angular Controller for the div -->
      <div id="paymentFormContainer" class="row" ng-controller="PaymentFormController">
      
        <!-- Payment form column -->
        <div class="col-md-12" ng-init="">

        <!-- Display template content conditionally - if the order exists, the payment form is 
        displayed, otherwise, a warning template is displayed -->
          <?php 
            $query = "SELECT * FROM _order WHERE reference_id=" . $sessionId . " LIMIT 1;";

            /** Check that an order exists for this session! */
            $res=mysql_query("SELECT * FROM _order WHERE reference_id='" . $sessionId . "' LIMIT 1;"); 
            $num_rows = mysql_num_rows($res); 

            /** If there is an order for this session */
            if($num_rows > 0){
              // populate the page with the payment form template
              include 'templates/paymentForm.php';
            }
            else {
              // populate the page with the warning template
              include 'templates/paymentFormWarning.php';
              
            }
          ?>

      </div>

    </div>

  </div>
  