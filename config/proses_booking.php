<?php
include 'config/db.php';

if (isset($_POST['submit'])) {
    $nama_customer = $_POST['nama_customer'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $id_mua = $_POST['id_mua'];
    $id_layanan = $_POST['id_layanan'];
    $tanggal_booking = $_POST['tanggal_booking'];
    $jam_booking = $_POST['jam_booking'];

    // 1. Simpan ke tabel customer
    $insertCustomer = "INSERT INTO customer (nama_customer, no_hp, email) 
                       VALUES ('$nama_customer', '$no_hp', '$email')";
    mysqli_query($conn, $insertCustomer);
    $id_customer = mysqli_insert_id($conn); // ambil ID terakhir

    // 2. Simpan ke tabel booking
    $insertBooking = "INSERT INTO booking (id_customer, id_mua, id_layanan, tanggal_booking, jam_booking, status_booking) 
                      VALUES ($id_customer, $id_mua, $id_layanan, '$tanggal_booking', '$jam_booking', 'pending')";
    mysqli_query($conn, $insertBooking);
    $id_booking = mysqli_insert_id($conn);

    // 3. Ambil harga layanan
    $q = mysqli_query($conn, "SELECT harga FROM layanan WHERE id_layanan = $id_layanan");
    $harga = mysqli_fetch_assoc($q)['harga'];

    // 4. Simpan ke tabel pembayaran
    $insertBayar = "INSERT INTO pembayaran (id_booking, metode_pembayaran, status_pembayaran, total_harga) 
                    VALUES ($id_booking, '-', 'belum dibayar', $harga)";
    mysqli_query($conn, $insertBayar);

    // Redirect balik ke dashboard
    header("Location: views/dashboard.php?status=sukses");
    exit;
} else {
    echo "Akses tidak sah.";
}
?>
