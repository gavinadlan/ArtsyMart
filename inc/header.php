<div class="container-fluid bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark p-3">
            <a class="navbar-brand mr-5 font-weight-bold text-light" href="index.php">Artsy</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link font-weight-bold text-light" href="index.php">Home</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link font-weight-bold text-light" href="nature.php">Nature</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link font-weight-bold text-light" href="abstrac.php">Abstract</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link font-weight-bold text-light" href="aesthetic.php">Aesthetic</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item active mr-3">
                        <a class="nav-link text-light" href="mycart.php"> 
                            <i class="fa fa-shopping-cart"></i> My Cart
                        </a>
                    </li>
                    
                    <?php if (isset($_SESSION['login']) && !empty($_SESSION['login'])) { ?>
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="#">
                                <i class="fa fa-user"></i> Hi, <?php echo $_SESSION['login'] ?>
                            </a>
                        </li>
                        <li class="nav-item active ml-2">
                            <a class="nav-link text-light" href="logout.php">
                                <b>Logout</b>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="login.php">
                                Login / Register
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </div>
</div>