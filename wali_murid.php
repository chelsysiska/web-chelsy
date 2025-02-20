<?php
include 'koneksi.php';

// Ambil data kelas
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM wali_murid WHERE nama_wali LIKE '%$search%'";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Murid</title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Wali Murid</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="index.php" class="btn btn-primary">Kembali ke Data Siswa</a>
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari wali murid..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-success">Cari</button>
                <a href="wali_murid.php" class="btn btn-secondary ms-2">Reset</a> <!-- Tombol Reset -->
            </form>
            <a href="tambah_wali.php" class="btn btn-success">Tambah Wali Murid</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Wali</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nama_wali']); ?></td>
                    <td><?php echo htmlspecialchars($row['kontak']); ?></td>
                    <td>
                        <a href="edit_wali.php?id=<?php echo $row['id_wali']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_wali.php?id=<?php echo $row['id_wali']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>