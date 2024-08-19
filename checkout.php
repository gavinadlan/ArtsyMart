<?php
session_start();
error_reporting(E_ALL);
include('config.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    // TOTAL
    $sql = "SELECT SUM(products.price) as total FROM cart INNER JOIN products ON products.id = cart.productid WHERE cart.user=:user";
    $query = $db->prepare($sql);
    $query->bindParam(':user', $user, PDO::PARAM_STR);
    $query->execute();
    $total = $query->fetch(PDO::FETCH_OBJ);

    // FETCH PRODUCTS
    $sql = "SELECT cart.id,products.title,products.price,products.img FROM cart INNER JOIN products ON products.id = cart.productid WHERE cart.user=:user";
    $query = $db->prepare($sql);
    $query->bindParam(':user', $user, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // INSERT ORDER
    if (isset($_POST['orderplace'])) {
        $address = $_POST['address'];
        $receiver_name = $_POST['receiver_name'];
        $phone_number = $_POST['phone_number'];
        $postal_code = $_POST['postal_code'];
        $payment_method = $_POST['payment_method'];
        $total_amount = $total->total;

        $sql = "INSERT INTO orders(user, address, receiver_name, phone_number, postal_code, payment_method, total_amount) VALUES(:user, :address, :receiver_name, :phone_number, :postal_code, :payment_method, :total_amount)";
        $query = $db->prepare($sql);
        $query->bindParam(':user', $user, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':receiver_name', $receiver_name, PDO::PARAM_STR);
        $query->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $query->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $query->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);
        $query->bindParam(':total_amount', $total_amount, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $db->lastInsertId();
        if ($lastInsertId) {

            foreach ($results as $item) {
                $sqlitem = "INSERT INTO orderitems (oid, ptitle, price) VALUES (:orderid, :title, :price)";
                $stmtitem = $db->prepare($sqlitem);
                $stmtitem->bindParam("orderid", $lastInsertId, PDO::PARAM_STR);
                $stmtitem->bindParam("title", $item->title, PDO::PARAM_STR);
                $stmtitem->bindParam("price", $item->price, PDO::PARAM_INT);
                $stmtitem->execute();
            }

            // CLEAR CART
            $sql = "DELETE FROM cart WHERE user = (:user)";
            $query = $db->prepare($sql);
            $query->bindParam(':user', $user, PDO::PARAM_STR);
            $query->execute();

            echo '<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="orderModalLabel">Order Confirmation</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.href=\'index.php\'">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Thank you for your order!</p>
                          <p><strong>Receiver Name:</strong> ' . $receiver_name . '</p>
                          <p><strong>Phone Number:</strong> ' . $phone_number . '</p>
                          <p><strong>Address:</strong> ' . $address . '</p>
                          <p><strong>Postal Code:</strong> ' . $postal_code . '</p>
                          <p><strong>Payment Method:</strong> ' . $payment_method . '</p>
                          <p><strong>Total Amount:</strong> ' . $total_amount . '</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href=\'index.php\'">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Checkout</h2>
    <form method="post">
        <div class="form-group">
            <label for="receiver_name">Receiver Name</label>
            <input type="text" class="form-control" id="receiver_name" name="receiver_name" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="paypal">PayPal</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>
        </div>
        <button type="submit" name="orderplace" class="btn btn-primary">Place Order</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#orderModal').modal('show');
    });
</script>

</body>
</html>
