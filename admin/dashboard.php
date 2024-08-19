<?php
include('../config.php');
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Ambil data penjualan dari database
$query = $db->prepare("SELECT COUNT(id) as total_orders, SUM(total_amount) as total_sales FROM orders");
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$total_orders = $result['total_orders'] ?? 0;
$total_sales = $result['total_sales'] ?? 0;

// Data penjualan per bulan untuk grafik
$query = $db->prepare("SELECT DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_amount) as monthly_sales FROM orders GROUP BY month");
$query->execute();
$sales_data = $query->fetchAll(PDO::FETCH_ASSOC);

// Ambil data item penjualan dari orders
$query = $db->prepare("SELECT user, total_amount, created_at, receiver_name, phone_number, address, postal_code, payment_method FROM orders");
$query->execute();
$orders = $query->fetchAll(PDO::FETCH_ASSOC);

// Format data untuk Chart.js
$months = [];
$sales = [];
foreach ($sales_data as $data) {
    $months[] = $data['month'];
    $sales[] = $data['monthly_sales'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $title = $_POST['product_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image']; // Nama file gambar yang sudah ada di folder img

    // Query SQL untuk menyimpan produk baru
    $sql = "INSERT INTO products (title, price, img, category) VALUES (:title, :price, :img, :category)";
    $stmt = $db->prepare($sql);

    // Bind parameter ke placeholder
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $image); // Menggunakan nama file gambar dari form
    $stmt->bindParam(':category', $category);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Produk berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a href="dashboard.php" class="list-group-item list-group-item-action active">Penjualan</a>
                        <a href="pesanan.php" class="list-group-item list-group-item-action">Riwayat Pesanan</a>
                        <a href="tambahproduk.php" class="list-group-item list-group-item-action">Tambah Produk</a>
                        <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="main-content">
                    <!-- Konten dashboard -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Penjualan</h5>
                            <p class="card-text"><strong>Rp <?php echo number_format($total_sales, 2); ?></strong></p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Total Pesanan</h5>
                            <p class="card-text"><strong><?php echo $total_orders; ?></strong></p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Penjualan Bulanan</h5>
                            <canvas id="salesChart"></canvas>
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
    <!-- Chart.js Script -->
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Penjualan Bulanan (Rp)',
                    data: <?php echo json_encode($sales); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>