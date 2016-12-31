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

  
	
	/** If session is set ... */
	if( isset($_SESSION['user']) ) {

    /** Like include, require, and require_once include and evaluate a given file.
    require_once, however, checks first if the file has been included and if not 
    attempts to do so. db/config.php opens a connection to the MySQL server.*/
    require_once 'db/config.php';

    /** @var Get logged in users details from MySQL user table  */
    $res=mysqli_query($con, "SELECT * FROM user WHERE user_id=".$_SESSION['user']);

    /** @var Fetch the result row */
    $userRow=mysqli_fetch_array($res);

    /** Close the connection */
    mysqli_close($con); 
   
	}
  else {
    $userRow['username'] = " there!";
  }

  
?>

  <!-- Include the main site head template -->
  <?php include('templates/head.php') ?>

  <body ng-app="phoMart">
  
    <!-- Include the main site nav template -->
    <?php include('templates/nav.php') ?>

    <!-- Use Angular's ng-cloak directive to prevent flashes of unstyled content -->
  	<div id="wrapper" ng-cloak>

    	<div class="container">
        
      	<div class="page-header text-center">

      	 <h3>Now Available</h3>

      	</div>
          
        <div class="row">

          <!-- Wire up Angular phoMart controller -->
          <div ng-controller="HomeController" >

            <div class="container">

              <div ng-repeat="product in products">

                <div class="clearfix" ng-if="$index % 3 == 0"></div>

                <div class="col-sm-4">

                  <div class="row">
                    <div class="center-block" >
                      <img class="img-responsive" src="{{ product.image_0 }}" alt="Product image" />
                    </div>
                  </div>
                    
                  <div class="row">

                    <div class="col-sm-5">

                      <strong>{{ product.name }}</strong>

                    </div>

                    <div class="col-sm-7">

                      <h5 class="pull-left">{{ product.price | currency:'€' }}</h5>
                      <button type="button" class="btn btn-default pull-right" ng-click="addToCart(product)">Add to Cart</button>

                    </div>
                      
                  </div>

                </div>
                  
              </div>

            </div>

          </div>
        
        </div>

      </div>
        
        <section style="text-align:center; margin:10px auto;"><p>Designed by <a href="http://enfoplus.net">Prince J. Sargbah</a></p></section>>
    </div>
    
    <!-- Include the main site scripts template (script sources)-->
    <?php include('templates/scripts.php') ?>
    
     <!-- Include the main site footer template -->
    <?php include('templates/footer.php') ?>
      
  </body>
</html>
<?php ob_end_flush(); ?>