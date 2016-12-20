 <!-- Set up responsive navbar -->
  	<nav class="navbar navbar-default navbar-fixed-top" ng-controller="NavController">

      <div class="container">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>

          <a class="navbar-brand" href="home.php">phoMart</a>

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
            <li>
                <!-- <button class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> <span ng-model="cart" class="items">{{cart.quantity}}</span></button> -->
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
                <li ng-model="cart">
                  <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>
                  &nbsp;Cart({{cart.quantity}})</a>
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