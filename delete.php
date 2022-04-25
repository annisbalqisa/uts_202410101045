<?php
include 'db.php';
$pdo = pdo_connect_mysql();
$msg = '';
// memeriksa apakah ID baris ada
if (isset($_GET['id'])) {
    // Pilih data yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM info WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Meyakinkan pengguna untuk menghapus
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // Pengguna menekan tombol "Yes" , data akan dihapus
            $stmt = $pdo->prepare('DELETE FROM info WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            // output message
            echo "
            <!DOCTYPE html>
            <script>
            function redir()
            {
            alert('Data Terhapus');
            window.location.assign('index.php');
            }
            </script>
            <body onload='redir();'></body>";
        } else {
            // pengguna menekan tombol "No", kembali ke halaman sebelumnya
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Contact #<?=$row['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete row #<?=$row['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$row['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$row['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
