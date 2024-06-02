<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bayar Page</title>
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

    <link rel="stylesheet" href="style.css">

</head>

<body class="m-0 p-0">
  <div class="container-bayar">
    <h1 class="text-center">Masukkan Nominal Uang</h1>
    <form class="row g-3 " action="" method="post">
      <input type="number" id="nominalUang" class="form-control" aria-describedby="nominalUangHelpBlock"
      placeholder="Jumlah Uang" name="nominalUang" required>
      <!-- <div class="col-sm-10 form-control">
        <input type="number" name="nominalUang" class="form-control" id="nominalUang" placeholder="Jumlah Uang">
      </div> -->
      
      <div class="php-code-bayar text-center" style="font-size: 15px;">
        <?php
        // session_start();

        if (isset($_SESSION['dataKasir'])) {
          $totalBelanjaan = 0;

          foreach ($_SESSION['dataKasir'] as $item) {
            if (isset($item['total'])) {
              $totalBelanjaan += $item['total'];
            }

          }
          echo "<p>" . "Total belanjaan yang harus dibayar: " . "Rp " . number_format($totalBelanjaan, 0, ",", ".") . "</p>";
        } else {
          echo "<p>Tidak ada barang yang dibayar</p>";
          header("Location: index.php");
          exit;
        }

        if (isset($_POST['nominalUang'])) {
          $nominalUang = $_POST['nominalUang'];

          if ($nominalUang >= $totalBelanjaan) {
            $_SESSION['nominalUang'] = $nominalUang;
            header('Location: struk.php');
            exit;
          } else {
            $error = true;
          }
        }
        ?>
      </div>
      <?php if (isset($error)): ?>
        <p style="color: #e41616; text-align: center;align-items: center; font-size: 15px;">Maaf, nominal uang tidak cukup!</p>
      <?php endif; ?>
      
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3"><a href="index.php"
        style="color:#fff; text-decoration: none;"><i class="fa-solid fa-arrow-left"></i>Kembali</a></button>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" name="cetakStruk">Bayar</button>
      </div>
    </form>
    
  </div>
</body>

</html>