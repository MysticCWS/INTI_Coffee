<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();

include("connection.php");
include("function.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['purchase_id'])) {
    $purchase_id = $_GET['purchase_id'];

    // Delete item from cart for the logged-in user
    $delete_query = "DELETE FROM purchase WHERE user_id = ? AND purchase_id = ?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "ii", $user_data['user_id'], $purchase_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to cart page after successful deletion
        header("Location: mycart.php");
        exit;
    } else {
        echo "Error deleting item: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($con);