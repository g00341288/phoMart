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

  <!-- The Angular ng-app directive is used to auto-bootstrap an Angular Application -->
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

          <!-- Wire up phoMart Home page AngularJS controller -->
          <div ng-controller="HomeController" >

            <div class="container">

              <div ng-repeat="product in products">
                

                <div class="clearfix" ng-if="$index % 3 == 0"></div>

                <!-- Angular's ng-switch directive is used to conditionally swap out DOM structure
                in a template based on a scope expression. When the revealed property is true, 
                the div block immediately below will display, when it is false, the following 
                block will display. The revealed property value is toggled by the info button. 
                Note that this directive creates its own scope, hence the reference to the parent! --> 
                <div class="col-sm-6 col-md-4" ng-switch on="$parent.revealed">

                  <div class="thumbnail animated fadeOut flipInY" ng-switch-when="true">
                    <img src="{{ product.image_0 }}" alt="Image of {{product.name}}">
                    <div class="caption">

                      <div>
                        <h3>{{product.name}}</h3>
                        <p>{{product.description}}</p>
                      </div>

                        <p>
                          <button ng-click="reveal()" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-info-sign"></span></button> 
                          <button ng-click="addToCart(product)" class="btn btn-default" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;{{ product.price | currency:'€' }}</button>
                        </p>
                      
                    </div>
                  </div>

                  <div class="thumbnail animated fadeIn flipInY" ng-switch-when="false">

                    <div class="row">
                      <div class="col-md-4">
                        <img class="img img-responsive img-thumbnail" src="{{product.image_1}}" alt="Image of {{product.name}}">
                      </div>
                      <div class="col-md-4">
                        <img class="img img-responsive img-thumbnail" src="{{product.image_2}}" alt="Image of {{product.name}}">
                      </div>
                      <div class="col-md-4">
                        <img class="img img-responsive img-thumbnail" src="{{product.image_3}}" alt="Image of {{product.name}}">
                      </div>
                    </div>

                    <div class="caption">

                      <div>
                        <ul class="list-group">
                          <li class="list-group-item">Network Availability: {{product.availability}}</li>
                          <li class="list-group-item">Primary Camera: {{product.camera_primary}}</li>
                          <li class="list-group-item">Bluetooth: {{product.connectivity_bluetooth}}</li>
                          <li class="list-group-item">WiFi: {{product.connectivity_wifi}}</li>
                          <li class="list-group-item">Display Resolution: {{product.display_resolution}}</li>
                          <li class="list-group-item">Battery Standby Time: {{product.battery_standbytime}}</li>
                          <li class="list-group-item">Battery Talk Time: {{product.battery_talktime}}</li>
                        </ul>
                      </div>

                        <p>
                          <button ng-click="reveal()" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-info-sign"></span></button> 
                          <button ng-click="addToCart(product)" class="btn btn-default" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;{{ product.price | currency:'€' }}</button>
                        </p>
                      
                    </div>
                  </div>

                </div>
                  
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
</html>
<?php ob_end_flush(); ?>