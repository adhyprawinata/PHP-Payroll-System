<?php 
	include '../config/datepicker.php';
?>
<form action="../controller/doInsertUser.php" method="post">
 	<div class="form-group">
	<label>ID User</label>
    <div style="width:250px;"><input type="text" name="iduser" value="" style="width:250px;"></div>
	</div>
	<div class="form-group">
	<label>Email</label>
    <div style="width:250px;">
    <input type="text" name="email" value="" style="width:250px;"></div>
	</div>
    <div class="form-group">
	<label>Password</label>
    <div style="width:250px;">
    <input type="password" name="password" value="" style="width:250px;"></div>
	</div>
	<div class="form-group">
	<label>Tipe</label>
    <div style="width:250px;">
    <select id="tipe" name="tipe" style="width:250px;" class="form-control">
			<option value="">-Pilih Tipe Karyawan-</option>
            <option value="Reguler">Reguler</option>
			<option value="NonReguler">Non-Reguler</option>
	</select></div>
	</div>
    <div class="form-group">
	<label>Tanggal Lahir</label>
    <div style="width:250px;">
    <input class="form-control" placeholder="Tanggal" name="tanggallahir" type="text" id="datepicker" value="" readonly>
	</div></div>
    <div class="form-group">
	<label>Nama</label>
    <div style="width:250px;">
    <input type="text" name="nama" value="" style="width:250px;"></div>
	</div>
    <div class="form-group">
	<label>Status</label>
    <div style="width:250px;">
    <input type="text" name="status" value="" style="width:250px;"></div>
	</div>
    <div class="form-group">
	<label>Jabatan</label>
    <div style="width:250px;">
    <select id="jabatan" name="jabatan" style="width:250px;" class="form-control">
			<option value="">Pilih Jabatan</option>
            <option value="Manager">Manager</option>
			<option value="Manager">Kepala Cabang</option>
            <option value="Kepala Divisi">Kepala Divisi</option>
            <option value="Finance">Staff</option>
	</select></div>
	</div>
    <div class="form-group">
	<label>ID Divisi</label>
    <div style="width:250px;">
    <select name="iddivisi" class="form-control">
		<option value="">Pilih Divisi</option>
    	 <?php
		$sql_divisi = mysqli_query($k,"SELECT * FROM divisi");
		while($b = mysqli_fetch_array($sql_divisi)){
				echo "<option value='$b[id]'>$b[nama]</option>";			
		}	
	?>
    </select></div>
	</div>
    <div class="form-group">
	<label> No Rekening</label>
    <div style="width:250px;">
    <input type="text" name="norekening" value="" style="width:250px;"></div>
	</div>
    <div class="form-group">
	<label>Cabang</label>
    <div style="width:250px;">
    <select id="cabang" name="cabang" style="width:250px;" class="form-control">
			<option value="">Pilih Cabang</option>
            <option value="Pekanbaru">Pekanbaru</option>
            <option value="Bandung">Bandung</option>
            <option value="Jakarta">Jakarta</option>
	</select></div>
	</div>
   
    <div class="form-group">
	<label>Gaji Pokok</label>
    <div style="width:250px;">
    <input type="text" name="gajipokok" value="" style="width:250px;"></div>
	</div>
    
    <input type="submit" value="Submit" class="btn btn-primary">   <a class='btn btn-danger' onclick='javascript:history.back()'>Kembali</a>
</form>