<?php

// production
// $servername = "sql311.epizy.com";
// $databasename = "epiz_30592837_webblog_db";
// $username = "epiz_30592837";
// $password = "NOsVIVC09nT6Gp";

// development
$servername = "localhost";
$databasename = "webblog_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
