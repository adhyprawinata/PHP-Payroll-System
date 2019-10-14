<?php
include '../config/datepicker.php';
	$id = $_GET['id'];
	
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
	$sql_karyawann = mysqli_query($k,"SELECT * FROM penilaian WHERE id_karyawan = '$data_karyawan[Id_User]'");
	$data_karyawann = mysqli_fetch_array($sql_karyawann);
	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
require_once("../config/koneksi.php");
	switch($act){
		default:?>
<style>
	.form-group input{
		width:100%;
	}
</style>

	
	
	
	
	
	
	<label>User Profile</label>
<form action="?modul=profile&act=updateProfile&id=<?php echo $id;?>" method="post" class="form-horizontal">
 	<div class="form-group"><label class="col-sm-3">ID User</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawan['Id_User'] ?></div></div>
    
	<div class="form-group"><label class="col-sm-3">Email</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
    <?php echo $data_karyawan['Email'] ?></div></div>
	
	<div class="form-group"><label class="col-sm-3">Tgl Lahir</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawan['Tgl_Lahir'] ?></div></div>
	
	<div class="form-group"><label class="col-sm-3">Nama</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawan['Nama'] ?></div></div>
	
	<div class="form-group"><label class="col-sm-3">Status</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawan['status'] ?></div></div>
	
	<div class="form-group"><label class="col-sm-3">Jabatan</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawan['Jabatan'] ?></div></div>
	
	<div class="form-group"><label class="col-sm-3">Cabang</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawan['cabang'] ?></div></div>
	
	<div class="form-group"><label class="col-sm-3">Grade</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<?php echo $data_karyawann['grade'] ?></div></div>
    
	<input type="submit" value="Update" class="btn btn-primary">
</form>

<?php
	break;
		
		case "updateProfile" :
			include 'updateProfile.php';
		break;
		
	

	}
?>