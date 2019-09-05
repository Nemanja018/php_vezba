<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "baza";

    global $conn;

    $conn = new mysqli($servername, $username,
        $password, $database);

    if($conn->connect_error)
    {
        die("Unsuccessful connection! Reason: "
            . $conn->connect_error);
    }

    $conn->set_charset('utf8');