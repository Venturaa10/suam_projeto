<?php
require_once __DIR__ . '/../config.php';

class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$conn->connect_error) {
                header('Location: /quiz.php');
            }
        }
        return self::$conn;
    }
}

