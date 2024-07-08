<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function check_login($con){
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "select * from admin where admin_id = '$id' limit 1";
        
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0){
            $admin_data = mysqli_fetch_assoc($result);
            return $admin_data;
        }
    }
    
    //Redirect to login
    header("Location: adminlogin.php");
    die;
}

function random_num($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }
    
    $len = rand(4, $length);
    
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0,9);
    }
    
    return $text;
}