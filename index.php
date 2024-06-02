<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Kasir</title>
  <!-- css -->
  <link rel="stylesheet" href="style.css">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Freeman&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<body class="p-3 mb-2 bg-light text-black" style="font-family: Poppins, sans-serif;">
  <!-- php code -->
  <?php if (!isset($_SESSION['dataKasir'])) : ?>
    <?php $_SESSION['dataKasir'] = array(); ?>
    <?php endif; ?>
    <?php if (isset($_POST['nama']) && isset($_POST['jumlah']) && isset($_POST['harga'])) : ?>
      <?php  $nama = $_POST['nama']; ?>
      <?php $jumlah = $_POST['jumlah']; ?>
      <?php $harga = $_POST['harga']; ?>
    <?php
      $data = array(
        'nama' => $nama,
        'jumlah' => $jumlah,
        'harga' => $harga,
        'total' => $jumlah * $harga,
      );
      array_push($_SESSION['dataKasir'], $data);
    ?>
    <p class="alert alert-success w-50 align-items-center mx-auto p-2"  role="alert">Barang berhasil ditambahkan</p>
    
    <?php endif; ?>
    <?php if (isset($_GET['hapus'])) : ?>
      <?php $index = isset($_GET['hapus']) ? (int) $_GET['hapus'] : null; ?>
      <?php unset($_SESSION['dataKasir'][$index]); ?>
      <?php header('Location: index.php'); ?>
      <?php exit; ?>
      <?php endif; ?>
      
  <div class="m-5 .bg-light-subtle ">
    <h1 class="text-center m-2">Masukkan Data Barang</h1>
    <div class="mb-5 mt-4">
      <div class="input-field">
        <form action="" method="post">
          <div class="row g-3 align-items-center d-flex justify-content-center ">
            <div class="col-auto">
              <input type="text" id="namaBarang" class="form-control" name="nama" placeholder="Nama Barang" required autocomplete="off">
            </div>
            <div class="col-auto">
              <input type="number" id="jumlahBarang" class="form-control " name="jumlah" placeholder="Jumlah" required autocomplete="off">
            </div>
            <div class="col-auto">
              <input type="number" id="hargaBarang" class="form-control" name="harga" placeholder="Harga" required autocomplete="off">
            </div>
          </div>
      </div>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start align-items-start mt-3" style="margin-left: 230px;">
        <button class="btn btn-primary" type="submit" name="submit" id="liveAlertBtn"><i
            class="fa-solid fa-plus"></i>Tambah</button>
        <?php if (isset($_SESSION['dataKasir']) && $_SESSION['dataKasir']): ?>
          <button class="btn btn-success" type="button"><i class="fa-solid fa-cart-shopping"></i><a href="bayar.php"
              style="color: #fff;">Bayar</a></button>
        <?php endif; ?>
      </div>

    </div>
    </form>

    <!-- code php untuk menampilkan tablenya -->
    <div class="php-code">
      <table
        class="table table-striped-columns justify-content-space-around align-items-center mt-0 mb-0 ms-auto me-auto mw-100 text-center"
        style="width: 57%;">
        <thead>
           <tr>
            <th scope='col'>No</th>
            <th scope='col'>Nama</th>
            <th scope='col'>Jumlah</th>
            <th scope='col'>Harga</th>
            <th scope='col'>Total</th>
            <th scope='col'>Aksi</th>
          </tr>
          </thead>
          <?php $totalHarga = 0; ?>
          <?php $jumlahBarang = 0; ?>
          <?php $count = 1; ?>
          <?php if (isset($_SESSION['dataKasir']) && $_SESSION['dataKasir']): ?>
          <?php foreach ($_SESSION['dataKasir'] as $key => $value): ?>
            <?php if (is_array($value)): ?>
              <tr>
                <td><?php echo $count++ ?></td>
                <td><?php echo $value['nama']; ?></td>
                <td> <?php echo $value['jumlah']; ?> </td>
                <td> <?php echo $value['harga']; ?> </td>
                <td> <?php echo "Rp " . number_format((isset($value['total']) ? $value['total'] : ''), 0, ",", ".") ?></td>
                <td>
                  <span class="text-bg-danger p-2 rounded"><?php echo "<a href='?hapus=" . $key . "'><i class='fa-solid fa-trash'></i></a>" ?>Hapus</span>
                </td>
              </tr>
            <?php endif; ?>
            <?php $totalHarga += $value["total"]; ?>
            <?php $jumlahBarang += $value["jumlah"]; ?>
          <?php endforeach; ?>
          <tr>
            <td colspan='5'>Jumlah Barang</td>
            <td><?php echo $jumlahBarang ?></td>
            </tr>
          <tr>
            <td colspan='5'>Total Harga</td>
            <td><?php echo "Rp " . number_format($totalHarga, 0, ",", ".") ?></td>
            </tr>
            <?php else : ?>
              <td colspan="6" class="text-bg-danger p-3">keranjang masih kosong</td>
            <?php endif; ?>
       </table>
    </div>
  </div>


</body>

</html>