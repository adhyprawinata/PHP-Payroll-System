<?php

	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
require_once("../config/koneksi.php");
$id_karyawan = $_SESSION['id_karyawan'];
$query = mysqli_query($k,"SELECT id_divisi,cabang FROM user where Id_User = '$id_karyawan'");
$data_karyawan =  mysqli_fetch_assoc($query);

	switch($act){
		default:?>
			<div class="panel-body">
				<div class="table-responsive">
				<div>
						<form action="?modul=lembur&act=inputLembur" method="POST">
							<input type="submit" value="Tambah Lembur" class="btn btn-primary">
						</form>
					</div>
					<table class="table table-striped">
						<thead>
						<tr>
							<th>ID Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Divisi</th>
							<th>Cabang</th>
							<th>Tanggal Lembur</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM lembur WHERE id_divisi = '$data_karyawan[id_divisi]' AND cabang ='$data_karyawan[cabang]'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '$b[id_karyawan]'");
								$data_karyawan2 =  mysqli_fetch_assoc($query2);	
							?>	
							
								<tr>
									<td> 
										<?php echo $b['id_karyawan']; ?>
									</td>
									<td>
										<?php echo $data_karyawan2['Nama'];?>
									</td>
									<td>
										<?php 
										$sql_divisi = mysqli_query($k,"SELECT nama from divisi where id = '$data_karyawan[id_divisi]'");
										$data_divisi = mysqli_fetch_assoc($sql_divisi);
										echo $data_divisi['nama']; ?>
									</td>
									<td>
										<?php echo $data_karyawan2['cabang'];?>
									</td>
									<td>
										<?php echo $b['tanggal']; ?>
									</td>
									<td>
										<?php echo $b['status']; ?>
									</td>
									<td><a href="?modul=lembur&act=detailLembur&id=<?php echo $b['id']; ?>">Detail</a></td>
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			</div> 
			
	<?php
	break;
		case "inputLembur" :
			include 'inputPerintahLembur.php';
		break;
		
		case "detailLembur" :
			include 'detailLembur.php';
		break;

	}
?>

