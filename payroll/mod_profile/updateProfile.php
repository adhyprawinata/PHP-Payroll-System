<?php 
	include '../config/datepicker.php';
	$id = $_GET['id'];
	
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = '$id'");
	$data_karyawan = mysqli_fetch_array($sql_karyawan);
?>
<style>
	.form-group input{
		width:100%;
	}
</style>
<label>Update Profile</label>
<form action="../controller/doUpdateProfile.php?id=<?php echo $id;?>" method="post" class="form-horizontal">
 	<div class="form-group"><label class="col-sm-3">Password</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
	<input type="password" name="pass" value="<?php echo $data_karyawan['Password'] ?>"></div></div>
    <div class="form-group"><label class="col-sm-3">Email</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
    <input type="text" name="email" value="<?php echo $data_karyawan['Email'] ?>"></div></div>
	
	<input type="hidden" name="jabatan" value="<?php echo $data_karyawan['Jabatan'] ?>"></div></div>
    
	<input type="submit" value="Update" class="btn btn-primary">   <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>