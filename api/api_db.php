<?php
header("Content-Type: application/json");

// Database configuration
$servername = "localhost";
$username = "root";  // Change this to your phpMyAdmin username
$password = "";  // Change this to your phpMyAdmin password
$dbname = "inti_coffee";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet($conn);
        break;
    case 'POST':
        handlePost($conn);
        break;
    case 'PUT':
        handlePut($conn);
        break;
    case 'DELETE':
        handleDelete($conn);
        break;
    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}

$conn->close();

function handleGet($conn) {
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    
    if ($user_id > 0) {
        // Fetch a specific user
        $sql = "SELECT * FROM user WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    } else {
        // Fetch all users
        $sql = "SELECT * FROM user";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
}

function handlePost($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $user_id = $data['user_id'];
    $user_name = $data['user_name'];
    $user_email = $data['user_email'];
    $user_password = $data['user_password'];
    $user_contact = $data['user_contact'];

    $sql = "INSERT INTO user (user_id, user_name, user_email, user_password, user_contact) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $user_name, $user_email, $user_password, $user_contact);

    if ($stmt->execute()) {
        echo json_encode(["message" => "New user created successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

function handlePut($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $user_id = $data['user_id'];
    $user_name = $data['user_name'];
    $user_email = $data['user_email'];
    $user_password = $data['user_password'];
    $user_contact = $data['user_contact'];
    

    $sql = "UPDATE user SET user_id = ?, user_name = ?, user_email = ?, user_password = ?, user_contact = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $user_id, $user_name, $user_email, $user_password, $user_contact, $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
}

function handleDelete($conn) {
    // Get JSON data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if all required fields are present
    if (!isset($data['id'])) {
        echo json_encode(["error" => "Missing required fields"]);
        return;
    }

    // Extract and sanitize the data
    $id = intval($data['id']);
    

    // Construct the SQL query
    $sql = "DELETE FROM user WHERE id = ?";
    
    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $affected_rows = $stmt->affected_rows;
        if ($affected_rows > 0) {
            echo json_encode(["message" => "User deleted successfully", "affected_rows" => $affected_rows]);
        } else {
            echo json_encode(["message" => "No matching user found with the given details", "affected_rows" => 0]);
        }
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }

    $stmt->close();
}
?>
