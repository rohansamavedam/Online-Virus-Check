<!-- Author: Krishna Rohan Samavedam -->
<?php

	require_once 'login.php';
	require_once 'fatalerror.php';

	$conn = new mysqli($hn, $un, $pw, $db);

	if($conn->connect_error) die (mysql_fatal_error());

	// Code Commented Below is used to add an admin into the database. 

	// $n = "superadmin";
	// $s1 = "12@#!?";
	// $s2 = "mp&**&";
	// $hashedp =  hash('ripemd128', $s1."rohanthegreat".$s2);
	// $query = "INSERT INTO admins (username, salt1, salt2, passhash) VALUES ('$n', '$s1', '$s2', '$hashedp')";
	// $result = $conn->query($query);
	// if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";

	if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
	{
		$username = $_SERVER['PHP_AUTH_USER'];

		$query = "SELECT * FROM admins WHERE username='$username'";
		$result = $conn->query($query);

		if(!$result) die("Invalid username / password combination");

		$rows = $result->num_rows;

		$password = $_SERVER['PHP_AUTH_PW'];
		$salt1;
		$salt2;
		$hashtoken;

		for($i = 0; $i < $rows; $i++){
			$result->data_seek($i);
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$salt1 = $row['salt1'];
			$salt2 = $row['salt2'];
			$hashtoken = $row['passhash'];
		}

		$token = hash('ripemd128', $salt1.$password.$salt2);

		if ($_SERVER['PHP_AUTH_USER'] == $username && $token == $hashtoken){
			// When admin successfully logsin

			echo <<<_START
		<!doctype html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<title>Online Antivirus Check</title>
		</head>
		<body>
			<a href="index.php"><h3>Index</h3></a> <br> <br>
			<form method='post' action='admin.php' enctype='multipart/form-data' >
				Select Malware File: <input type='file' name='uploadfileinput' size='10' ><br>
				Malware Name: <input type="text" name="mname">
				<input type='submit' value='Upload'>
			</form>
_START;

			if($_FILES){
				$inputtype = $_FILES['uploadfileinput']['type'];
				if($inputtype == "text/plain" && $_POST["mname"] != ""){
					$name = $_FILES['uploadfileinput']['name'];
					$filename = $_POST["mname"];
					$fh = fopen($name, 'r') or die("File Does not exist");
					// Reading only the first 20 bytes.
					$filedata = file_get_contents($name, FALSE, NULL, 0, 20);
					fclose($fh);

					$query = "INSERT INTO malwareFiles (filename, malwarecontent) VALUES ('$filename', '$filedata')";
					$result = $conn->query($query);

					if (!$result) {
						echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
					}else{
						echo "Malware Upload Success! <br>";
					}	
				}else{
					echo "Error: Please make sure you upload a .txt file and provide the name in the name field. <br>";
				}
			}

	echo <<<_END
		</body>
		</html>
_END;
			$result->close();
			$conn->close();
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