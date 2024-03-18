<?php

    $host = "localhost";
    $dbname = "moviemania";
    $user = "root";
    $pass = "";

    $conn = new PDO("mysql:dbname=$dbname;host=$host", $user, $pass);

    // Habilitar erros PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);