<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conn = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

define('UPLOAD_PATH', $_ENV['UPLOAD_PATH']);
?>
