//responseText:
//0 = file upload error
//1 = file upload success
//2 = database insert done
	
$(document).ready(function() {
	$('#formprofil').ajaxForm({
		beforeSend:function(){
			$("#uploadbar").show();
		},
		uploadProgress:function(event,position,total,percentComplete){
			$(".progress-bar").width(percentComplete+'%'); //dynamically change the progress bar width
			$(".sr-only").html(percentComplete+'%');//show the percentage number
		},
		success:function(){
			$("#uploadbar").hide(); //hide progress bar on success of upload
		},
		complete:function(response){
			if(response.responseText == 1){//Upload Gagal
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-danger alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>Upload gagal. Pastikan file yang diupload merupakan file gambar (.jpg,.jpeg,.png,.gif) dan dengan ukuran tidak lebih dari 3 MB</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
				//display error if response is 0
			}
			else if(response.responseText == 2)//Simpan sukses
			{
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-success alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>Simpan berhasil!</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
			}
			else{
				$("#image").show;
				$("#image").attr("src",response.responseText);
				$("#hidpath").val(response.responseText);
				//show the image after success
			}
		}
	});
	
	$('#tambahmateri').ajaxForm({
		beforeSend:function(){
			$("#uploadbar").show();
		},
		uploadProgress:function(event,position,total,percentComplete){
			$(".progress-bar").width(percentComplete+'%'); //dynamically change the progress bar width
			$(".sr-only").html(percentComplete+'%');//show the percentage number
		},
		success:function(){
			$("#uploadbar").hide(); //hide progress bar on success of upload
		},
		complete:function(response){
			if(response.responseText == 'gagal'){//Upload Gagal
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-danger alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>Upload materi gagal, cek apakah file yang diupload berekstensi .pdf</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
				//display error if response is 0
			}
			else if(response.responseText == 'kosong')//file kosong
			{
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-danger alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>File materi kosong</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
			}
			else if(response.responseText == 'sama')//nama file sudah ada
			{
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-danger alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>Nama File Sudah ada, silahkan gunakan nama lain</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
			}
			else{
				alert('Berhasil tambah materi!'); 
				location.href='kelas_dosen_materi.php?idkelas='+response.responseText;
			}
		}
	});
	
	$('#ubahprofil').ajaxForm({
		complete:function(response){
			if(response.responseText == 1)//jika field kosong
			{
				jQuery("#submit input[type='checkbox'], input[type='password']").each(function() {
					this.value = '';
				});
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-danger alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>Semua Field Harus Terisi!</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
			}
			else if(response.responseText == 2)//password tidak match
			{
				jQuery("#submit input[type='checkbox'], input[type='password'], input[type='email'], input[type='text']").each(function() {
					this.value = '';
				});
				$("#pesan").hide();
				$("#pesan div").remove();
				$("#pesan").show();
				$("#pesan").append("<div class=\"alert alert-danger alert-dismissable fade in\"><button id=\"msgClose\" type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><p>Password Tidak Sesuai !</p></div>");
				setTimeout(function(){ $("#msgClose").click(); }, 2000);
			}
			else if(response.responseText == 3)//reset sukses
			{
				alert('Password Berhasil Diubah!');
				var back = $("#ubahp").val();
				if(back == "udosen"){
					window.location='profil_dosen.php';
				}else{
					window.location='profil_mahasiswa.php';
				}
			}
		}
	});
	
	$(".dellink").click(function(e){
		e.preventDefault();
		var a = confirm("Yakin ingin menghapus mahasiswa dari kelas?");
		if(a){
			var l = $(this).attr("href");
			location.href= l;
		}
	});
	
	$("#awal").change(function(e){
		var a = $(this).val();
		$("#akhir").prop("min",a);
		var b = $("#akhir").val();
		if(b<a){
			$("#akhir").val(a);
		}
	});
	
	//set the progress bar to be hidden on loading
	$("#uploadbar").hide();
});