<?php
include '../../config/koneksi.php';

	$id = explode ("-",$_POST['id']);
	$sql = mysqli_query($k,"SELECT * FROM lap_absensi WHERE id_karyawan = '$id[0]'");
	$jam_kerja = 0;
	while($data = mysqli_fetch_assoc($sql)){
		list($h,$m,$s) = explode(":",$data['datang_timezone_1']);
		$dtAwal = mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s) = explode(":",$data['pulang_timezone_1']);
		$dtAkhir = mktime($h,$m,$s,"1","1","1");
		$dtSelisih = $dtAkhir-$dtAwal;
		$totalmenit = $dtSelisih/60;
		list($h,$m,$s) = explode(":",$data['datang_timezone_2']);
		$dtAwal2 = mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s) = explode(":",$data['pulang_timezone_2']);
		$dtAkhir2 = mktime($h,$m,$s,"1","1","1");
		$dtSelisih2 = $dtAkhir2-$dtAwal2;
		$totalmenit += $dtSelisih2/60;
		$jam_kerja += round($totalmenit/60);
	}
	
	$sql_data_stat = mysqli_query($k,"SELECT * FROM stat_absensi WHERE id_karyawan = '$id[0]'");
	$data_stat = mysqli_fetch_array($sql_data_stat);
	if(mysqli_num_rows($sql) > 0){
		echo "
		Jam Kerja : $jam_kerja <br/>
			Gaji : $jam_kerja x 10.000 = ".$jam_kerja * 10000 ."<br/>"; 
		echo "Jumlah hari masuk : ".$data_stat['jml_hari_masuk'] ."<br/>";
		echo "UMT : $data_stat[jml_hari_masuk] x 30000 = ".$data_stat['jml_hari_masuk']*30000 ."<br/>";
		$total_gaji = $jam_kerja*10000+$data_stat['jml_hari_masuk']*30000;
		
		echo "Total Gaji : ". $total_gaji;
		
		
		echo "<input type='hidden' name='total_gaji' value='$total_gaji'/>";
		echo "<input type='hidden' name='id' value='$id[0]'/>";
	}
	 
?>