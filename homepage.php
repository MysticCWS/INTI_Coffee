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
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header class="site-header text-center bg-light pt-3">
            <img src="icon/titleicon.png" width="5%" alt="HeaderLogo"/>
            <h1>INTI Coffee</h1>
            
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav my-auto">
                        <li class="nav-item active h4"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item h4"><a class="nav-link" href="#">Order Tracker</a></li>
                        <li class="nav-item h4"><a class="nav-link" href="about_us.php">About Us</a></li>
                        <li class="nav-item h4">&nbsp;&nbsp;</li>
                    </ul>
                    <form class="form-inline d-flex h4">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item h4"><a class="nav-link" href="#"><span class="bi-person" title="My Account"></span></a></li>
                        <li class="nav-item h4"><a class="nav-link" href="#"><span class="bi-cart" title="Cart"></span></a></li>
                        <li class="nav-item h4"><a class="nav-link" href="login.php"><span class="bi-power" title="Logout"></span></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <div class="col-md-6 mx-auto py-5">          
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
    </body>
</html>