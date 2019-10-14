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
							<th>Tipe Cuti</th>
							<th>Tanggal Diajukan</th>
							<th>Tanggal Diterima</th>
							<th>Kuota Terpakai</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							if($data_karyawan['Level'] == 4){ // Jika Staff HRD
								$query = "SELECT * FROM cuti WHERE level = '4' order by id";
							}else{
								$query = "SELECT * FROM cuti WHERE cabang = '$data_karyawan[cabang]' order by id";
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
										<?php echo $b['tipe'];?>
									</td>
									<td>
										<?php 
											
										
										echo date('d M', strtotime($b['tanggal_mulai'])). " - ".date('d M, Y', strtotime($b['tanggal_selesai']))?>
									</td>
									<td>
										<?php 
											if($b['tanggal_mulai_diterima'] != "0000-00-00" && $b['tanggal_akhir_diterima'] != "0000-00-00"){
												echo date('d M', strtotime($b['tanggal_mulai_diterima'])). " - ".date('d M, Y', strtotime($b['tanggal_akhir_diterima']));
											}else{
												echo "-";
												
											}?>
									</td>
									<td>
										<?php 
										if($b['kuota_terpakai']  !=0){
											echo $b['kuota_terpakai']; 
										}else {
											echo "-";
										}?>
									</td>
									<td>
										<?php echo $b['status'] ?>
									</td>
									<td><a href="?modul=cuti&act=detailCuti&id=<?php echo $b['id']; ?>">Detail</a></td>
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			
			
	<?php
	break;
		case "inputCuti" :
			include 'inputCuti.php';
		break;
		
		case "detailCuti" :
			include 'detailCuti.php';
		break;
		
	}
?>

