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
      
      <h3 class="pull-right">Contact me at: <small>leonard.reidy@gmail.com</small></h3>
      <div class="page-header">
        
      </div>
      
      <!-- Contact content here -->
      <div id="contactContainer" class="row" >

      <div class="row">
        <div class="text-center col-md-5">
          <div>
            <h2 class="about-title">Front-End Dev</h2>
          </div>
          <div class="about-box">
              <img src="https://media.licdn.com/mpr/mpr/shrink_100_100/AAEAAQAAAAAAAAlZAAAAJDljOTNhYjQ2LWM0MzYtNGNlNi04YjQ2LTJkYzYyZjZmZWJiMQ.jpg" class="about-img img-circle">
          </div>
          <div>
            <h3 class="about-subtitle">Leonard M Reidy <br> 
              <small>BA, BSc, MA</small>
            </h3>

          </div>
          <div class="btn-group" role="group" aria-label="Basic example">
              <a href="https://www.linkedin.com/in/leonardmreidy" title="Take me to LinkedIn" type="button" class="btn btn-primary btn-primary-border"><i class="fa fa-linkedin"></i></a>
              <a href="https://github.com/leonardreidy" title="Take me to Github" type="button" class="btn btn-primary btn-primary-border"><i class="fa fa-github"></i></a>
              <a href="https://gist.github.com/leonardreidy" title="Take me to Gisthub" type="button" class="btn btn-primary"><i class="fa fa-github-alt"></i></a>
          </div>

        </div>
        <div class="col-md-7">
          <div>
            <h2>Bio</h2>
            <p class="about-p"> </p><p>I am currently completing a <em>BSc in Web Technologies and Programming</em> at Galway-Mayo Institute of Technology (GMIT), in Galway, Ireland. I have also completed degrees in Sociology and Philosophy at University College Cork, and I have a professional background in higher education and institutional research. I learned to code while I was a research analyst for Postsecondary Analytics, LLC in Florida, where I wrote short ad hoc scripts in Python, Ruby, JavaScript, PHP, and R to solve a variety of everyday business problems, reduce research costs, and prototype bespoke data visualisations for a range of clients from small private postsecondary institutions and non-profits to interstate commissions and national higher education associations. When I returned from the states, I completed two Oracle Java certifications and enrolled in the degree at GMIT. I love software development, and I can imagine no happier life than one that revolves around solving the problems and challenges that constitute the daily work of a developer!</p>
       <p></p>
          </div>
          <div>
            <h2>Hiring? </h2>
            <p class="about-p">I am actively seeking a role as a junior front-end web developer with a view to full-stack development. I am also open to work placements/internships in either a full-time or part-time capacity. Why not explore the site to find out more or check out my work on Github, Gisthub, and LinkedIn!</p>
          </div>
          <hr>
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
  <?php ob_end_flush(); 