
<?php
$nama = "";
$harga = "";
$jumlah = "";

$errorNama = "";
$errorHarga = "";
$errorJumlah = "";

$pesanSukses = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST["nama"] ?? "");
    $harga = trim($_POST["harga"] ?? "");
    $jumlah = trim($_POST["jumlah"] ?? "");

    if (empty($nama)) {
        $errorNama = "Nama produk wajib diisi!";
    }

    if ($harga === "") {
        $errorHarga = "Harga wajib diisi!";
    }
     elseif (!is_numeric($harga) || $harga <= 0) {
        $errorHarga = "Harga harus berupa angka lebih dari 0!";
    }

   
    if ($jumlah === "") {
        $errorJumlah = "Jumlah pesanan wajib diisi!";
    }
     elseif (
        filter_var($jumlah, FILTER_VALIDATE_INT) === false ||
        $jumlah <= 0
    ) {
        $errorJumlah = "Jumlah harus berupa angka bulat lebih dari 0!";
    }

    
    if (
        empty($errorNama) &&
        empty($errorHarga) &&
        empty($errorJumlah)
    )
     {

        $namaAman = htmlspecialchars(
            $nama,
            ENT_QUOTES,
            'UTF-8'
        );

        $pesanSukses = "Produk " . $namaAman .
            " sebanyak " . $jumlah .
            " berhasil ditambahkan";

      
        $nama = "";
        $harga = "";
        $jumlah = "";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Tambah Produk</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container form-container">

    <h2>FORM TAMBAH PRODUK</h2>

   
    <?php if (!empty($pesanSukses)): ?>
        <div class="success">
            <?= $pesanSukses; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        
        <label>Nama Produk</label>

        <input
            type="text"
            name="nama"
            placeholder="Masukkan nama produk"
            value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>"
        >

        <?php if (!empty($errorNama)): ?>
            <div class="error">
                <?= $errorNama; ?>
            </div>
        <?php endif; ?>


       
        <label>Harga Produk</label>

        <input
            type="number"
            name="harga"
            placeholder="Masukkan harga produk"
            value="<?= htmlspecialchars($harga, ENT_QUOTES, 'UTF-8'); ?>"
        >

        <?php if (!empty($errorHarga)): ?>
            <div class="error">
                <?= $errorHarga; ?>
            </div>
        <?php endif; ?>


        
        <label>Jumlah Pesanan</label>

        <input
            type="number"
            name="jumlah"
            placeholder="Masukkan jumlah pesanan"
            value="<?= htmlspecialchars($jumlah, ENT_QUOTES, 'UTF-8'); ?>"
        >

        <?php if (!empty($errorJumlah)): ?>
            <div class="error">
                <?= $errorJumlah; ?>
            </div>
        <?php endif; ?>


        <button type="submit" name="simpan">
            Simpan Produk
        </button>

    </form>

</div>

</body>
</html>
