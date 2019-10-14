
<form action="../controller/doUpload.php" method="post" enctype="multipart/form-data">
 

 <div class="form-group">
	<label>Select file to upload:</label>
    <input  type="file" name="fileToUpload" id="fileToUpload" style="width:250px;">
	</div>
<div class="form-group">
	<label>Periode : </label>
	<?php
		$tahun = date('Y');
		$bulan = date('m');
		$hari = date ('d');
		$string_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember");
		$tahun_temp = "";
	?>

	<select name="periode" class="form-control" style="width:250px;">
	<?php
		if($hari >=25){
			if($bulan == 12){
				$bulan = 1;
				$tahun = $tahun+1;
			}else{
				$bulan = $bulan+1;
			}
		}
	
	$periode_sekarang = $string_bulan[$bulan-1].", ".$tahun;?>
	
		<option value="<?php echo $bulan."-".$tahun; ?>" selected><?php echo $periode_sekarang; ?></option>
		<?php
		if($bulan ==1){
			$bulan = 12;
			$tahun= $tahun-1;
			echo "<option value='"."12-". $tahun ."'>".$string_bulan[$bulan-1].", ".$tahun ."</option>";
		}else{
			for($i=$bulan-1;$i>0;$i--){
			
				echo "<option value='".$i."-".$tahun ."'>". $string_bulan[$i-1] .", ".$tahun ."</option>";
			}
		}
	?>
	</select>
	</div>
	<div class="form-group">
		<input type="submit" value="Upload File" name="submit" class="btn btn-primary">
	</div>
</form>

