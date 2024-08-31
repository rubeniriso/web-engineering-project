<?php

class DBConnectionSingleton
{
    private static $dbhost = "eim-srv-mysql";
    private static $dbuser = "iw22_69025";
    private static $dbpass = "PeAchePeMaiAdmin";
    private static $db = "iw22_db_69025";
    private static $conn = null;

    public static function getConn()
    {
        if (null === self::$conn) {
            self::$conn = new mysqli(self::$dbhost, self::$dbuser, self::$dbpass, self::$db) or die("Connect failed: %s\n" . self::$conn->error);
            //echo 'created new DB connection';
        } else {
            echo 'DB connection already existed';
        }
        return self::$conn;
    }
    public static function closeConn()
    {
        self::$conn->close();
    }
}
