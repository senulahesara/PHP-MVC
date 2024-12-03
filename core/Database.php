<?php

class DatabaseConnection
{
    private static $connection;
    private static $dbHost = 'localhost';
    private static $dbName = 'test';
    private static $dbUsername = 'root';
    private static $dbPassword = '3012';

    public static function createConnection()
    {
        if (self::$connection == null) {
            try {
                $dsn = "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName;
                self::$connection = new PDO($dsn, self::$dbUsername, self::$dbPassword);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Log error message here
                throw new Exception("Failed to establish database connection: " . $e->getMessage());
            }
        }
    }

    public static function closeConnection()
    {
        if (self::$connection != null) {
            self::$connection = null;
            // Log that the database connection is closed
        }
    }

    public static function executeSearch($query, $params = [])
    {
        self::createConnection();
        try {
            $stmt = self::$connection->prepare($query);
            self::setQueryParameters($stmt, $params);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error message here
            throw new Exception("Error executing search query: " . $e->getMessage());
        }
    }

    public static function executeIUD($query, $params = [])
    {
        self::createConnection();
        try {
            $stmt = self::$connection->prepare($query);
            self::setQueryParameters($stmt, $params);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error message here
            throw new Exception("Error executing IUD query: " . $e->getMessage());
        }
    }

    private static function setQueryParameters($stmt, $params)
    {
        foreach ($params as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
    }
}
