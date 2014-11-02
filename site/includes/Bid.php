<?php
require('DbConnect.php');
class Bid {
    private $id,
        $price,
        $bidder_id,
        $product_id;
    public $con;

    public function __construct($id,$price,$bidder_id,$product_id){
        $this -> id = $id;
        $this -> price = $price;
        $this -> bidder_id =$bidder_id;
        $this -> product_id = $product_id;
        $this ->con = (new DbConnect()) -> getConnection();
    }
    public function getId(){
        return $this -> id;
    }
    public function getBidderId(){
        return $this -> bidder_id;
    }
    public function getPrice(){
        return $this -> price;
    }
    public function getProductId(){
        return $this -> product_id;
    }
    public function insertBidder(){
        $query = "INSERT INTO tbl_bids(id,price,bidder_id,product_id) VALUE($this->id,$this->price,$this->bidder_id,$this->product_id)";
        if($this->con->query($query)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function updateBid($id,$price,$bidder_id,$product_id){
        $query = "UPDATE tbl_bids set price=$price,bidder_id=$bidder_id,product_id=$product_id WHERE id=$id";
        $conn = (new DbConnect())->getConnection();
        if($conn->query($query)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function deleteBid ($id){
        $query = "DELETE * FROM tbl_bids WHERE id=$id";
        $conn = (new DbConnect())->getConnection();
        if($conn->query($query)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function getBidById($id){
        $query = "SELECT * FROM tbl_bids WHERE id=$id";
        $conn = (new DbConnect()) -> getConnection();
        $results = $conn ->query($query);
        if($results){
            $array_all = $results -> fetch_all(MYSQL_ASSOC);
            $array = $array_all[0];
            $bid = new Bid($array['id'],$array['price'],$array['bidder_id'],$array['product_id']);
            return $bid;
        }
        else{
            return false;
        }
    }


} 