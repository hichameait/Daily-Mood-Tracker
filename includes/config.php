<?php

    $db_user = "root";
    $db_pass = "";
    $db_name = "mood_tracker";
    $db_host = "localhost";

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $er) {
        $code = "Error : {$er->getMessage()}";
    }
?>

