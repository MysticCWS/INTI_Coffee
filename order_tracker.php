<?php

session_start();

include("connection.php");
include("function.php");

$user_data = check_login($con);

// Function to fetch tracking items for the logged-in user
function fetchTrackingItems($con, $user_id) {
    $tracking_items = [];

    // Query to fetch tracking items based on user_id
    $tracking_query = "SELECT t.*, i.item_name, i.item_price
              FROM tracking t
              INNER JOIN item i ON t.item_id = i.item_id
              WHERE t.user_id = '$user_id'";
    $tracking_result = mysqli_query($con, $tracking_query);

    if (mysqli_num_rows($tracking_result) > 0) {
        while ($tracking_row = mysqli_fetch_assoc($tracking_result)) {
            $tracking_items[] = [
                'tracking_id' => $tracking_row['tracking_id'],
                'item_id' => $tracking_row['item_id'],
                'item_name' => $tracking_row['item_name'],
                'item_price' => $tracking_row['item_price'],
                'item_qty' => $tracking_row['item_qty'],
                'tracking_location' => $tracking_row['tracking_location'],
                'tracking_time' => $tracking_row['tracking_time'],
                'tracking_status' => $tracking_row['tracking_status']
            ];
        }
    }

    return $tracking_items;
}

// Fetch cart items for the logged-in user
$tracking_items = fetchTrackingItems($con, $user_data['user_id']);

?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INTI Coffee | Order Tracker</title>
        <link rel="icon" href="icon/titleicon.png" type="image/x-icon">
        
        <!-- CSS -->
        <link rel="stylesheet" href="style.css"/>
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        <div class="container">
            <header class="site-header text-center bg-light pt-3">
                <img src="icon/titleicon.png" width="5%" alt="HeaderLogo"/>
                <h1>INTI Coffee</h1>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="icon/titleicon.png" width="30" height="30" class="d-inline-block align-top" alt="">
                            INTI Coffee
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="homepage.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Order Tracker</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about_us.php">About Us</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="edit_account.php"><?php echo $user_data['user_name']; ?><span class="bi-person" title="My Account"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="mycart.php"><span class="bi-cart" title="Cart"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php"><span class="bi-power" title="Logout"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            
            <div class="col-md-9 mx-auto py-5">          
                <h3 class="text-center">Track Your Order</h3>
                <div class="px-4 py-4 bg-white border rounded">
                    <?php if (empty($tracking_items)): ?>
                        <p>You don't have any orders yet. Let's browse some items first.</p>
                        <div class="text-end">
                            <a href="homepage.php#items_list" class="btn btn-outline-secondary">Start Shopping</a>
                        </div>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tracking ID</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Order Location</th>
                                    <th scope="col">Order Time</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tracking_items as $tracking_item): ?>
                                    <tr>
                                        <td><?php echo $tracking_item['tracking_id']; ?></td>
                                        <td><?php echo $tracking_item['item_name']; ?></td>
                                        <td>RM <?php echo number_format($tracking_item['item_price'], 2); ?></td>
                                        <td><?php echo $tracking_item['item_qty']; ?></td>
                                        <td><?php echo $tracking_item['tracking_location']; ?></td>
                                        <td><?php echo $tracking_item['tracking_time']; ?></td>
                                        <td>RM <?php echo number_format($tracking_item['item_price'] * $tracking_item['item_qty'], 2); ?></td>
                                        <td><?php echo $tracking_item['tracking_status']; ?></td>
                                        <td>
                                            <?php if($tracking_item['tracking_status'] === "Completed"): ?>
                                                <a href="remove_from_tracking.php?tracking_id=<?php echo $tracking_item['tracking_id']; ?>" class="btn btn-sm btn-outline-danger">Dismiss</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="text-end">
                            <a href="homepage.php#items_list" class="btn btn-outline-secondary">Continue Shopping</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <footer class="site-footer text-center bg-light pt-3 mt-auto">
                <h5>Contact Us</h5>
                <p class="pt-2"><icon class="bi-envelope"> </icon><a href="mailto:inti.coffee@gmail.com">inti.coffee@gmail.com</a></p>
                <p><icon class="bi-telephone"> </icon><a href="tel:+60164395329">+6016-4395329</a></p>
                <p class="small">&copy;INTI Coffee 2024</p>
            </footer>
        </div>
    </body>
</html>