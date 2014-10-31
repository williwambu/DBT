<?php
class User {
    private $id,
        $name,
        $location,
        $phone_number,
        $email_address,
        $profile_picture,
        $password,
        $con;

    function __construct($name,$location,$phone_number,$email_address,$profile_picture,$password){
        $this -> name = $name;
        $this -> location = $location;
        $this -> phone_number = $phone_number;
        $this -> email_address = $email_address;
        $this -> profile_picture = $profile_picture;
        $this -> password = $password;

        $this -> con = (new DbConnect()) -> getConnection();
    }
   /**
     * set user id since its not set in the constructor
     */
    private function setId($id){
        $this -> id = $id;
    }
   /**
     * get functions for private properties
     */
    public function getName(){
        return $this -> name;
    }
    public function getPhoneNumber(){
        return $this -> phone_number;
    }
    public function getEmailAddress(){
        return $this -> email_address;
    }
    public function getProfilePicture(){
        return $this -> profile_picture;
    }
    public function getPassword(){
        return $this -> password;
    }
    public function insertUser(){
        $query = "INSERT INTO tbl_users(name,location,phone_number,email_address,profile_picture,password)
                  VALUES ('$this->name','$this->location','$this->phone_number','$this->email_address','$this->profile_picture','$this->password')";
        if($this ->con-> query($query)){
            return true;
        }
        else{
            return false;
        }
    }
   /**
     * get a user given the user id
     * @param $id user id
     * @return User user if user is found and false if not found
     */
    public static function getUserById($id){
        $query = "SELECT * FROM tbl_users WHERE id = $id";

        $connection = (new DbConnect()) -> getConnection();
        $results = $connection -> query($query);

        if($results){
            $array = $results -> fetch_all(MYSQL_ASSOC);
            $user = new User($array['name'],$array['location'],$array['phone_number'],$array['email_address'],$array['profile_pictures'],$array['password']);
            $user ->setId($array['id']);
            return $user;
        }
        else{
            return false;
        }
    }
   /**
     * update a user
     * @return true if successful and false otherwise
     */
    public static function updateUser($id,$name,$location,$phone_number,$email_address,$profile_picture,$password){
        $query = "UPDATE SET name='$name' location='$location' phone_number = '$phone_number' email_address='$email_address'
                  profile_picture='$profile_picture' password='$password' WHERE id=$id";
        $connection =(new DbConnect()) -> getConnection();
        if ($connection->query($query)) {
            return true;
        }
        else {
            return false;
        }
    }
   /**
     * delete a user given his/her id
     * @param $id user id
     * @return true on successful deletion and false if deletion fails
     */
    public static function deleteUser($id){
        $query = "DELETE * FROM tbl_users WHERE id=$id";
        $connection = (new DbConnect()) ->getConnection();
        if($connection -> query($query)){
            return true;
        }
        else{
            return false;
        }
    }
    public function searchUser(){

    }
}
?>