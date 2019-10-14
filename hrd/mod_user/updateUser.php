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
<label>Update User</label>
<form action="../controller/doUpdateUser.php" method="post" class="form-horizontal">
 	<div class="form-group"><label class="col-sm-3">ID Karyawan</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> <input type="text" name="iduser" value="<?php echo $data_karyawan['Id_User'] ?>"></div></div>
    <div class="form-group"><label class="col-sm-3">Email</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
    <input type="text" name="email" value="<?php echo $data_karyawan['Email'] ?>"></div></div>

    <div class="form-group"><label class="col-sm-3">Tanggal Lahir</label><div style="float:left;width:10px;">:</div><div class="col-sm-3">
     <input class="form-control" placeholder="Tanggal" name="tanggallahir" type="text" id="datepicker" value="<?php echo $data_karyawan['Tgl_Lahir']?>" readonly></div></div>
    <div class="form-group"><label class="col-sm-3">Nama</label><div style="float:left;width:10px;">:</div><div class="col-sm-3">
    <input type="text" name="nama" value="<?php echo $data_karyawan['Nama'] ?>"></div></div>
    <div class="form-group"><label class="col-sm-3">Status</label><div style="float:left;width:10px;">:</div><div class="col-sm-3">
    <input type="text" name="status" value="<?php echo $data_karyawan['status'] ?>"></div></div>
	    <div class="form-group"><label class="col-sm-3">Jumlah Tanggungan</label><div style="float:left;width:10px;">:</div><div class="col-sm-3">
    <input type="text" name="tanggungan" value="<?php echo $data_karyawan['tanggungan'] ?>"></div></div>
    <div class="form-group"><label class="col-sm-3">Jabatan</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
    <select id="jabatan" name="jabatan" class="form-control">
			<?php 
				if($data_karyawan['Jabatan'] == "Manager"){
					echo "<option value='Manager' selected>Manager</option>";
				}else{
					echo"<option value='Manager'>Manager</option>";
				}
				if($data_karyawan['Jabatan'] == "Kepala Cabang"){
					echo "<option value='Kepala Cabang' selected>Kepala Cabang</option>";
				}else{
					echo"<option value='Kepala Cabang'>Kepala Cabang</option>";
				}
				
				if($data_karyawan['Jabatan'] == "Kepala Divisi"){
					echo "<option value='Kepala Divisi' selected>Kepala Divisi</option>";
				}else{
					echo"<option value='Kepala Divisi'>Kepala Divisi</option>";
				}
				if($data_karyawan['Jabatan'] == "Staff"){
					echo "<option value='Staff' selected>Staff</option>";
				}else{
					echo"<option value='Staff'>Staff</option>";
				}
			?>
	</select></div></div>
    <div class="form-group"><label class="col-sm-3">ID Divisi</label><div style="float:left;width:10px;">:</div><div class="col-sm-3">
     <select name="iddivisi" class="form-control">
		<option value="">1</option>
	 <?php
		$sql_divisi = mysqli_query($k,"SELECT * FROM divisi");
		while($b = mysqli_fetch_array($sql_divisi)){
			if($data_karyawan['id_divisi'] == $b['id']){
				echo "<option value='$b[id]' selected>$b[nama]</option>";
			}else{
				echo "<option value='$b[id]'>$b[nama]</option>";
			}	
		}
	
	
	?>
    </select></div></div>
    <div class="form-group"><label class="col-sm-3">No Rekening</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
    <input type="text" name="norekening" value="<?php echo $data_karyawan['no_rekening'] ?>"></div></div>
    <div class="form-group"><label class="col-sm-3">Cabang</label><div style="float:left;width:10px;">:</div><div class="col-sm-3"> 
    <select id="cabang" name="cabang" class="form-control">
			<?php
				if($data_karyawan['cabang'] == "Jakarta"){
					echo "<option value='Jakarta' selected>Jakarta</option>";
				}else{
					echo "<option value='Jakarta'>Jakarta</option>";
				}
				if($data_karyawan['cabang'] == "Pekanbaru"){
					echo "<option value='Pekanbaru' selected>Pekanbaru</option>";
				}else{
					echo "<option value='Pekanbaru'>Pekanbaru</option>";
				}
				if($data_karyawan['cabang'] == "Bandung"){
					echo "<option value='Bandung' selected>Bandung</option>";
				}else{
					echo "<option value='Bandung'>Bandung</option>";
				}
				
			
			
			?>
	</select></div></div>
   
    <div class="form-group"><label class="col-sm-3">Gaji Pokok</label><div style="float:left;width:10px;">:</div><div class="col-sm-3">
    <input type="text" name="gajipokok" value="<?php echo $data_karyawan['gaji_pokok'] ?>"></div></div>
    
    
    <input type="submit" value="Update" class="btn btn-primary">  <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>