<?php
include 'koneksi.php';

// Ambil ID kelas dari parameter URL
$id_kelas = $_GET['id'];

// Ambil data kelas berdasarkan ID
$query = "SELECT * FROM kelas WHERE id_kelas = $id_kelas";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Cek apakah data ditemukan
if (!$row) {
    echo "Data tidak ditemukan!";
    exit();
}

// Cek apakah tombol Simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil data dari formulir
    $nama_kelas = $_POST['nama_kelas'];

    // Query untuk memperbarui data kelas
    $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = $id_kelas";

    if (mysqli_query($koneksi, $update_query)) {
        header("Location: kelas.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Kelas</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo $row['nama_kelas']; ?>" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>