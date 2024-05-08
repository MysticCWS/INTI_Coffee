<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>INTI Coffee | Login</title>
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <header class="site-header position-absolute">
            <h1>INTI Coffee</h1>
        </header>
        <div class="col-md-4 mx-auto py-5">
            <form id="loginForm" class="was-validated" action="">
                <div class="row g-2 my-3 mx-2">
                    <div class="col-md">
                        <h3>Login</h3>
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
                        <div class="forgot-password mt-10">
                            <p>Forgotten your password? <a href="reset_password">Reset here</a></p>
                        </div>
                    </div>
                </div>
                <div class="submit-login">
                    <button id="btnLogin" class="btn-login" type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>