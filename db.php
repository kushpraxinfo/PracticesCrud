<?php

// Load database credentials from config.env
$env = parse_ini_file("config.env");

if (!$env) {
    die("❌ Error: config.env file missing or invalid.");
}

$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];
$dbname = $env['DB_NAME'];

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("❌ DB Connection failed: " . mysqli_connect_error());
}
