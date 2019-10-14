<?php

	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
	$id_karyawan = $_SESSION['id_karyawan'];
	$sql_karyawan = mysqli_query($k,"SELECT * FROM user WHERE Id_User = $id_karyawan");
	$data_karyawan = mysqli_fetch_assoc($sql_karyawan);
	
require_once("../config/koneksi.php");
	switch($act){
		default:?>
			<div class="panel-body">
			<div>
						<form action="?modul=penilaian&act=inputPenilaian" method="POST" style="float:right;">
							<input type="submit" value="Tambah Penilaian" class="btn btn-primary">
						</form>
					</div>
					<select name="periode" class="form-control" style="width:250px;">
						<option value="">2017</option>
					</select>
					<br/>
				<div class="table-responsive">
					
					<table class="table table-striped">
						<thead>
						<tr>
							<th>ID Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Grade</th>
							<th>Periode Penilaian</th>
							<th>Aksi</th>							
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM penilaian WHERE id_divisi = '$data_karyawan[id_divisi]' AND cabang = '$data_karyawan[cabang]' order by id";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_karyawan']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td> 
										<?php echo $b['id_karyawan']; ?>
									</td>
									<td>
										<?php echo $data_karyawan['Nama'];?>
									</td>
									<td>
										<?php echo $b['grade']; ?>
									</td>
									<td>
										<?php echo $b['periode_penilaian']; ?>
									</td>
									<td><a href="?modul=penilaian&act=detailPenilaian&id=<?php echo $b['id']; ?>">Detail</a></td>
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			
			
	<?php
	break;
		case "inputPenilaian" :
			include 'inputPenilaian.php';
		break;
		
		case "detailPenilaian" :
			include 'detailPenilaian.php';
		break;
		
	}
?>

