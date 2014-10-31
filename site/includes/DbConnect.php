<?php
require('Config.php');
class DbConnect{
    private $con;

    public function __construct(){
        $config = new Config();
        $this -> con = new mysqli($config -> getServer(),
                                      $config -> getUsername(),
                                      $config -> getUserPassword(),
                                      $config -> getDatabaseName());
        if($this->con->connect_error){
            trigger_error("Connection Failed ".$this ->con ->connect_error );
        }
    }
    public function getConnection(){
        $connection ="";
        if($this -> con && !($this ->con->connect_error)){
            $connection = $this ->con;
        }
        else{
            return false;
        }
        return $connection;
    }
}
?>