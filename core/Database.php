<?php

class Database
{
    private static ?mysqli $instance = null;

    public static function getConnection(): mysqli
    {
        if (self::$instance === null) {
            $host = self::environmentValue('DB_HOST', 'localhost');
            $port = (int)self::environmentValue('DB_PORT', '3306');
            $name = self::environmentValue('DB_DATABASE', 'cc');
            $user = self::environmentValue('DB_USERNAME', 'root');
            $pass = self::environmentValue('DB_PASSWORD', '');
            $charset = self::environmentValue('DB_CHARSET', 'utf8mb4');

            $conn = mysqli_connect($host, $user, $pass, $name, $port);
            if (!$conn) {
                error_log("ChasiConnect DB connection failed: " . mysqli_connect_error());
                die("Database connection failed. Please try again later.");
            }
            mysqli_set_charset($conn, $charset);
            self::$instance = $conn;
        }
        return self::$instance;
    }

    private static function environmentValue(string $name, string $default): string
    {
        $value = getenv($name);
        return $value === false ? $default : $value;
    }

    private function __construct() {}
    private function __clone() {}
}
