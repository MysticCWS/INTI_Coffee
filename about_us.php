<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INTI Coffee | About Us</title>
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
    <body class="d-flex flex-column min-vh-100">
        <header class="site-header text-center bg-light pt-3">
            <img src="icon/titleicon.png" width="5%" alt="HeaderLogo"/>
            <h1>INTI Coffee</h1>
            
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav my-auto">
                        <li class="nav-item h4"><a class="nav-link" href="homepage.php">Home</a></li>
                        <li class="nav-item h4"><a class="nav-link" href="#">Order Tracker</a></li>
                        <li class="nav-item active h4"><a class="nav-link" href="#">About Us</a></li>
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
            <h3 class="text-center">About Us</h3>
            <img src="img/AboutUs.jpg" class="d-block w-100 pt-2" alt="About Us">
            <p class="text-center pt-2">
                Wanna have some coffee in the morning but you are in a hurry? No problem! INTI Coffee makes it possible! <br>
                We are using premium coffee beans to deliver the best taste coffee to you to kick start your day. We accept <br>
                orders online here and start brewing your coffee while you are on the way to your class, office, or workplace. <br>
                You can then track your order status from our website here to know that your coffee has been done yet. <br>
                Most important, we deliver the coffee directly to your class, office, or workplace too, when it is done. <br>
                You can select the delivery time based on your preferences either to deliver immediately or in a future time. <br>
                We hope to make everyone's life easier and more energetic. Start by placing order <a href="homepage.php">here</a>!
            </p>
        </div>
        
        <footer class="site-footer text-center bg-light pt-3 mt-auto">
            <h5>Contact Us</h5>
            <p class="pt-2"><icon class="bi-envelope"> </icon><a href="mailto:inti.coffee@gmail.com">inti.coffee@gmail.com</a></p>
            <p><icon class="bi-telephone"> </icon><a href="tel:+60164395329">+6016-4395329</a></p>
            <p class="small">&copy;INTI Coffee 2024</p>
        </footer>
    </body>
</html>