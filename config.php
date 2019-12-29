<?php
    $db_user = "root";
    $db_password = "";
    $db_name = "mydb";
    $db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_password);
    //Gives info for encountered problems
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
