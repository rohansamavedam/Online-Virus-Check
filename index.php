<?php
    echo <<<_START
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Online Antivirus Check</title>
        </head>
        <body>
            <form method='post' action='index.php' enctype='multipart/form-data' >
                Select File: <input type='file' name='uploadfileinput' size='10' >
                <input type='submit' value='Upload'>
            </form>
_START;

    //PHP Code goes here.

    echo <<<_END
        </body>
        </html>
_END;

?>