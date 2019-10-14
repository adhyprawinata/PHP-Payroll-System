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
							<th>Tanggal Lembur</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
			<?php
							
							$query = "SELECT * FROM lembur where id_karyawan = '$id_karyawan'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_karyawan']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td>
										<?php echo $b['tanggal']; ?>
									</td>
									<td>
										<?php echo $b['status']; ?>
									</td>
									<td><a href="?modul=karyawanLembur&act=detailLembur&id=<?php echo $b['id']; ?>">Detail</a></td>
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
			include 'inputLembur.php';
		break;
		
		case "detailLembur" :
			include 'detailLembur.php';
		break;

	}
?>

