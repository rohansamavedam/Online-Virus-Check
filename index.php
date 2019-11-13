<!-- Author: Krishna Rohan Samavedam -->
<?php
    echo <<<_START
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Online Antivirus Check</title>
        </head>
        <body>
            <a href="admin.php"><h3>Admin</h3></a> <br> <br>
            <form method='post' action='index.php' enctype='multipart/form-data' >
                Select File: <input type='file' name='uploadfileinput' size='10' >
                <input type='submit' value='Check for Malware'>
            </form>
_START;

    //PHP Code goes here.
    if($_FILES){

        require_once 'login.php';
	    require_once 'fatalerror.php';

        $conn = new mysqli($hn, $un, $pw, $db);

        if($conn->connect_error) die (mysql_fatal_error());

        $inputtype = $_FILES['uploadfileinput']['type'];
        if($inputtype == "text/plain"){
            $name = $_FILES['uploadfileinput']['name'];
            $fh = fopen($name, 'r') or die("File Does not exist");
            // Reading only the first 20 bytes.
            $filedata = file_get_contents($name, FALSE, NULL, 0, 20);
            fclose($fh);

            $query = "SELECT * FROM malwareFiles WHERE malwarecontent='$filedata'";
            $result = $conn->query($query);



            if (!$result) {
                echo "NO malware FOUND, FILE IS SAAFE <br>";
            }else{
                $rows = $result->num_rows;
                $malwarename;
                for($i = 0; $i < $rows; $i++){
                    $result->data_seek($i);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $malwarename = $row['filename'];
                }
                echo "<h1>INFECTED FILE: MALWARE FOUND OF TYPE: $malwarename</h1>";
                $result->close();
                $conn->close();
            }	
        }else{
            echo "Error: Please make sure you upload a .txt file.<br>";
        }
    }

    echo <<<_END
        </body>
        </html>
_END;

?>