<?php

$sql_pinjaman = mysqli_query($k,"select * from pinjaman where status = 'belum lunas' and id_karyawan = '$id'");

$data_pinjaman = mysqli_fetch_assoc($sql_pinjaman);
$sql_cicilan = mysqli_query($k,"SELECT * FROM cicilan where id_pinjaman = $data_pinjaman[id]");
?>
<table>
<th>
	<td>Tanggal</td>
	<td>Nominal Cicilan</td>	
</th>
<?php
$total = 0;
while($hasil = mysqli_fetch_assoc($sql_cicilan)){
	echo "
	<tr>
		<td>$hasil[tanggal]</td>
		<td>$hasil[nominal_cicilan]</td>
	</tr>";
	$total += $hasil['nominal_cicilan'];
} 

?>
<tr>
<td>Total</td><td><?php echo $total; ?></td>
</tr>
</table>