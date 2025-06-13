<?php
session_start();
error_reporting(0);
include('config.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT id,name,email FROM users WHERE email=:email and password=:password";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['login'] = $results->name;
        $_SESSION['user'] = $results->id;
        echo "<script>alert('Login Success, Continue Your Shopping')</script>";
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ArtsyMart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Rubik', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            background: #f8f9fa;
        }
        
        .auth-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            border: 1px solid #eaeaea;
        }
        
        .auth-header {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
        }
        
        .auth-header h3 {
            font-weight: 600;
            margin-bottom: 5px;
            color: #343a40;
        }
        
        .auth-header p {
            color: #6c757d;
            font-size: 0.95rem;
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-control {
            height: 50px;
            border-radius: 8px;
            padding-left: 20px;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            color: #495057;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.1);
        }
        
        .form-control::placeholder {
            color: #adb5bd;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-group i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: #adb5bd;
            font-size: 18px;
        }
        
        .form-group input {
            padding-left: 45px;
        }
        
        .btn-auth {
            background: #495057;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            height: 50px;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-auth:hover {
            background: #343a40;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .auth-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #eaeaea;
        }
        
        .auth-footer a {
            color: #495057;
            font-weight: 600;
            text-decoration: none;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .custom-control-label {
            cursor: pointer;
            color: #495057;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider::before {
            margin-right: 10px;
        }
        
        .divider::after {
            margin-left: 10px;
        }
        
        .social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #e0e0e0;
            color: #495057;
            font-size: 18px;
            transition: all 0.3s;
            background: white;
        }
        
        .social-btn:hover {
            background: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <section>
        <?php include('./inc/header.php'); ?>

        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h3>Welcome Back!</h3>
                    <p>Sign in to continue to ArtsyMart</p>
                </div>
                
                <div class="auth-body">
                    <form method="post">
                        <div class="form-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        
                        <div class="remember-forgot">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="#" class="text-muted">Forgot password?</a>
                        </div>
                        
                        <button class="btn btn-auth btn-block" name="submit" type="submit">Sign In</button>
                        
                        <div class="divider">Or continue with</div>
                        
                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <a href="#" class="social-btn">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                </div>
            </div>
        </div>
        
        <?php include('./inc/footer.php'); ?>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>