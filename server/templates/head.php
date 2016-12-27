<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <!-- Extract the username from the fetched result row, and display-->
  <title>Welcome - <?php echo $userRow['username']; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/cart.css" type="text/css"/>
  <script src="assets/jquery-1.11.3-jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="../bower_components/angular/angular.js"></script>
  <script src="../client/app.js"></script>
  <script src="../bower_components/angular-cookies/angular-cookies.js"></script>
  <script src="../client/services.js"></script>
  <script src="../client/controllers.js"></script>
  <script src="../client/controllers/homeController.js"></script>
  <script src="../client/controllers/navController.js"></script>
  <script src="../client/controllers/cartController.js"></script>
  <script src="../client/services/productService.js"></script>
  <script src="../client/services/sessionService.js"></script>
  <script src="../client/services/utilityService.js"></script>
  <script src="../client/services/navCartService.js"></script>
  <script src="../client/services/cartService.js"></script>
  <script src="../client/vanillaJS/domr.js" defer></script>
  <script src="../client/vanillaJS/vanillaJSCartManager.js" defer></script>

  </head>