<script>
function myFunction(val) {
     window.location.replace("?modul=salary&bulan="+val);
}
</script>
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
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th>Periode</th>
							<th>Salary</th>
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
			
			<?php
							
							$query = "SELECT * FROM salary where id_user = '$id_karyawan'";
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
								$query2 = mysqli_query($k,"SELECT * FROM user where Id_User = '".$b['id_user']."'");
								$data_karyawan =  mysqli_fetch_assoc($query2);
							?>	
							
								<tr>
									<td>
										<?php 
											$periode = explode("_",$b['bulan_tahun']);
										echo $periode[0]." ".$periode[1];?>
									</td>
									<td>
										<?php echo $b['nett_salary'];?>
									</td>
									<td><a href="?modul=karyawanSalary&act=detailSalary&id=<?php echo $b['id_salary']; ?>">Detail</a></td>
								</tr>
						<?php
							}
						?>
							</tbody>
					</table>
				</div>
	
			
	<?php
	break;
		case "detailSalary" :
			include 'detailSalary.php';
		break;
		
	}
?>

