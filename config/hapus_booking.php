<?php
include 'config/db.php';

if (isset($_GET['id'])) {
    $id_booking = $_GET['id'];

    // 1. Hapus dari tabel pembayaran
    mysqli_query($conn, "DELETE FROM pembayaran WHERE id_booking = $id_booking");

    // 2. Dapatkan id_customer-nya terlebih dulu sebelum hapus booking
    $result = mysqli_query($conn, "SELECT id_customer FROM booking WHERE id_booking = $id_booking");
    $row = mysqli_fetch_assoc($result);
    $id_customer = $row['id_customer'];

    // 3. Hapus dari tabel booking
    mysqli_query($conn, "DELETE FROM booking WHERE id_booking = $id_booking");

    // 4. (Opsional) Hapus customer jika tidak digunakan lagi
    $check = mysqli_query($conn, "SELECT COUNT(*) as total FROM booking WHERE id_customer = $id_customer");
    $count = mysqli_fetch_assoc($check)['total'];
    if ($count == 0) {
        mysqli_query($conn, "DELETE FROM customer WHERE id_customer = $id_customer");
    }

    // 5. Redirect dengan notifikasi
    header("Location: views/dashboard.php?status=hapus");
    exit;
} else {
    echo "ID booking tidak ditemukan.";
}
?>
