<?php
	include '../config/koneksi.php';
	
	$id_karyawan = $_SESSION['id_karyawan'];
	
		
?>
<script>
function myFunction(val) {
     window.location.replace("?modul=absensi&bulan="+val);
}
</script>
<div class="panel-body">
				<div class="table-responsive">
				<?php
				$string_bulan = array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
					$bulan_sekarang = date("n");
					$tahun_sekarang = date("Y");
					$bulan_tahun = $string_bulan[$bulan_sekarang]."_".$tahun_sekarang;
					
				?>
				<div>
				
					<div style="width:200px;">
					<select name="bulan" style="float:left;" onchange="myFunction(this.value)" class="form-control"> 
						<option value="<?php echo "$string_bulan[$bulan_sekarang]"."$tahun_sekarang"; ?>"><?php echo "$string_bulan[$bulan_sekarang], "."$tahun_sekarang"; ?></option>
						<?php
							$query_data_bulan = mysqli_query($k,"SELECT DISTINCT bulan_tahun from salary order by bulan_tahun DESC");
							while($data_bulan = mysqli_fetch_assoc($query_data_bulan)){
								if($data_bulan['bulan_tahun'] == "$bulan_tahun"){
									continue;
								}else {
									$pisah_bulan_tahun = explode("_",$data_bulan['bulan_tahun']);
									echo "<option value='$data_bulan[bulan_tahun]'>$pisah_bulan_tahun[0], $pisah_bulan_tahun[1]</option>";
								}
							}
						?>		
					</select>
					</div>
					
				</div>
				
					<table class="table">
						<thead>
						<tr>
							<th>Tanggal</th>
							<th>Jam Masuk Tz1</th>
							<th>Jam Keluar Tz1</th>
							<th>Jam Masuk Tz2</th>
							<th>Jam Keluar Tz2</th>
							<th>Terlambat</th>
							<th>Pulang Awal</th>
							<th>Absen</th>
							<th>Lembur</th>
						</tr>
						</thead>
	
			<?php
							
							$query = "SELECT * FROM lap_absensi where id_karyawan ='$id_karyawan'"; // AND BULAN = $GET['bulan']
							$hasil = mysqli_query($k, $query);
							while ($b = mysqli_fetch_assoc($hasil)){
							?>	
							<tbody>
								<tr>
									<td> 
										<?php echo $b['tanggal']; ?>
									</td>
									<td>
										<?php echo $b['datang_timezone_1'];?>
									</td>
									<td>
										<?php echo $b['pulang_timezone_1'];?>
									</td>
									<td>
										<?php echo $b['datang_timezone_2'] ?>
									</td>
									<td>
										<?php echo $b['pulang_timezone_2'] ?>
									</td>
									<td>
										<?php echo $b['terlambat'];?>
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
								</tr>
						<?php
								
							}
						?>
							</tbody>
					</table>
				</div>
			</div> 