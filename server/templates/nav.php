 <!-- Set up responsive navbar -->
  	<nav class="navbar navbar-default navbar-fixed-top" ng-controller="NavController" ng-cloak>

      <div class="container">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>

          <a class="navbar-brand active" href="index.php">phoMart</a>

        </div>

        <div id="navbar" class="navbar-collapse collapse">

          <ul class="nav navbar-nav">

            <!-- If the mouse is hovering over the link, an animate.css class is applied to the element
            to draw the users attention -->
            <li class="<?php if(pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME) == 'about'){echo 'active'; } ?>" >
              <a ng-class="{'animated pulse infinite':hovering}" ng-mouseenter="hovering=true" ng-mouseleave="hovering=false" href="about.php">About</a>
            </li>
            <!-- If the mouse is hovering over the link, an animate.css class is applied to the element
            to draw the users attention -->
            <li class="<?php if(pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME) == 'contact'){echo 'active'; } ?>">
              <a ng-class="{'animated pulse infinite':hovering}" ng-mouseenter="hovering=true" ng-mouseleave="hovering=false" href="contact.php">Contact</a>
            </li>
            <li>
              <a title="Project Github Repo" href="https://github.com/g00341288/g00341288_LReidy_WAD"><i class="fa fa-lg fa-github"></i></a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li>
               
            </li>
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                <span ng-hide="cartEmpty">
                  <span class="glyphicon glyphicon-shopping-cart"></span>
                  <span ng-model="cart" class="items">&nbsp;({{cart.quantity}})&nbsp;</span>
                </span>

                <!-- Extract the username from the fetched result row, and display-->
    			       <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Hi <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span>
               </a>

              <ul class="dropdown-menu">
              <!-- Show cart link in dropdown, only if the current page is not the cart page -->
                <li ng-model="cart"><?php 
                  if(pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME) != 'cart'){
                    echo '<a href="cart.php"><span class="glyphicon glyphicon-shopping-cart items"></span>
                  &nbsp;Cart({{cart.quantity}})</a>'; } ?>
                  
                </li>
                <li>
                  <a href="checkout.php"><span class="glyphicon glyphicon-euro"></span>&nbsp;Checkout</a>
                </li>
                <li>
                  <a href="register.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Register</a>
                </li>
                <li>
                <?php   /** If session user is not set, display sign in link, otherwise display sign out link */
                if( !isset($_SESSION['user']) ) {
                  echo "<a href='sign-in.php'><span class='glyphicon glyphicon-log-in'></span>&nbsp;Sign In</a>";
                }
                else {
                  echo "<a href='logout.php?logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Sign Out</a>";
                }?>
                </li>
              </ul>

            </li>

          </ul>

        </div><!--/.nav-collapse -->

      </div>

    </nav>