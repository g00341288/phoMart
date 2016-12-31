<?php
	/** Turn on output buffering - output buffering is off by default
	Without it, HTML is sent over the wire piecemeal. With it, HTML
	is stored in a variable and sent to the browser all in one chunk
	at the end of the script. This improves performance and reduces the
	number of request necessary.*/
	ob_start();

	/**
	 * Create a session or resume the current one based on a session identifier passed
	 * via GET or POST request or passed via cookie. 
	 */
	session_start();

	/** Check if the SESSION array contains key ('user'). This is an associative array 
	containing session variables 	on the current script. If it is set, send a raw HTTP 
	header identifying the location, back to the browser.   */
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}

	/** Like include, include_once evaluates a given file, but like require_once, 
	only if it hasn't been included already. */
	include_once 'db/config.php';

	/** @var set an error boolean for use in conditional logic later in the script */
	$error = false;

	/**
	 * $_POST is an associative array of variables passed to the current
	 * script via the HTTP POST method. If the signup button is pressed, 
	 * this will set a key/value pair corresponding to the button with 
	 * name=btn-signup, and this code will execute where that is true. 
	 * Content of input elements and other potentially toxic input 
	 * is digested and stripped of whitespace, HTML, PHP tags and 
	 * other junk to prevent SQL injection before it is consumed by the
	 * server. Also, special characters are converted to HTML entities.  
	 */
	if ( isset($_POST['btn-signup']) ) {
		
		/** @var Trim whitespace  */
		$name = trim($_POST['name']);
		/** @var Strip HTML and PHP tags from the given string */
		$name = strip_tags($name);
		/** @var Convert special characters to HTML entities */
		$name = htmlspecialchars($name);
		
		/** @var Trim whitespace  */
		$email = trim($_POST['email']);
		/** @var Strip HTML and PHP tags from the given string */
		$email = strip_tags($email);
		/** @var Convert special characters to HTML entities */
		$email = htmlspecialchars($email);
		
		/** @var Trim whitespace  */
		$pass = trim($_POST['pass']);
		/** @var Strip HTML and PHP tags from the given string */
		$pass = strip_tags($pass);
		/** @var Convert special characters to HTML entities */
		$pass = htmlspecialchars($pass);
		
		/** basic name validation: if no name is given */
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
			/** else if the given name is less than 3 characters in length */
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have at least 3 characters.";
			/** else if a regular expression match against the given name 
			identifies invalid characters (non-alphanumeric characters 
			and/or non-spaces) */
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphanumeric characters and/or spaces.";
		}
		
		/** If email address is invalid */
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			/** @var Check that the given email exists in the database user table */
			$query = "SELECT email FROM user WHERE email='$email'";
			$result = mysqli_query($con, $query);
			$count = mysqli_num_rows($result);
			/** If it doesn't store an error message for use later */
			if($count!=0){
				$error = true;
				$emailError = "That email address is already in use.";
			}
		}
		// password validation: if no password has been entered or the password
		// has fewer than six characters, store an error message for display
		// in the DOM
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have at least 6 characters.";
		}
		
		// Encrypt using SHA256() hashing algorithm;
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			/** @var Construct a SQL query to insert the new user into the user table */
			$query = "INSERT INTO user(username,email,password) VALUES('$name','$email','$password')";
			
			/** @var Send the query to the currently active database */
			$res = mysqli_query($con, $query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "WARNING...";
				$errMSG = "Something went wrong. Please try again later!";	
			}	
				
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
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
	            	<h2 class="">Sign Up</h2>
	            </div>
	        
	        	<div class="form-group">
	            	<hr />
	            </div>
	            
	      <?php
				if ( isset($errMSG) ) {
					
					?>
						<div class="form-group">
						<!-- PHP ternary, equivalent to: 
						if($errTyp == "success")
							{ echo "success"; } 
							else { 
								echo $errTyp; 
							} -->
		            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
						<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
		                </div>
		            	</div>
	                <?php
				}
				?>
	            
	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
	            	<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
	                </div>
	                <span class="text-danger"><?php echo $nameError; ?></span>
	            </div>
	            
	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
	            	<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
	                </div>
	                <span class="text-danger"><?php echo $emailError; ?></span>
	            </div>
	            
	            <div class="form-group">
	            	<div class="input-group">
	                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
	            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
	                </div>
	                <span class="text-danger"><?php echo $passError; ?></span>
	            </div>
	            
	            <div class="form-group">
	            	<hr />
	            </div>
	            
	            <div class="form-group">
	            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
	            </div>
	            
	            <div class="form-group">
	            	<hr />
	            </div>
	            
	            <div class="form-group">
	            	<a href="index.php">Sign in Here</a>
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
<?php ob_end_flush(); ?>