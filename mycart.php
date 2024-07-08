<?php

session_start();

include("connection.php");
include("function.php");

$user_data = check_login($con);

// Function to fetch cart items for the logged-in user
function fetchPurchaseItems($con, $user_id) {
    $purchase_items = [];

    // Query to fetch cart items based on user_id
    $purchase_query = "SELECT p.*, i.item_name, i.item_price
              FROM purchase p
              INNER JOIN item i ON p.item_id = i.item_id
              WHERE p.user_id = '$user_id'";
    $purchase_result = mysqli_query($con, $purchase_query);

    if (mysqli_num_rows($purchase_result) > 0) {
        while ($purchase_row = mysqli_fetch_assoc($purchase_result)) {
            $purchase_items[] = [
                'purchase_id' => $purchase_row['purchase_id'],
                'item_id' => $purchase_row['item_id'],
                'item_name' => $purchase_row['item_name'],
                'item_price' => $purchase_row['item_price'],
                'purchase_qty' => $purchase_row['purchase_qty'],
                'purchase_location' => $purchase_row['purchase_location'],
                'purchase_time' => $purchase_row['purchase_time']
            ];
        }
    }

    return $purchase_items;
}

// Fetch cart items for the logged-in user
$purchase_items = fetchPurchaseItems($con, $user_data['user_id']);

//Save data to tracking database after confirm payment
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Something was posted
    $purchase_id = $_POST['purchase_id'];
    $user_id = $user_data['user_id'];
    $reference = $_POST['reference'];
    $item_id = $_POST['item_id'];
    $item_qty = $_POST['item_qty'];
    $tracking_location = $_POST['tracking_location'];
    $tracking_time = $_POST['tracking_time'];
    
    

    if(!empty($user_id) && !empty($reference) && !empty($item_id) && !empty($item_qty) && !empty($tracking_location) && !empty($tracking_time)){
        //Save into database
        $query = "insert into tracking (user_id, reference, item_id, item_qty, tracking_location, tracking_time) values ('$user_id', '$reference', '$item_id', '$item_qty', '$tracking_location', '$tracking_time')";
        mysqli_query($con, $query);
        
        // Delete item from cart for the logged-in user
        $delete_query = "DELETE FROM purchase WHERE user_id = $user_id";
        mysqli_query($con, $delete_query);
        
        header("Location: homepage.php");
        die;
    }else{
        echo "Please enter all information.";
    }
}

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
        <title>INTI Coffee | My Cart</title>
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

                <nav class="navbar navbar-expand-lg bg-light">
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
                                    <a class="nav-link" href="order_tracker.php">Order Tracker</a>
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

            <div class="col-md-7 mx-auto py-5">          
                <h3 class="text-center">Review Your Cart</h3>
                <div class="px-4 py-4 bg-white border rounded">
                    <?php if (empty($purchase_items)): ?>
                        <p>Your cart is empty.</p>
                        <div class="text-end">
                            <a href="homepage.php#items_list" class="btn btn-outline-secondary">Continue Shopping</a>
                        </div>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Order Location</th>
                                    <th scope="col">Order Time</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($purchase_items as $purchase_item): ?>
                                    <tr>
                                        <td><?php echo $purchase_item['item_name']; ?></td>
                                        <td>RM <?php echo number_format($purchase_item['item_price'], 2); ?></td>
                                        <td><?php echo $purchase_item['purchase_qty']; ?></td>
                                        <td><?php echo $purchase_item['purchase_location']; ?></td>
                                        <td><?php echo $purchase_item['purchase_time']; ?></td>
                                        <td>RM <?php echo number_format($purchase_item['item_price'] * $purchase_item['purchase_qty'], 2); ?></td>
                                        <td>
                                            <a href="remove_from_cart.php?purchase_id=<?php echo $purchase_item['purchase_id']; ?>" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-end"><strong>Total:</strong></td>
                                    <td colspan="1"><strong>
                                        <?php 
                                            $purchase_total = array_reduce($purchase_items, function($carry, $purchase_item) {
                                                return $carry + ($purchase_item['item_price'] * $purchase_item['purchase_qty']);
                                            }, 0);
                                            echo "RM";
                                            echo number_format($purchase_total, 2);
                                        ?>
                                    </strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-end">
                            <a href="homepage.php#items_list" class="btn btn-outline-secondary">Continue Shopping</a>
                            <a href="checkout.php" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</a>
                        </div>

                        <!-- Checkout Modal -->
                        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="checkoutModalLabel">Checkout & Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <h5>
                                                <?php 
                                                    $purchase_total = array_reduce($purchase_items, function($carry, $purchase_item) {
                                                        return $carry + ($purchase_item['item_price'] * $purchase_item['purchase_qty']);
                                                    }, 0);
                                                    echo "Your order total is: RM";
                                                    echo number_format($purchase_total, 2);
                                                ?>
                                            </h5>
                                            <br>
                                            <p>Please pay the stated amount above to the QR provided below and input the payment reference number. Thank you.</p>
                                            <br>
                                            <div class="duitnow-container">
                                                <img src="img/DN_QR.png" width="100%" alt="DuitNow QR"/>
                                            </div>
                                        </div>

                                        <!-- Form for add to tracking database -->
                                        <form id="addToTracking" method="POST">
                                            <div class="mb-3">
                                                <?php foreach ($purchase_items as $purchase_item): ?>
                                                    <input type="hidden" name="purchase_id" value="<?php echo $purchase_item['purchase_id']; ?>">
                                                    <input type="hidden" name="user_id" value="<?php echo $user_data['user_id']; ?>">
                                                    <input type="hidden" name="item_id" value="<?php echo $purchase_item['item_id']; ?>">
                                                    <input type="hidden" name="item_qty" value="<?php echo $purchase_item['purchase_qty']; ?>">
                                                    <input type="hidden" name="tracking_location" value="<?php echo $purchase_item['purchase_location']; ?>">
                                                    <input type="hidden" name="tracking_time" value="<?php echo $purchase_item['purchase_time']; ?>">
                                                <?php endforeach; ?>

                                                <label for="referenceNumber" class="form-label">Payment Reference Number / ID</label>
                                                <input type="text" class="form-control" name="reference" id="referenceNumber" required>
                                            </div>
                                            <button type="submit" class="btn btn-outline-secondary">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div>

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