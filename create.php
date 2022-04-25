<?php
include 'db.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check jika POST data tiidak kosong
if (!empty($_POST)) {
    // Post data tidak kosong akan membuat data baru
    // Mengatur variabel yang akan diinputkan, kami harus mengecek jika POST variables ada, jika tidak kami dapat mengaturnya menjadi kosong
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Periksa apakah variabel POST "nama" ada, jika tidak default nilainya kosong, pada dasarnya sama untuk semua variabel
    $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
    $jumlahAnimo = isset($_POST['jumlahAnimo']) ? $_POST['jumlahAnimo'] : '';

    // Memasukkan data baru ke table
    $stmt = $pdo->prepare('INSERT INTO info VALUES (?, ?, ?)');
    $stmt->execute([$id, $fakultas, $jumlahAnimo]);
    // Output message
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('Data Tersimpan');
    window.location.assign('index.php');
    }
    </script>
    <body onload='redir();'></body>";
}
?>



<?=template_header('Home')?>

<form method="post" action="create.php" >
  <div class="input-group">
    <label>Fakultas</label>
    <input type="text" name="fakultas">
  </div>
  <div class="input-group">
    <label>Jumlah Animo</label>
    <input type="text" name="jumlahAnimo">
  </div>
  <a href="index.php" class="btn btn-secondary">Back</a>
  <input type="submit" value="Simpan" class="btn btn-primary">
</form>
<?php if ($msg): ?>
<p><?=$msg?></p>
<?php endif; ?>
<?=template_footer()?>
