<?php
include('functions.php');
/**
 * Created by PhpStorm.
 * User: WILLIAM
 * Date: 10/30/14
 * Time: 9:09 PM
 */
require_once('DbConnect.php');
require('Product.php');
$db = new DbConnect();
$con = $db -> getConnection();
if($con){
    echo "Connection successfull";
}
else{
    echo "connection failed";
}
/*$query = "select * from tbl_products";

$results = $con ->query($query);
$array = $results -> fetch_all(MYSQL_ASSOC);
var_dump($array);
$paths_array = ["path1","path2","path3"];
$product = new Product(2000,"product_name","This is the description",6,"pending","","electronics",$paths_array);
$product ->insertProduct();
echo $product -> getInsertedId();*/
//var_dump(Product::getProductById(5));
//echo generateRandomName()."\n";
//echo getPicExtension("<p>some.file.jpg")."\n";
echo generateRandomName().".".getPicExtension("some.file.jpg<br>");
echo strlen(generateRandomName());
?>