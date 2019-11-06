<?php
    // if (!isset($_SERVER['PHP_AUTH_USER'])) {
    //     header('WWW-Authenticate: Basic realm="My Realm"');
    //     header('HTTP/1.0 401 Unauthorized');
    //     echo 'Text to send if user hits Cancel button';
    //     exit;
    // } else {
    //     echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    //     echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
    // }

    if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
	{
		$username = $_SERVER['PHP_AUTH_USER'];
		$password = $_SERVER['PHP_AUTH_PW'];

		

		if ($_SERVER['PHP_AUTH_USER'] == $username && $_SERVER['PHP_AUTH_PW'] == $password){
			echo "You are now logged in";
		}	
		else die("Invalid username / password combination");
	}
	else
	{
		header('WWW-Authenticate: Basic realm="Restricted Section"');
		header("HTTP/1.0 401 Unauthorized");
		die ("Please enter your username and password");
	}

?>