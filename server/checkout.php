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
  require_once 'db/config.php';
  
  /** If session is not set, redirect to the login page (index.php) */
  if( !isset($_SESSION['user']) ) {
    /** Send a raw HTTP header with the given location */
    header("Location: index.php");
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

  <div id="wrapper">

    <div class="container">
      
      <div class="row">
        <div class="col-md-12">
          <h3>Your Order</h3>
        </div>
      </div>
      
      <!-- Order summary here - identify the Angular Controller for the div, and set the user_id property
      of the order object on the scope of the controller -->
      <div id="orderContainer" class="row" ng-controller="CheckoutController" ng-init="order.user_id=<?php echo $userRow['user_id'];?>">
      
        <div class="col-md-12" ng-init="">
          
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Phomart Order Summary</h3>
              <div class="btn-group pull-right" role="group" aria-label="...">
                <button type="button" class="btn btn-default" ng-click="back()">Back</button>
                <button type="button" class="btn btn-default" ng-click="proceed()">Proceed</button>
              </div>
              <!-- Display the user's first name and surname, if available, otherwise, display the user's username -->
              <h3 class="panel-title">Customer: <?php if($userRow['firstname'] != NULL AND $userRow['surname'] != NULL) {echo $userRow['firstname']." ".$userRow['surname'];} else {echo $userRow['username']; } ?></h3>
              <!-- Display the session id as an order reference id - the order table includes an attribute that corresponds to this to facilitate queries that might be made against the database later by a customer
              service agent -->
              <h5 class="panel-title">Order Reference ID: <?php echo session_id(); ?>
              </h5>
              <!-- Display the current date -->
              <h5 class="panel-title">Date: <?php echo date('d/m/Y', time()); ?></h5>
              
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Unit Price</th>
                  <th>Subtotal</th>
                </thead>
                <tbody>
                  <tr ng-repeat="item in order.items">
                    <td>
                      <a href="home.php">
                        <img class="img-thumbnail" title="{{item.additional_features}}" src="{{item.image_0}}" style="width: 60px; height: auto">
                      </a>
                    </td>
                    <td class="muted center_text">{{item.name}}</td>
                    <td class="muted center_text">{{item.price | currency : "€"}}</td>
                    <td class="muted center_text">{{getRunningTotal($index) | currency : "€"}}</td>
                  </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td><em>Total:</em> </td>
                    <td>{{order.total | currency : "€" }}</td>
                  </tr>
                  <tr>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"><em>VAT(at {{(order.vatRate)*100}}%):</em></td>
                    <td style="border: none">{{order.total * order.vatRate | currency : "€"}}</td>
                  </tr>

                  <tr>
                    <td style="border: none"></td>
                    <td style="border: none"></td>
                    <td style="border: none"><em>Grand Total:</em></td>
                    <td style="border: none">{{getTotalPlusVat(order.total, order.vatRate) | currency : "€"}}</td>
                  </tr>
                </tbody>

              </table>
              
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