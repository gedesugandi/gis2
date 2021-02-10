<?php 
require('koneksi.php');


$action = @$_GET['action'];

if($action == 'saveEdit'){
	$luas_wilayah = $_POST['luas_wilayah'];
	$jml_laki = $_POST['jml_laki'];
	$jml_perempuan = $_POST['jml_perempuan'];
	$id_data = $_POST['id_data'];
	if ($luas_wilayah !== '' || $jml_laki !== '' || $jml_perempuan !== '') {
		$sql = mysqli_query($db, "UPDATE tbl_data_kecamatan SET luas_wilayah = '$luas_wilayah', jml_laki = '$jml_laki', jml_perempuan = '$jml_perempuan' WHERE id_data = $id_data ");
		if($sql){
			session_start();
			$_SESSION['status'] = 'berhasil';
			header('location:keloladata.php');
		}else{
			session_start();
			$_SESSION['status'] = 'gagal';
			header('location:keloladata.php');
		}
	}
}else{
	header('location:index.php');
}





 ?>