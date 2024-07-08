<?php

session_start();

    include("connection.php");
    include("functionAdmin.php");
    
    $admin_data = check_login($con);
    
    //Fetch coffee item from database
    $item_query = "select * from item";
    $item_result = mysqli_query($con, $item_query);

    $items = [];
    if ($item_result->num_rows > 0) {
        while($item_row = $item_result->fetch_assoc()) {
            $items[] = $item_row;
        }
    }
    
    // Handle form submissions for item modification (edit/delete/add)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'edit_item') {
                $item_id = $_POST['item_id'];
                $item_name = $_POST['item_name'];
                $item_price = $_POST['item_price'];
                $item_description = $_POST['item_description'];

                // Update item details in database
                $update_query = "UPDATE item SET item_name='$item_name', item_price='$item_price', item_description='$item_description' WHERE item_id='$item_id'";
                mysqli_query($con, $update_query);
            } elseif ($action === 'delete_item') {
                $item_id = $_POST['item_id'];

                // Delete item from database
                $delete_query = "DELETE FROM item WHERE item_id='$item_id'";
                mysqli_query($con, $delete_query);
            } elseif ($action === 'add_item') {
                $item_name = $_POST['item_name'];
                $item_price = $_POST['item_price'];
                $item_description = $_POST['item_description'];
                $item_imgdir = $_POST['item_imgdir']; // Assuming you handle image upload and store its directory

                // Insert new item into database
                $insert_query = "INSERT INTO item (item_name, item_price, item_description, item_imgdir) VALUES ('$item_name', '$item_price', '$item_description', '$item_imgdir')";
                mysqli_query($con, $insert_query);
            }

            // Redirect to refresh the page after action
            header("Location: admin.php");
            exit();
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
        <title>INTI Coffee | Home</title>
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
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_order_tracker.php">Manage Order</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="edit_account.php">Admin: <?php echo $admin_data['admin_name']; ?><span class="bi-person" title="My Account"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logoutadmin.php"><span class="bi-power" title="Logout"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Items -->
            <div class="container mt-5 px-4 py-4 border rounded bg-white" id="manage-items">
                <h3 class="text-center">Manage Items</h3>
                <br>

                <!-- Add Item Form -->
                <div class="col-mb-4">
                    <h4>Add New Item</h4>
                    <form id="addItem" method="POST" action="admin.php">
                        <input type="hidden" name="action" value="add_item">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="item_name" class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="item_name" name="item_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="item_price" class="form-label">Item Price (RM)</label>
                                <input type="number" step="0.01" class="form-control" id="item_price" name="item_price" required>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="item_description" class="form-label">Item Description</label>
                                <textarea class="form-control" id="item_description" name="item_description" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="item_imgdir" class="form-label">Item Image Directory</label>
                                <input type="text" class="form-control" id="item_imgdir" name="item_imgdir" value="webimg\item\ " required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-secondary mt-3">Add Item</button>
                    </form>
                    <br>
                </div>

                <!-- Existing Items -->
                <div class="row">
                    <h4>Edit Existing Items</h4>
                    <?php foreach ($items as $item): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="<?php echo $item['item_imgdir']; ?>" alt="<?php echo $item['item_name']; ?>">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $item['item_name']; ?></h4>
                                    <h5>RM <?php echo $item['item_price']; ?></h5>
                                    <p class="card-text"><?php echo $item['item_description']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <!-- Button trigger modal for edit -->
                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editItemModal-<?php echo $item['item_id']; ?>">
                                        Edit
                                    </button>
                                    <!-- Button for delete (form submission) -->
                                    <form id="deleteItem" class="d-inline" method="POST" action="admin.php">
                                        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                        <input type="hidden" name="action" value="delete_item">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </div>

                                <!-- Edit Item Modal -->
                                <div class="modal fade" id="editItemModal-<?php echo $item['item_id']; ?>" tabindex="-1" aria-labelledby="editItemModalLabel-<?php echo $item['item_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editItemModalLabel-<?php echo $item['item_id']; ?>">Edit Item: <?php echo $item['item_name']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for editing item -->
                                                <form id="editItem" method="POST" action="admin.php">
                                                    <input type="hidden" name="action" value="edit_item">
                                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="edit_item_name-<?php echo $item['item_id']; ?>" class="form-label">Item Name</label>
                                                        <input type="text" class="form-control" id="edit_item_name-<?php echo $item['item_id']; ?>" name="item_name" value="<?php echo $item['item_name']; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_item_price-<?php echo $item['item_id']; ?>" class="form-label">Item Price (RM)</label>
                                                        <input type="number" step="0.01" class="form-control" id="edit_item_price-<?php echo $item['item_id']; ?>" name="item_price" value="<?php echo $item['item_price']; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_item_description-<?php echo $item['item_id']; ?>" class="form-label">Item Description</label>
                                                        <textarea class="form-control" id="edit_item_description-<?php echo $item['item_id']; ?>" name="item_description" rows="3" required><?php echo $item['item_description']; ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_item_imgdir-<?php echo $item['item_id']; ?>" class="form-label">Item Image Directory</label>
                                                        <input type="text" class="form-control" id="edit_item_imgdir-<?php echo $item['item_id']; ?>" name="item_imgdir" value="<?php echo $item['item_imgdir']; ?>" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-secondary">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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