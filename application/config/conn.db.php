<?php


/**
 * a class that provides database connection
 */
class DatabaseConnection
{

    public static function getConnection(): mysqli|bool
    {
        $conn = new mysqli("localhost", "root", "", "smart_milk_db");
        if ($conn->connect_error)
            return false;
        return $conn;
    }
}



?>