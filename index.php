<?php
  require_once 'db.php';
  $pdo = pdo_connect_mysql();

  if (isset($_POST['submit'])) {
      $val = $_POST['sort'];
      if ($val == 'ASC') {
          $icon = '<i class="fas fa-sort-amount-down-alt"></i> ASC';
      } else {
          $icon = '<i class="fas fa-sort-amount-down"></i> DESC';
      }
  } else {
      $val = "ASC";
      $icon = '<i class="fas fa-sort-amount-down-alt"></i> ASC';
  }

  $stmt = $pdo->prepare("SELECT * FROM info ORDER BY jumlahAnimo $val");
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<?=template_header('Home')?>
<div class="container">
  <nav class="navbar-expand-lg navbar-dark shadow-sm fixed-top" >
          <div class="title text-center" style="font-family: ''Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
              <h1 class="title">DAFTAR FAKULTAS DAN JUMLAH ANIMO MAHASISWA BARU
              </h1>
          </div>
      </nav>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
      	<a class="btn btn-primary" href="create.php"> <i class="fas fa-plus"></i> Tambah Data</a>
      </div>
    </div>
    <div class="card-body">
          <form action="" method="post">
            <input type="hidden" name="sort" value="<?= ($val == 'ASC') ? 'DESC' : 'ASC' ?>">
            <button type="submit" name="submit" class="btn btn-dark" ><?= $icon ?></button>
          </form>
        <table class="table table-success table-striped">
          <thead>
            <tr>
              <th scope="col">Fakultas</th>
              <th scope="col">Jumlah Animo</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>

          <?php foreach ($rows as $row): ?>
            <tr>
              <td><?=$row['fakultas']?></td>
              <td><?=$row['jumlahAnimo']?></td>
              <td class="actions">
                <a href="update.php?id=<?=$row['id']?>" class="btn btn-outline-primary float-end ms-3"><i class="bi bi-pencil-square"></i></a>
                <a href="delete.php?id=<?=$row['id']?>" class="btn btn-outline-secondary float-end"><i class="bi bi-trash3"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
  </div>
</div>

<?=template_footer()?>
