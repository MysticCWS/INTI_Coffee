<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "inti_coffee";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Failed to connect.");
}