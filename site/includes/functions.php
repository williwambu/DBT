<?php
function generateRandomName(){
    $valid_characters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0123456789";
    $valid_char_number = strlen($valid_characters);
    $random_string_length = 50;
    $random_string = "";
    for($i=0;$i<$random_string_length;$i++){
        $index = mt_rand(0,$valid_char_number-1);
        $random_string .= $valid_characters[$index];
    }
    return $random_string;
}
function getPicExtension($filename){
    $array = explode('.',$filename);
    $array_length = count($array);
    //the last member is the extension
    $extension = $array[$array_length-1];
    return $extension;
}
function sign_up($name,$email,$password,$location,$phone_number,$profile_picture){
    $user = new User($name,$location,$phone_number,$email,$profile_picture,$password);
    if($user->insertUser()){
        echo "Sign up successful";
    }
    else{
        echo "Something went wrong.Try again.";
    }
}
?>