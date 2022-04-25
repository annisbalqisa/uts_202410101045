<?php

include "db.php";
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
				$id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
        $jumlahAnimo = isset($_POST['jumlahAnimo']) ? $_POST['jumlahAnimo'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE info SET fakultas = ?, jumlahAnimo = ? WHERE id = ?');
        $stmt->execute([$fakultas, $jumlahAnimo, $_GET['id']]);
				echo "
				<!DOCTYPE html>
				<script>
				function redir()
				{
				alert('Data Berhasil Diubah');
				window.location.assign('index.php');
				}
				</script>
				<body onload='redir();'></body>";
    }
    $stmt = $pdo->prepare('SELECT * FROM info WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('ID Tidak ditemukan');
}
?>

<?=template_header('Edit')?>
	<title>Edit User Data</title>

	<a href="index.php">Home</a>
	<br/><br/>

	<form name="update_user" method="post" action="update.php?id=<?=$row['id']?>">
		<table border="0">
			<tr>
				<td>Fakultas</td>
				<td><input type="text" name="fakultas" value="<?=$row['fakultas']?>"></td>
			</tr>
			<tr>
				<td>Jumlah Animo</td>
				<td><input type="number" name="jumlahAnimo" value="<?=$row['jumlahAnimo']?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value="<?=$row['id']?>"></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
<?=template_footer()?>
