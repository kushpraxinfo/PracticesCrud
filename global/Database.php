<?php

class Database {

    private static $_instance = null;
    private $conn;

    private function __construct() {
        $env = parse_ini_file("config.env");

        if (!$env) {
            die("Error: config.env file missing or invalid.");
        }

        $host = $env['DB_HOST'];
        $user = $env['DB_USER'];
        $pass = $env['DB_PASS'];
        $dbname = $env['DB_NAME'];

        $this->conn = mysqli_connect($host, $user, $pass, $dbname);

        if (!$this->conn) {
            die("DB Connection failed: " . mysqli_connect_error());
        }
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
