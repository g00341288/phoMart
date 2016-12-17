<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <!-- Extract the username from the fetched result row, and display-->
  <title>Welcome - <?php echo $userRow['username']; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
  <link rel="stylesheet" href="style.css" type="text/css" />
  <script src="assets/jquery-1.11.3-jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="../bower_components/angular/angular.js"></script>
  <script src="../client/app.js"></script>
  <script src="../client/services.js"></script>
  <script src="../client/controllers.js"></script>
  <script src="../client/phoMartServices.js"></script>
  </head>