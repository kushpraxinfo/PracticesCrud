<?php

// Load database credentials from config.env
$env = parse_ini_file(".env");

// Assign environment variables to PHP variables
$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];
$dbname = $env['DB_NAME'];

// Connect to database
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

define('UPLOAD_PATH', $env['UPLOAD_PATH'] ?? '');
