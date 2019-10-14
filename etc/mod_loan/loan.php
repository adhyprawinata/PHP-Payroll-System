<?php

	if(isset($_GET['action'])){
		$act = $_GET['action'];
	}else{
		$act="";
	}
require_once("../config/koneksi.php");
	switch($act){
	default:?>
		<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>ID Karyawan</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Jumlah Pinjaman</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							
							<?php
							$i=1;
							$query = "SELECT * FROM loan Id_loan";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$idUser = $b['Id_karyawan'];
								$query2 = "SELECT * FROM user WHERE Id_User = $idUser";
								$data_karyawan2 = mysqli_query($k, $query2);
								$data_karyawan = mysqli_fetch_assoc($data_karyawan2);
							?>	
							<tbody>
								<tr>
									
									<td> 
										<?php $data_karyawan['Id_User']; ?>
									</td>
									<td>
										<?php echo $data_karyawan['Nama'];?>
									</td>
									<td>
										<?php echo $data_karyawan['Jabatan'];?>
									</td>
									<td>
										<?php echo $b['jml_pinjam'];?>
									</td>
									<td>
										<?php echo $b['Status']; ?>
									</td>
									<td>
										<a href="">Edit</a> | <a href="">Delete</a>
									</td>
								</tr>
						<?php
								
							}
						?>
							</tbody>
						</table>
					</div>
		</div>
<?php
	case "inputLoan" :
		include 'inputLoan.php';
		break;
	case "editLoan" :
		//include 'editLoan.php';
		break;
	case: "detailLoan" :
		//include 'detailLoan.php';
		break;
	}
?>

