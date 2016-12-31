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
  attempts to do so. db/config.php opens a connection to the MySQL server.*/
  require_once 'db/config.php';
  
  /** If session is not set, redirect to the login page (index.php) */
  if( !isset($_SESSION['user']) ) {
    /** Send a raw HTTP header with the given location */
    header("Location: sign-in.php");
    exit;
  }

  /** @var Get logged in users details from MySQL user table  */
  $res=mysqli_query($con, "SELECT * FROM user WHERE user_id=".$_SESSION['user']);

  /** @var Fetch the result row */
  $userRow=mysqli_fetch_array($res);

  /** Close the connection */
  mysqli_close($con);

?>

<!-- Include the main site head template -->
<?php include('templates/head.php') ?>

<body ng-app="phoMart">

  <!-- Include the main site nav template -->
  <?php include('templates/nav.php') ?>

  <!-- Use Angular's ng-cloak directive to prevent flashes of unstyled content -->
  <div id="wrapper" ng-cloak>

    <div class="container">
      
      <div class="row">
        <div class="col-md-12">
          <h3>Order Confirmation</h3>
        </div>
      </div>
      
      <!-- Order Confirmation summary here - identify the Angular Controller for the div, and set the user_id property
      of the order object on the scope of the controller -->
      <div id="orderConfirmationContainer" class="row" ng-controller="OrderConfirmationController" ng-init="order.user_id=<?php echo $userRow['user_id'];?>">
      
        <div class="col-md-12" ng-init="">
          
          <div class="alert alert-success" role="alert">
            Your order has been placed successfully!
          </div>

          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Thank you for shopping at phoMart!<span class="pull-right">Order ID: {{referenceIds.order_id}}</span></div>
            <div class="panel-body">
              <p> Please take note of the reference number below for your records:  </p>
              <p>Order Reference #: {{orderReferenceNumber}} </p>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>

  <!-- Include the main site scripts template (script sources)-->
  <?php include('templates/scripts.php') ?>
  
   <!-- Include the main site footer template -->
  <?php include('templates/footer.php') ?>
  
  </body>