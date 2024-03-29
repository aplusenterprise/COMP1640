<?php
// REFERENCE CODE: http://php.net/session_destroy
	// Initialize the session.
	// If you are using session_name("something"), don't forget it now!
	session_start();
	// Unset all of the session variables.
	$_SESSION = array();
	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie("accept-cookies", "", time() - 42000,);
	  
	}

	// Finally, destroy the session.
	if (session_destroy()) { // destroy all session data in storage
		header("Location: login.php"); // redirect to the Login page
		exit();
	}
?>