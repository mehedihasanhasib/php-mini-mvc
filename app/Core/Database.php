<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = include(BASE_PATH . '/config/database.php'); // Load the configuration file
        $dbConfig = $config['db'];

        try {
            $this->pdo = new PDO(
                "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']}",
                $dbConfig['username'],
                $dbConfig['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    public static function query($sql, $params = [])
    {
        try {
            $pdo = self::getInstance();

            $stmt = $pdo->prepare($sql);

            foreach ($params as $key => $value) {
                $stmt->bindValue(
                    is_int($key) ? $key + 1 : ":$key",
                    $value,
                    is_bool($value)
                        ? PDO::PARAM_BOOL
                        : (is_numeric($value)
                            ? PDO::PARAM_INT
                            : PDO::PARAM_STR)
                );
            }


            $stmt->execute();

            // Return the result set for SELECT queries, or true/false for others
            if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|EXPLAIN)\s/i', $sql)) {
                if (preg_match('/\bLIMIT\s+1\b/i', $sql)) {
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $stmt->rowCount(); // Number of affected rows for INSERT, UPDATE, DELETE
            }
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }
    }
}
