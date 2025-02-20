<?php
include 'koneksi.php';

// Ambil data kelas
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM kelas WHERE nama_kelas LIKE '%$search%'";
$result = mysqli_query($koneksi, $query);

// Simpan data dalam array
$kelasData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kelasData[] = $row;
}

// Hitung jumlah data
$totalData = count($kelasData);
$maxPerSlide = 5; // Maksimal 7 data per slide
$slides = ceil($totalData / $maxPerSlide); // Hitung jumlah slide
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas</title>
    <link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Kelas</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="index.php" class="btn btn-primary">Kembali ke Data Siswa</a>
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari kelas..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-success">Cari</button>
                <a href="kelas.php" class="btn btn-secondary ms-2">Reset</a> <!-- Tombol Reset -->
            </form>
            <a href="tambah_kelas.php" class="btn btn-success">Tambah Kelas</a>
        </div>

        <div id="kelasCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php for ($i = 0; $i < $slides; $i++): ?>
                    <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Tampilkan maksimal 7 data per slide
                                for ($j = $i * $maxPerSlide; $j < ($i + 1) * $maxPerSlide && $j < $totalData; $j++): 
                                    $row = $kelasData[$j];
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_kelas']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_kelas']); ?></td>
                                    <td>
                                        <a href="edit_kelas.php?id=<?php echo $row['id_kelas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="hapus_kelas.php?id=<?php echo $row['id_kelas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#kelasCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#kelasCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Navigasi Angka -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content -center mt-3">
                <?php for ($i = 0; $i < $slides; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="#kelasCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i + 1; ?>">
                            <?php echo $i + 1; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>