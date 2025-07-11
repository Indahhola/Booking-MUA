<?php include '../config/db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Booking</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php if (isset($_GET['status'])): ?>
    <?php
        $message = '';
        if ($_GET['status'] === 'sukses') {
            $message = 'Booking berhasil disimpan!';
        } elseif ($_GET['status'] === 'update') {
            $message = 'Booking berhasil diperbarui!';
        } elseif ($_GET['status'] === 'hapus') {
            $message = 'Booking berhasil dihapus!';
        }
    ?>
    <?php if ($message): ?>
        <div class="alert-success" id="notif"><?= $message ?></div>
        <script>
            setTimeout(function () {
                const notif = document.getElementById('notif');
                if (notif) {
                    notif.classList.add('alert-hidden');
                    setTimeout(() => notif.style.display = 'none', 500);
                }
            }, 3000);
        </script>
    <?php endif; ?>
<?php endif; ?>


    <h2>Daftar Booking MUA</h2>
	<div class="action-bar">
		<a href="tambah_booking.php" class="btn-add">+ Tambah Booking</a>
	</div>

    <table>
        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>MUA</th>
            <th>Layanan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Pembayaran</th>
	    <th>Aksi</th>
        </tr>

        <?php
        $query = "SELECT 
                    b.id_booking, c.nama_customer, m.nama_mua, 
                    l.nama_layanan, b.tanggal_booking, b.status_booking, 
                    p.status_pembayaran
                  FROM booking b
                  JOIN customer c ON b.id_customer = c.id_customer
                  JOIN mua m ON b.id_mua = m.id_mua
                  JOIN layanan l ON b.id_layanan = l.id_layanan
                  JOIN pembayaran p ON b.id_booking = p.id_booking";

        $result = mysqli_query($conn, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
   	 // Ambil status dari data
    		$status_booking = $row['status_booking'];
    		$status_pembayaran = $row['status_pembayaran'];

    	// Siapkan class badge
    		$badge_booking = "badge badge-" . strtolower($status_booking);
    		$badge_bayar = "badge badge-" . str_replace(" ", "_", strtolower($status_pembayaran));

		echo "<tr>
		    <td>{$no}</td>
		    <td>{$row['nama_customer']}</td>
		    <td>{$row['nama_mua']}</td>
		    <td>{$row['nama_layanan']}</td>
		    <td>{$row['tanggal_booking']}</td>
		    <td><span class='$badge_booking'>{$status_booking}</span></td>
		    <td><span class='$badge_bayar'>{$status_pembayaran}</span></td>
		    <td>
		        <a href=\"../hapus_booking.php?id={$row['id_booking']}\"
		           class='btn-action btn-delete'
		           onclick=\"return confirm('Yakin ingin menghapus booking ini?')\">
		           Hapus
		        </a>
		        <a href=\"edit_booking.php?id={$row['id_booking']}\"
		           class='btn-action btn-edit'>
		           Edit
		        </a>
		    </td>
		</tr>";
    		
    		$no++;
		}
        ?>
    </table>
</body>
</html>
