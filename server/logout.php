<?php

	/**
	* Create a session or resume the current one based on a session identifier passed via GET or POST request or passed via cookie. 
	*/
	session_start();
	
	/** If the session is set, redirect to index.php */
	if (!isset($_SESSION['user'])) {


		header("Location: index.php");

	/** otherwise redirect to home.php */
	} else if(isset($_SESSION['user'])!="") {

		header("Location: home.php");

	}
	/** If the user has logged out, */
	if (isset($_GET['logout'])) {

		/** unregister the user session variable */
		unset($_SESSION['user']);

		/** free all currently registered session variables */
		session_unset();

		/** and destroy all data associated with the current session 
		WARNING - immediate session deletion may cause unwanted results. 
		When there are concurrent requests, other connections may see sudden session data loss. 
		This will directly and adversely affect JS requests and/or requests from URLs [TODO - review]*/
		session_destroy();


		/** Send a raw HTTP header identifying the location back to the browser. */
		header("Location: index.php");
		exit;
	}