<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();
    
    include("connection.php");
    include("function.php");
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Something was posted
        $user_id = $_POST['user_id'];
        $item_id = $_POST['item_id'];
        $purchase_qty = $_POST['purchase_qty'];
        $purchase_location = $_POST['purchase_location'];
        $purchase_time = $_POST['purchase_time'];
        
        if(!empty($user_id) && !empty($item_id) && !empty($purchase_qty) && !empty($purchase_location) && !empty($purchase_time)){
            //Save into database
            $purchase_query = "insert into purchase (user_id, item_id, purchase_qty, purchase_location, purchase_time) values ('$user_id', '$item_id', '$purchase_qty', '$purchase_location', '$purchase_time')";
            
            //mysqli_query($con, $purchase_query);
            
            
            if(mysqli_query($con, $purchase_query)){
                header("Location: homepage.php#items_list");
                echo "Item added to cart successfully.";
            } else {
                echo "Error: " . $purchase_query . mysqli_error($con);
            }
        }else{
            echo "Please enter all information.";
        }
    }