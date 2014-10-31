<?php
class Config {
    private static $SERVER = "localhost";
    private static $USERNAME = "root";
    private static $USER_PASSWORD ="";
    private static $DATABASE_NAME ="dbt";

    /*
     * @return the name of the server
     */
    public function getServer(){
        return self::$SERVER;
    }

    /**
     * @return string
     */
    public function getUsername(){
        return self::$USERNAME;
    }
    /*
     * @return the database user password
     */
    public function getUserPassword(){
        return self::$USER_PASSWORD;
    }
    /*
     * @return the database name
     */
    public function getDatabaseName(){
        return self::$DATABASE_NAME;
    }

}
?>