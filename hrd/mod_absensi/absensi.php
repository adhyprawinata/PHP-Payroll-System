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
				<div class="table-responsive">
					
					<table class="table table-striped">
						<thead>
						<tr>
							<th>ID Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Divisi</th>
							<th>Cabang</th>
							<th>Terlambat</th>
							<th>Pulang Awal</th>
							<th>Absen</th>
							<th>Lembur</th>
							<th>Periode</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							if(isset($_GET['search'])){
								$search = mysql_real_escape_string($_GET['search']);
								$query = "SELECT * FROM stat_absensi WHERE id_karyawan= $search order by id";
							}else{
								$query = "SELECT * FROM stat_absensi order by id";
							}
							
							
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
										<?php echo $b['departemen'];?>
									</td>
									<td>
										<?php echo $data_karyawan['cabang'] ?>
									</td>
									<td>
										<?php echo $b['terlambat'] ?>
									</td>
									<td>
										<?php echo $b['pulang_awal'];?>
									</td>
									<td>
										<?php echo $b['absen'];?>
									</td>
									<td>
										<?php echo $b['lembur'];?>
									</td>
									<td>
										<?php 
										$periode = explode("_",$b['periode']);
										echo $periode[0]." ".$periode[1];
										?>
									</td>
									<td><a href="?modul=absensi&act=detailAbsensi&id=<?php echo $b['id_karyawan']; ?>">Detail</a></td>
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
		case "detailAbsensi" :
			include 'detailAbsensi.php';
		break;
		
	}
?>

