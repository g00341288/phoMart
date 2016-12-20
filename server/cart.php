<?php
  /** Turn on output buffering - output buffering is off by default
  Without it, HTML is sent over the wire piecemeal. With it, HTML
  is stored in a variable and sent to the browser all in one chunk
  at the end of the script. This improves performance and reduces the
  number of request necessary. */
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
	$res=mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['user']);

  /** @var Fetch the result row */
	$userRow=mysql_fetch_array($res);
?>

<!-- Include the main site head template -->
<?php include('templates/head.php') ?>

<body ng-app="phoMart">

  <!-- Include the main site nav template -->
  <?php include('templates/nav.php') ?>

  <div id="wrapper">

    <div class="container">
      
      <div class="page-header text-center">

       <h3>Your Cart</h3>

      </div>
      
      <!-- Cart here -->
      <div class="row" ng-controller="CartController">

        <table class="table table-bordered table-striped">
          <thead>

            <tr>
              <th>Remove</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Total</th>
            </tr>

          </thead>

          <tbody>

            <tr ng-repeat="item in cart">

              <!-- Remove product checkbox -->
              <td class="">
                <input type="checkbox" value="true" id="optionsCheckbox">
              </td>

              <!-- Image -->
              <td class="muted center_text">
                <a href="home.php">
                  <img class="img-thumbnail" title="" src="{{item.image_0}}" style="width: 120px; height: auto">
                </a>
              </td>

              <!-- Product Name --> 
              <td>{{item.name}}</td>
              
              <!-- Item Quantity -->
              <td><input type="text" placeholder="{{getItemQty()}}" class="input-mini"></td>

              <!-- Unit Price -->
              <td>{{item.price} | currency: ''}</td>

              <!-- Item Total -->
              <td>{{item.price * item.qty}}</td>

            </tr> 

            <!-- Order Total -->
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              
              <td>
                <strong>{{cart.total}}</strong>
              </td>

            </tr>  

          </tbody>

        </table>

      </div>

    </div>

  </div>