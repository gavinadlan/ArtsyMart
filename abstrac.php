<?php
session_start();
error_reporting(0);
include('config.php');

$msg = '';
if (isset($_GET['add'])) {
  if (isset($_SESSION['user'])) {
    $productid = $_GET['add'];
    $user = $_SESSION['user'];
    $sql = "INSERT INTO cart(productid,user) VALUES(:productid,:user)";
    $query = $db->prepare($sql);
    $query->bindParam(':productid', $productid, PDO::PARAM_STR);
    $query->bindParam(':user', $user, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $db->lastInsertId();
    if ($lastInsertId) {
      $msg = '<div class="alert alert-success alert-dismissible fade show">
                <strong>Success!</strong> Product added to cart
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>';
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> Unable to add product
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>';
    }
  } else {
      $msg = '<div class="alert alert-warning alert-dismissible fade show">
                <strong>Warning!</strong> Please login to add product to cart
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>';
  }
}

// FECTH PRODUCTS
$sql = "SELECT * from products WHERE category = 'Abstrac'";
$query = $db->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ArtsyMart | Abstract Collection</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .navbar {
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .section-title {
      position: relative;
      padding-bottom: 10px;
      margin-bottom: 25px;
      font-weight: 600;
      color: #333;
      border-bottom: 2px solid #007bff;
      display: inline-block;
    }
    
    .product-card {
      border: 1px solid #eee;
      border-radius: 8px;
      overflow: hidden;
      transition: transform 0.3s ease;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      margin-bottom: 20px;
      background: #fff;
    }
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }
    
    .product-img {
      height: 200px;
      object-fit: cover;
      padding: 15px;
    }
    
    .product-title {
      font-weight: 600;
      font-size: 1rem;
      color: #333;
      margin-bottom: 5px;
    }
    
    .product-price {
      color: #e74c3c;
      font-weight: 700;
      font-size: 1.1rem;
    }
    
    .btn-add-to-cart {
      background: #343a40;
      border: none;
      border-radius: 4px;
      padding: 8px 15px;
      font-weight: 500;
      color: white;
    }
    
    .btn-add-to-cart:hover {
      background: #23272b;
    }
  </style>
</head>

<body>

  <section>
    <?php include('./inc/header.php'); ?>

    <div class="container mt-4">
      <h3 class="section-title">Abstract Collection</h3>
      <div class="mb-4"><?php echo $msg; ?></div>
      <div class="row">
        <?php
        if ($query->rowCount() > 0) {
          foreach ($results as $result) { ?>
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="product-card">
                <img class="product-img" src="./img/products/<?php echo $result->img; ?>" alt="<?php echo $result->title; ?>">
                <div class="card-body">
                  <h5 class="product-title"><?php echo $result->title; ?></h5>
                  <h6 class="product-price"><?php echo CURRENCY ?> <?php echo $result->price; ?></h6>
                  <a href="abstrac.php?add=<?php echo $result->id; ?>" class="btn btn-add-to-cart mt-2">
                    <i class="fas fa-shopping-cart mr-2"></i> Add To Cart
                  </a>
                </div>
              </div>
            </div>
        <?php }
        } ?>
      </div>
    </div>

    <?php include('./inc/footer.php'); ?>
  </section>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Auto hide alerts
      setTimeout(function() {
        $('.alert').alert('close');
      }, 3000);
    });
  </script>
</body>

</html>