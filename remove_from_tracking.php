<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();

include("connection.php");
include("function.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tracking_id'])) {
    $tracking_id = $_GET['tracking_id'];

    // Dismiss item from tracking for the logged-in user
    $dismiss_query = "DELETE FROM tracking WHERE user_id = ? AND tracking_id = ?";
    $stmt = mysqli_prepare($con, $dismiss_query);
    mysqli_stmt_bind_param($stmt, "ii", $user_data['user_id'], $tracking_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to order tracker page after successful dismiss
        header("Location: order_tracker.php");
        exit;
    } else {
        echo "Error dismissing item: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($con);