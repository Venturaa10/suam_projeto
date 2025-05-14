<?php
require_once __DIR__ . '/../config.php';

// Configuração para o banco de dados MySQL

// class Database {
//     private static $conn;

//     public static function getConnection() {
//         if (!self::$conn) {
//             self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//             if (self::$conn->connect_error) {
//                 header('Location: /quiz.php');
//             }
//         }
//         return self::$conn;
//     }
// }


// Configuração para o banco de dados PostgreSQL

class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            try {
                // Usando PDO para conexão com PostgreSQL
                $dsn = 'pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME;
                self::$conn = new PDO($dsn, DB_USER, DB_PASS);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Conexão bem-sucedida
                // echo "Conexão com o PostgreSQL bem-sucedida!";
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}