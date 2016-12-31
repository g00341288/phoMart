<?php
	/** Turn on output buffering - output buffering is off by default
	Without it, HTML is sent over the wire piecemeal. With it, HTML
	is stored in a variable and sent to the browser all in one chunk
	at the end of the script. This improves performance and reduces the
	number of requests.*/
	ob_start();

	/**
	 * Create a session or resume the current one based on a session identifier passed
	 * via GET or POST request or passed via cookie. 
	 */
	session_start();

	/** Like include, and require, require_once includes and evaluates a given file.
	require_once, however, checks first if the file has been included and if not 
	attempts to do so. db/config.php opens a connection to the MySQL server.*/
	require_once 'db/config.php';
	
	/** Check if the $_SESSION array contains key ('user'). $_SESSION is an associative array 
	containing session variables on the current script. If it is set, send a raw HTTP 
	header identifying the location, back to the browser.   */
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: index.php");
		exit;
	}
	
	$error = false;
	
	/**
	 * $_POST is an associative array of variables passed to the current
	 * script via the HTTP POST method. If the login button is pressed, 
	 * this will set a key/value pair corresponding to the button with 
	 * name=btn-login, and this code will execute where that is true. 
	 * Content of input elements and other potentially toxic input 
	 * is digested and stripped of whitespace, HTML, PHP tags and 
	 * other junk to prevent SQL injection. Also, special characters are
	 * converted to HTML entities.  
	 */
	if( isset($_POST['btn-login']) ) {	

		
		// clean user input
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		/** Check if $email is empty, if it is, set $emailError
		Note, for empty(), a variable is considered empty if it does
		not exist or if its value equals FALSE. */
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} 
		// else if the email is not valid 
		else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		/** Check if $pass is empty - a variable is considered empty if it does
		not exist or if its value equals FALSE. */
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			/** @var Encrypt the given password using the sha256 hashing algorithm, a cryptographic
			function that is relatively strong relative to other members of the SHA family. That being
			said, they are susceptible to brute-force attacks, as general purpose hashes typically are.
			It is used here for demonstration purposes only and is probably not suitable for a production
			grade application. */
			$password = hash('sha256', $pass);
		
			/** @var Send a MySQL query to get the user id, username, and password from the 
			user table where the email field matches the given email, and store the returned resource
			in $res to be manipulated by mysql_fetch_array.*/
			$res=mysqli_query($con, "SELECT user_id, username, password FROM user WHERE email='$email'");

			/** @var Fetch the result row */
			$row=mysqli_fetch_array($res);

			/** @var if the username/password is correct this returns 1 row */
			$count = mysqli_num_rows($res); 
			
			/** @var If the username/password is correct */
			if( $count == 1 && $row['password']==$password ) {
				/** Set up a session for the given user */
				$_SESSION['user'] = $row['user_id'];
				/** Redirect to the home page */
				header("Location: index.php");
			} else {
				/** @var Otherwise set $errMSG for presentation in the DOM */
				$errMSG = "Incorrect credentials. Please try again...";
			}
				
		}
		
	}
?>
<!DOCTYPE html>
<html>
	<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sign In</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

	<body>

		<div class="container">

			<div id="login-form">
		    
		    <!-- $_SERVER is an array with information such as headers, paths and script locations, created by 
		    the server. PHP_SELF identifies the currently executing script. -->
		    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
		    	
		    	<div class="col-md-12">

		      	<div class="form-group">
		        	<h2 class="">Sign In</h2>
		        </div>
		      
		      	<div class="form-group">
		          <hr />
		        </div>
		            
		        <!-- If there is an error present an error message in the DOM -->
			      <?php

						if ( isset($errMSG) ) {
							
						?>

						<div class="form-group">

			      	<div class="alert alert-danger">

			      	<span class="glyphicon glyphicon-info-sign"></span> 

			      	<?php echo $errMSG; ?>

			        </div>

		      	</div>

			      <?php } ?>
			            
			      <div class="form-group">

			      	<div class="input-group">

			          <span class="input-group-addon">
			          	<span class="glyphicon glyphicon-envelope"></span>
			          </span>

			      		<input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
			        </div>
								<!-- Display email error message -->
			          <span class="text-danger">
			          	<?php echo $emailError; ?>
			          </span>


			      </div>
			            
			      <div class="form-group">

			      	<div class="input-group">

			          <span class="input-group-addon">
			          	<span class="glyphicon glyphicon-lock"></span>
			          </span>

			      		<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />

			       	</div>
								<!-- Display password error message -->
			          <span class="text-danger">
			          	<?php echo $passError; ?>
			          </span>

			      </div>
			            
			      <div class="form-group">
			      	<hr />
			      </div>
			      
			      <div class="form-group">
			      	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
			      </div>
			      
			      <div class="form-group">
			      	<hr />
			      </div>
			      
			      <div class="form-group">
			      	<a href="register.php">Sign Up Here</a>
			      	<a class="pull-right" href="index.php">Browse</a>
			      </div>
		        
		      </div>
		   
		    </form>
		  </div>	

		</div>

		<!-- Include the main site scripts template (script sources)-->
		<?php include('templates/scripts.php') ?>
		
		 <!-- Include the main site footer template -->
		<?php include('templates/footer.php') ?>

	</body>
	
</html>
<!-- Flush the output buffer and turn off output buffering -->
<?php ob_end_flush(); ?>