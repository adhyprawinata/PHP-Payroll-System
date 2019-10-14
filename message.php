 <?php
 $sql_message = mysqli_query($k,"SELECT * FROM message WHERE id_pinjaman = '$hasil[id]");
 $data_message = mysqli_fetch_array($sql_message);
 if(mysqli_num_rows($sql_message) > 0){	 
	 echo "<div>$data_message[isi]</div>
			<div>$data_message[tanggal]  $data_message[jam]  by $data_message[author]	 
	 ";
 }
  ?>
 <textarea name="msg"></textarea>
 
