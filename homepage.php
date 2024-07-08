<?php

session_start();

    include("connection.php");
    include("function.php");
    
    $user_data = check_login($con);
    
    //Fetch carousel from database
    $carousel_query = "select * from carousel";
    $carousel_result = mysqli_query($con, $carousel_query);
    
    $carousel_images = [];
    if ($carousel_result->num_rows > 0){
        while($carousel_row = $carousel_result->fetch_assoc()){
            $carousel_images[] = $carousel_row['img_dir'];
        }
    }
    
    //Fetch coffee item from database
    $item_query = "select * from item";
    $item_result = mysqli_query($con, $item_query);

    $items = [];
    if ($item_result->num_rows > 0) {
        while($item_row = $item_result->fetch_assoc()) {
            $items[] = $item_row;
        }
    }
    
    date_default_timezone_set('Singapore');

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

            <div class="col-md-6 mx-auto py-5">          
                <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" data-bs-interval="4000">
                        <div class="carousel-item active">
                            <img src="img/Promo1.jpeg" class="d-block w-100" alt="Promo 1">
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <img src="img/Promo2.jpg" class="d-block w-100" alt="Promo 2">
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <img src="img/Promo3.jpg" class="d-block w-100" alt="Promo 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> -->

                <!-- Carousel -->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($carousel_images as $key => $image): ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key; ?>" class="<?php echo $key === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $key + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($carousel_images as $key => $image): ?>
                            <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo $image; ?>" class="d-block w-100" alt="Slide <?php echo $key + 1; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Items -->
            <div class="container mt-5 px-4 py-4 border rounded bg-white" id="items_list">
                <h3>Our Menu</h3>
                <div class="row">
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
                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modifyOrderModal-<?php echo $item['item_id']; ?>">
                                        Add to Cart
                                    </button>
                                </div>

                                <!-- Modify Order Modal -->
                                <div class="modal fade" id="modifyOrderModal-<?php echo $item['item_id']; ?>" tabindex="-1" aria-labelledby="modifyOrderModalLabel-<?php echo $item['item_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modifyOrderModalLabel-<?php echo $item['item_id']; ?>">Modify Order: <?php echo $item['item_name']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form for modifying order -->
                                                <form id="purchase" method="POST" action="add_to_cart.php">
                                                    <div class="mb-3">
                                                        <input type="hidden" name="user_id" value="<?php echo $user_data['user_id']; ?>">
                                                        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                                        <label for="quantity-<?php echo $item['item_id']; ?>" class="form-label">Quantity</label>
                                                        <input type="number" class="form-control" name="purchase_qty" id="quantity-<?php echo $item['item_id']; ?>" value="1" min="1">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="location-<?php echo $item['item_id']; ?>" class="form-label">Order Location</label>
                                                        <select class="form-select" name="purchase_location" id="location-<?php echo $item['item_id']; ?>" required>
                                                            <option value="">Select Location</option>
                                                            <option value="Level 2 Foyer">Level 2 Foyer</option>
                                                            <option value="Level 2 AFM Office">Level 2 AFM Office</option>
                                                            <option value="Level 2 Finance Office">Level 2 Finance Office</option>
                                                            <option value="Level 2 Registration Office">Level 2 Registration Office</option>
                                                            <option value="Level 2 Student Affairs Office">Level 2 Student Affairs Office</option>
                                                            <option value="Level 2 AI Lab">Level 2 AI Lab</option>
                                                            <option value="Level 2 CC Lab">Level 2 CC Lab</option>
                                                            <option value="Level 3 Cubicle">Level 3 Cubicle</option>
                                                            <option value="Level 3 Academic Office">Level 3 Academic Office</option>
                                                            <option value="Level 3 ITS Office">Level 3 ITS Office</option>
                                                            <option value="Level 3 IT Lab A">Level 3 IT Lab A</option>
                                                            <option value="Level 3 IT Lab B">Level 3 IT Lab B</option>
                                                            <option value="Level 4 Foyer">Level 4 Foyer</option>
                                                            <option value="Level 4 LR401">Level 4 LR401</option>
                                                            <option value="Level 4 LR401">Level 4 LR402</option>
                                                            <option value="Level 4 LR401">Level 4 LR403</option>
                                                            <option value="Level 4 LR401">Level 4 LR404</option>
                                                            <option value="Level 4 LR401">Level 4 LR405</option>
                                                            <option value="Level 5 Foyer">Level 5 Foyer</option>
                                                            <option value="Level 5 Lecture Theater">Level 5 Lecture Theater</option>
                                                            <option value="Level 5 LR501">Level 5 LR501</option>
                                                            <option value="Level 5 LR502">Level 5 LR502</option>
                                                            <option value="Level 5 LR503">Level 5 LR503</option>
                                                            <option value="Level 5 LR504">Level 5 LR504</option>
                                                            <option value="Level 5 LR505">Level 5 LR505</option>
                                                            <option value="Level 6 Foyer">Level 6 Foyer</option>
                                                            <option value="Level 6 Lecture Theater">Level 6 Lecture Theater</option>
                                                            <option value="Level 6 LR601">Level 6 LR601</option>
                                                            <option value="Level 6 LR602">Level 6 LR602</option>
                                                            <option value="Level 6 LR603">Level 6 LR603</option>
                                                            <option value="Level 6 LR604">Level 6 LR604</option>
                                                            <option value="Level 6 LR605">Level 6 LR605</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="time-<?php echo $item['item_id']; ?>" class="form-label">Order Time</label>
                                                        <input type="time" class="form-control" id="time-<?php echo $item['item_id']; ?>" name="purchase_time" value="<?php echo date('H:i') ?>" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-secondary">Add to Cart</button>
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