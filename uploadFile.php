
<form action="controller/doUpload.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br/>
	Periode : 
	<?php
		$tahun = date('Y');
	?>
	<select name="periode">
		<option value="Januari, <?php echo $tahun; ?>">Januari ,<?php echo $tahun; ?></option>
		<option value="Februari, <?php echo $tahun; ?>">Februari ,<?php echo $tahun; ?></option>
		<option value="Maret, <?php echo $tahun; ?>">Maret ,<?php echo $tahun; ?></option>
		<option value="April, <?php echo $tahun; ?>">April ,<?php echo $tahun; ?></option>
		<option value="Mei, <?php echo $tahun; ?>">Mei ,<?php echo $tahun; ?></option>
		<option value="Juni, <?php echo $tahun; ?>">Juni ,<?php echo $tahun; ?></option>
		<option value="Juli, <?php echo $tahun; ?>">Juli ,<?php echo $tahun; ?></option>
		<option value="Agustus, <?php echo $tahun; ?>">Agustus ,<?php echo $tahun; ?></option>
		<option value="September, <?php echo $tahun; ?>">September ,<?php echo $tahun; ?></option>
		<option value="Oktober, <?php echo $tahun; ?>">Oktober ,<?php echo $tahun; ?></option>
		<option value="November, <?php echo $tahun; ?>">November ,<?php echo $tahun; ?></option>
		<option value="Desember, <?php echo $tahun; ?>">Desember ,<?php echo $tahun; ?></option>
	</select>
    <input type="submit" value="Upload File" name="submit">
</form>

