<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INTI Coffee | Create Account</title>
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
        </header>
        <div class="col-md-4 mx-auto py-5">
            <form id="loginForm" class="was-validated" action="">
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <h3>Create Account</h3>
                    </div>
                </div>
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input id="accountName" class="form-control" type="text" name="accountName" placeholder="Account Name" value="" required="">
                            <label for="name">Account Name</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input id="loginEmail" class="form-control" type="text" name="email" placeholder="Email" value="" required="">
                            <label for="name">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input id="loginPassword" class="form-control" type="password" name="password" placeholder="Password" value="" required="">
                            <label for="name">Password</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input id="loginConfirmPassword" class="form-control" type="password" name="password" placeholder="Password" value="" required="">
                            <label for="name">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input id="contact" class="form-control" type="text" name="contact" placeholder="Contact" value="" required="">
                            <label for="name">Contact</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <div class="forgot-password mt-10">
                            <p>Already have an account? <a href="login.php">Login</a></p>
                        </div>
                    </div>
                </div>
                <div class="submit-login">
                    <button id="btnCreate" class="btn btn-outline-success my-2 my-sm-0" type="submit">Create</button>
                </div>
            </form>
        </div>
        
        <footer class="site-footer text-center bg-light pt-3 mt-auto">
            <h5>Contact Us</h5>
            <p class="pt-2"><icon class="bi-envelope"> </icon><a href="mailto:inti.coffee@gmail.com">inti.coffee@gmail.com</a></p>
            <p><icon class="bi-telephone"> </icon><a href="tel:+60164395329">+6016-4395329</a></p>
            <p class="small">&copy;INTI Coffee 2024</p>
        </footer>
    </body>
</html>