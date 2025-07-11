<?php
include '../config/db.php';

// Ambil data untuk dropdown
$mua = mysqli_query($conn, "SELECT * FROM mua");
$layanan = mysqli_query($conn, "SELECT * FROM layanan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Booking</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Form Tambah Booking</h2>
    <form action="../proses_booking.php" method="POST" class="form-box">
        <label>Nama Customer</label>
        <input type="text" name="nama_customer" required>

        <label>Nomor HP</label>
        <input type="text" name="no_hp" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Pilih MUA</label>
        <select name="id_mua" required>
            <option value="">-- Pilih MUA --</option>
            <?php while ($row = mysqli_fetch_assoc($mua)) {
                echo "<option value='{$row['id_mua']}'>{$row['nama_mua']}</option>";
            } ?>
        </select>

        <label>Pilih Layanan</label>
        <select name="id_layanan" required>
            <option value="">-- Pilih Layanan --</option>
            <?php while ($row = mysqli_fetch_assoc($layanan)) {
                echo "<option value='{$row['id_layanan']}'>{$row['nama_layanan']}</option>";
            } ?>
        </select>

        <label>Tanggal Booking</label>
        <input type="date" name="tanggal_booking" required>

        <label>Jam Booking</label>
        <input type="time" name="jam_booking" required>

        <button type="submit" name="submit">Simpan Booking</button>
    </form>
</body>
</html>
