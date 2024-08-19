<?php
include('../config.php');
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Ambil data item penjualan dari orders
$query = $db->prepare("SELECT user, total_amount, created_at, receiver_name, phone_number, address, postal_code, payment_method FROM orders");
$query->execute();
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <h1 class="text-center">Admin Dashboard</h1>
        </header>
        <div class="row no-gutters">
            <div class="col-md-2">
                <div class="sidebar" style="height: 100%;">
                    <div class="list-group">
                        <a href="dashboard.php" class="list-group-item list-group-item-action">Penjualan</a>
                        <a href="pesanan.php" class="list-group-item list-group-item-action active">Riwayat Pesanan</a>
                        <a href="tambahproduk.php" class="list-group-item list-group-item-action">Tambah Produk</a>
                        <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="main-content">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Detail Pesanan</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Total Amount</th>
                                            <th>Created At</th>
                                            <th>Receiver Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Postal Code</th>
                                            <th>Payment Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($order['user']); ?></td>
                                                <td><strong>Rp <?php echo number_format($order['total_amount'], 2); ?></strong></td>
                                                <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                                                <td><?php echo htmlspecialchars($order['receiver_name']); ?></td>
                                                <td><?php echo htmlspecialchars($order['phone_number']); ?></td>
                                                <td><?php echo htmlspecialchars($order['address']); ?></td>
                                                <td><?php echo htmlspecialchars($order['postal_code']); ?></td>
                                                <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
