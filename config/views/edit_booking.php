<?php
include '../config/db.php';

$id_booking = $_GET['id'];

// Ambil data booking dan customer
$data = mysqli_query($conn, "SELECT b.*, c.nama_customer, c.no_hp, c.email 
    FROM booking b 
    JOIN customer c ON b.id_customer = c.id_customer 
    WHERE b.id_booking = $id_booking");
$booking = mysqli_fetch_assoc($data);

// Ambil data dropdown
$mua = mysqli_query($conn, "SELECT * FROM mua");
$layanan = mysqli_query($conn, "SELECT * FROM layanan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Booking</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Edit Booking</h2>
    <form action="../update_booking.php" method="POST" class="form-box">
        <input type="hidden" name="id_booking" value="<?= $booking['id_booking'] ?>">
        <input type="hidden" name="id_customer" value="<?= $booking['id_customer'] ?>">

        <label>Nama Customer</label>
        <input type="text" name="nama_customer" value="<?= $booking['nama_customer'] ?>" required>

        <label>Nomor HP</label>
        <input type="text" name="no_hp" value="<?= $booking['no_hp'] ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= $booking['email'] ?>" required>

        <label>Pilih MUA</label>
        <select name="id_mua" required>
            <?php while ($row = mysqli_fetch_assoc($mua)) : ?>
                <option value="<?= $row['id_mua'] ?>" <?= $row['id_mua'] == $booking['id_mua'] ? 'selected' : '' ?>>
                    <?= $row['nama_mua'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Pilih Layanan</label>
        <select name="id_layanan" required>
            <?php while ($row = mysqli_fetch_assoc($layanan)) : ?>
                <option value="<?= $row['id_layanan'] ?>" <?= $row['id_layanan'] == $booking['id_layanan'] ? 'selected' : '' ?>>
                    <?= $row['nama_layanan'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Tanggal Booking</label>
        <input type="date" name="tanggal_booking" value="<?= $booking['tanggal_booking'] ?>" required>

        <label>Jam Booking</label>
        <input type="time" name="jam_booking" value="<?= $booking['jam_booking'] ?>" required>

        <label>Status Booking</label>
        <select name="status_booking" required>
            <option value="pending" <?= $booking['status_booking'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="confirmed" <?= $booking['status_booking'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="completed" <?= $booking['status_booking'] == 'completed' ? 'selected' : '' ?>>Completed</option>
            <option value="cancelled" <?= $booking['status_booking'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
