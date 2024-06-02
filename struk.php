<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struk</title>
  <!-- css -->
  <link rel="stylesheet" href="style.css">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #b5b5b5;">
  <div class="container-struk">
    <div class="header-struck">
      <h1>Struck Belanjaan</h1>
    </div>
    <div class="alamat-struck">
      <p>Alamat lengkap toko</p>
      <p>Jl. Sindangsari Bogor Timur</p>
      <p>Tlp +62 858-XXXX-XXXX</p>
    </div>
    <div class="tanggal-waktu">
      <p><?php date_default_timezone_set('Asia/Jakarta'); ?></p>
      <span><?php echo date("d/m/Y  H:i:s") ?></span>
    </div>
    <hr style="border: 1px dashed #000;">
    <div class="output-php">
      <p style="font-weight: 500; font-size: 15px;">Barang Belanjaan</p>

      <!-- php code -->
      <div class="php">
        <?php if (!isset($_SESSION['dataKasir'])): ?>
          <?php $_SESSION['dataKasir'] = array(); ?>
        <?php endif; ?>

        <!-- membuat validasi apakah ada data nama, jumlah, dan harga. kalau ada tampilkan data tersebut -->
        <?php if (isset($_POST['nama']) && isset($_POST['jumlah']) && isset($_POST['harga'])): ?>
          <?php $nama = $_POST['nama']; ?>
          <?php $jumlah = $_POST['jumlah']; ?>
          <?php $harga = $_POST['harga']; ?>
          <?php $data = ['nama' => $nama, 'jumlah' => $jumlah, 'harga' => $harga, 'total' => $jumlah * $harga]; ?>
          <?php array_push($_SESSION['dataKasir'], $data); ?>
        <?php endif; ?>

        <!-- menghitung jumlah dan harga barang -->
        <?php $totalHarga = 0; ?>
        <?php foreach ($_SESSION['dataKasir'] as $key => $value): ?>
          <p><?php echo $value['nama'] ?></p>
          <div class="total-barang">
            <p><?php echo $value['harga'] ?></p>
            <p>x<?php echo $value['jumlah'] ?></p>
            <p>Rp<?php echo number_format((isset($value['total']) ? $value['total'] : ''), 0, ",", "."); ?></p>
          </div>
          <?php $totalHarga += $value["total"]; ?>
        <?php endforeach; ?>
        <hr>
        
        <!-- menghitung total keseluruhan barang -->
        <div class="total-harga">
          <p>Total Harga:</p>
          <p><?php echo "Rp" . number_format($totalHarga, 0, ",", "."); ?></p>
        </div>
        <!-- menampilkan uang tunai yang tadi diinput lewat file bayar.php -->
        <div class="uang-tunai">
          <p>Tunai: </p>
          <?php if (isset($_SESSION['nominalUang'])): ?>
            <?php $nominalUang = $_SESSION['nominalUang'] ?>
            <p><?php echo "Rp" . number_format($nominalUang, 0, ",", "."); ?></p>
          <?php endif; ?>
        </div>

        <!-- menampilkan uang kembalian -->
        <div class="uang-kembali">
          <p>Kembali: </p>
          <p><?php echo "Rp" . number_format($nominalUang - $totalHarga, 0, ",", ".") ?></p>
        </div>
      </div>
    </div>
    <hr>
    <div class="footer-struk text-center" style="text-align: center;">
      <p>TERIMAKASIH</p>
      <p>****</p>
    </div>
  </div>
  <div class="d-flex justify-content-space-around align-items-center text-center m-3" >
  <button class="btn btn-primary align-items-center justify-content-center d-flex mx-auto p-2" type="submit" value="Submit"><i
      class="fa-solid fa-arrow-left"></i><a href="index.php"
      style="color: #fff; text-decoration: none;">Kembali</a></button>
  <button class="btn btn-info align-items-center justify-content-center d-flex mx-auto p-2" type="submit" value="Submit" onclick="window.print()" style="margin-left: 150px;"><i class="fa-solid fa-print"></i>print</button>
  </div>
</body>

</html>