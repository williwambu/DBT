<?php

class Product{
    private $id,
        $price,
        $name,
        $description,
        $seller_id,
        $status,
        $admin_id,
        $category,
        $inserted_id,
        $paths_array;
    public $con;

    function __construct($price, $name, $description, $seller_id, $status, $admin_id = " ", $category, $paths_array)
    {
        // $this -> id = $id;
        $this->price = $price;
        $this->name = $name;
        $this->description = $description;
        $this->seller_id = $seller_id;
        $this->status = $status;
        $this->admin_id = $admin_id;
        $this->category = $category;
        $this->con = (new DbConnect())->getConnection();
        $this->paths_array = $paths_array;
    }
   /**
     * getter functions for all private properties
     */
    public function getId(){

    }
    public function getPrice(){
        return $this -> price;
    }
    public function getName(){
        return $this -> name;
    }
    public function getDescription(){
        return $this -> description;
    }
    public function getSellerId(){
        return $this -> seller_id;
    }
    public function getStatus(){
        return $this -> status;
    }
    public function getAdminId(){
        return $this -> admin_id;
    }
    public function getCategory(){
        require $this -> category;
    }
   /**
     * insert a new product into the database
     */
    public function insertProduct()
    {
        //query to insert a new product
        $query = "INSERT INTO tbl_products (price,name,description,seller_id,status,admin_id,category)
                  VALUES($this->price,'$this->name','$this->description',$this->seller_id,
                  '$this->status','$this->admin_id','$this->category')";

        if ($this->con->query($query)) {
            $this->inserted_id = mysqli_insert_id($this->con);
        } else {
            echo "Error: " . $this->con->error;
        }
        $this->insertPictures($this->paths_array);
    }
   /**
     * returns the id of an inserted product
     * useful in inserting images to tbl_pictures
     * @return @var inserted_id
     */
    public function getInsertedId()
    {
        return $this->inserted_id;
    }
   /**
     *insert a products pictures into the tbl_pictures
     * @param paths_array array of the paths of the product pictures
     */
    private function insertPictures($paths_array)
    {
        //loop through photo paths and insert into tbl_pictures
        for ($i = 0; $i < count($paths_array); $i++) {
            $query = "INSERT INTO tbl_pictures (item_id,picture_path)
                      VALUES($this->inserted_id,'$paths_array[$i]')";
            $this->con->query($query);
        }
    }
   /**
     * get a product given its id
     * @param $id id of the product
     * @return Product product if product is found and false if not found
     */
    public static function getProductById($id)
    {
        $query = "SELECT * FROM tbl_products WHERE id=" . $id;
        $connection = (new DbConnect())->getConnection();
        $results = $connection->query($query);
        if ($results) {
            $array = $results->fetch_all(MYSQL_ASSOC);
           $product = new Product($array['price'],$array['name'],$array['description'],$array['seller_id'],$array['status'],
                                 $array['admin_id'],$array['category']);
            //set the product's id
            $product ->setId($array['id']);

            return $product;
        } else {
            return false;
        }
    }
   /**
     * get all the picture paths associated with a product
     * @param $id product id
     * @return  array of pictures paths
     */
    public function getProductPictures($id){
        $query = "SELECT picture_path FROM tbl_pictures WHERE id=$id";
        $results = $this -> con -> query($query);
        return $results -> fetch_all(MYSQL_ASSOC);
    }
   /**
     * updates an existing product
     * @return true if successful and false otherwise
     */
    public static function updateProduct($price, $name, $description, $seller_id, $status, $admin_id, $category, $id)
    {
        $query = "UPDATE SET price=$price,name='$name',description='$description',seller_id=$seller_id,status='$status',
                 admin_id=$admin_id,category='$category' WHERE id=$id";
        $connection = (new DbConnect())->getConnection();
        if ($connection->query($query)) {
            return true;
        } else {
            return false;
        }
    }
   /**
     * delete a product given its id
     * @param $id product id
     * @return true on successful deletion and false if deletion fails
     */
    public static function deleteProduct($id){
         $delete_product = "DELETE * FROM tbl_products WHERE id = $id";
         $delete_pictures = "DELETE * FROM tbl_pictures WHERE item_id = $id";

        //get the photos associated with the product
        $path_array = "SELECT picture_path FROM tbl_pictures WHERE item_id = $id";
        self::deleteProductPictures($path_array);

        $connection = (new DbConnect()) -> getConnection();
        if($connection -> query($delete_product) && $connection -> query($delete_pictures)){
            return true;
        }
        else{
            return false;
        }

    }
  /**
    * delete photos given array of paths
    * used in deleteProduct method
    * @param $path_array array of file paths
    */
    private static function deleteProductPictures($path_array){
        for($i=0;$i< count($path_array);$i++){
            unlink($path_array[$i]);
        }
    }
    public static function searchProduct(){

    }
   /**
     * set a product id since its not set in the constructor
    * @param $id product id
     */
    private function setId($id)
    {
        $this->id = $id;
    }


}
?>