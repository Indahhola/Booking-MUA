<?php
include 'config/db.php';

if (isset($_POST['submit'])) {
    $id_booking = $_POST['id_booking'];
    $id_customer = $_POST['id_customer'];
    $nama = $_POST['nama_customer'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $id_mua = $_POST['id_mua'];
    $id_layanan = $_POST['id_layanan'];
    $tanggal = $_POST['tanggal_booking'];
    $jam = $_POST['jam_booking'];
    $status = $_POST['status_booking'];

    // Update customer
    mysqli_query($conn, "UPDATE customer 
        SET nama_customer='$nama', no_hp='$no_hp', email='$email' 
        WHERE id_customer=$id_customer");

    // Update booking
    mysqli_query($conn, "UPDATE booking 
        SET id_mua=$id_mua, id_layanan=$id_layanan, 
            tanggal_booking='$tanggal', jam_booking='$jam', status_booking='$status'
        WHERE id_booking=$id_booking");

    // Redirect ke dashboard
    header("Location: views/dashboard.php?status=update");
    exit;
} else {
    echo "Akses tidak sah.";
}
?>
