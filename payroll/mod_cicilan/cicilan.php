<?php

	if(isset($_GET['act'])){
		$act = $_GET['act'];
	}else{
		$act="";
	}
	$id_karyawan = $_SESSION['id_karyawan'];
require_once("../config/koneksi.php");
	switch($act){
		default:?>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th>Data Karyawan</th>
							<th>Tanggal</th>
							<th>Nominal Cicilan</th>
							<th>ID Pinjaman</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM cicilan";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_karyawan']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td>
										<?php echo "$data_karyawan[Nama] - $data_karyawan[Id_User]";?>
									</td>
									<td>
										<?php echo $b['tanggal'];?>
									</td>
									<td>
										<?php echo $b['nominal'] ?>
									</td>
									
									<td>
										<?php echo $b['id_pinjaman'] ?>
									</td>
									<td>
										<?php echo $b['status'] ?>
									</td>
									<td><a href="?modul=cicilan&act=detailCicilan&id=<?php echo $b['id']; ?>">Detail</a></td>
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
		case "inputCicilan" :
			include 'inputCicilan.php';
		break;
		
		case "detailCicilan" :
			include 'detailCicilan.php';
		break;
		
		
	}
?>

