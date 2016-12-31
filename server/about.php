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
      
      <div class="page-header text-center"> 
      
        <div class="jumbotron">
          <div class="container">
            <h3>About this Site</h3>
          </div>
        </div>

      </div>
      
      <!-- About content here -->
      <div id="aboutContainer" class="row" >

      <div class="col-md-6">
        <section>
          <p>This site is a web application built with JavaScript, HTML, CSS, AngularJS, PHP and MySQL. It is submitted in partial fulfillment of the requirements for the Web Application Development module of the BSc in Web Technologies and Programming at GMIT (2016). </p>
          <p>To install and run the application you will need to have an appropriate development environment. You will need a working HTTP server, a database, and a language interpreter for PHP at a minimum. XAMPP or WAMP are suitable choices. XAMPP, much like WAMP, combines the Apache HTTP server, a MySQL database (MariaDB), and a selection of interpreters for scripts written in several languages, including PHP and Perl. XAMPP also comes bundled with phpMyAdmin a dashboard front-end to MySQL/MariaDB. The default XAMPP installation should be appropriate for this purpose. If you have not installed it already, you can find XAMPP here.</p>
          <p>You will also need to install the bower package manager to set up the project's client module dependencies. This can be installed with npm the NodeJS package manager. Ideally, you should have git and NodeJS installed before proceeding.
          </p>
        </section>
      </div>

      <div class="col-md-6">
        <section>
          <div>
            <ul class="list-group">
              <li class="list-group-item active">Development Environment</li>
              <li class="list-group-item">XAMPP/WAMP</li>
              <li class="list-group-item">NodeJS</li>
              <li class="list-group-item">Bower</li>
              <li class="list-group-item">Git</li>
              <li class="list-group-item">Programmer's Editor/IDE</li>
              <li class="list-group-item">Web Browser (Chrome or Firefox are best)</li>
            </ul>
          </div>
        </section>
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
  <?php ob_end_flush(); 