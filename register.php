<?php
session_start();
error_reporting(0);
include('config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO users(name, email, mobile, password) VALUES(:name,:email, :mobile, :password)";
    $query = $db->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {
        $_SESSION['login']=$name;
        echo "<script>alert('Thanks For Register, Continue Your Shopping')</script>";
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } else {
        echo "<script>alert('Please Fill All Valid Details')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ArtsyMart</title>
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
        
        .password-strength {
            height: 5px;
            background: #e9ecef;
            border-radius: 3px;
            margin-top: -15px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s;
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .requirement i {
            position: static;
            margin-right: 8px;
            font-size: 0.6rem;
            color: #adb5bd;
        }
        
        .requirement.valid i {
            color: #28a745;
        }
        
        .requirement.valid span {
            color: #28a745;
        }
        
        .custom-control-label {
            color: #495057;
        }
        
        .custom-control-label a {
            color: #495057;
            font-weight: 500;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <section>
        <?php include('./inc/header.php'); ?>

        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h3>Create Your Account</h3>
                    <p>Join ArtsyMart to start your art journey</p>
                </div>
                
                <div class="auth-body">
                    <form method="post">
                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <input name="name" type="text" class="form-control" placeholder="Full Name" required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-envelope"></i>
                            <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-phone"></i>
                            <input name="mobile" type="tel" class="form-control" placeholder="Phone Number" required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-lock"></i>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                        </div>
                        
                        <div class="password-strength">
                            <div class="strength-meter" id="strength-meter"></div>
                        </div>
                        
                        <div class="password-requirements">
                            <p>Password must contain:</p>
                            <div class="requirement" id="length">
                                <i class="fas fa-circle"></i>
                                <span>At least 8 characters</span>
                            </div>
                            <div class="requirement" id="number">
                                <i class="fas fa-circle"></i>
                                <span>At least one number</span>
                            </div>
                            <div class="requirement" id="letter">
                                <i class="fas fa-circle"></i>
                                <span>At least one letter</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-lock"></i>
                            <input id="confirm-password" type="password" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" id="terms" required>
                            <label class="custom-control-label" for="terms">
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                        
                        <button class="btn btn-auth btn-block" name="submit" type="submit">Create Account</button>
                    </form>
                </div>
                
                <div class="auth-footer">
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </div>
            </div>
        </div>
        
        <?php include('./inc/footer.php'); ?>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const meter = document.getElementById('strength-meter');
            const lengthReq = document.getElementById('length');
            const numberReq = document.getElementById('number');
            const letterReq = document.getElementById('letter');
            
            let strength = 0;
            
            // Check length
            if (password.length >= 8) {
                strength += 33;
                lengthReq.classList.add('valid');
            } else {
                lengthReq.classList.remove('valid');
            }
            
            // Check for numbers
            if (/\d/.test(password)) {
                strength += 33;
                numberReq.classList.add('valid');
            } else {
                numberReq.classList.remove('valid');
            }
            
            // Check for letters
            if (/[a-zA-Z]/.test(password)) {
                strength += 34;
                letterReq.classList.add('valid');
            } else {
                letterReq.classList.remove('valid');
            }
            
            // Update strength meter
            meter.style.width = strength + '%';
            
            // Update meter color
            if (strength < 33) {
                meter.style.backgroundColor = '#dc3545';
            } else if (strength < 66) {
                meter.style.backgroundColor = '#ffc107';
            } else {
                meter.style.backgroundColor = '#28a745';
            }
        });
        
        // Confirm password validation
        document.getElementById('confirm-password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.setCustomValidity("Passwords don't match");
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>

</html>