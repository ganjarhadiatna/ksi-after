<?php

require("../koneksi.php");
require("../lib-yudi.php");

$nomor_identitas = $_POST['nomor_identitas'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$foto = $_FILES['foto'];
$status_member = $_POST['status_member'];

$check = file_exists($foto['tmp_name']);

// image library
$allowed_image_extension = array(
    "png",
    "jpg",
    "jpeg",
    "gif",
    "svg"
);

/*
| ----------------------------------------------------------------------------------
| Input Validation
| ---------------------------------------------------------------------------------- */

if (! validate_number_only($nomor_identitas)) 		validasiGagal('No. Identitas harus berisi angka saja.');
if (! validate_name_only($nama))					validasiGagal('Nama harus berisi huruf, spasi dan titik saja.');
if (! validate_email($email))						validasiGagal('Email tidak valid.');
if (! validate_number_only($telp)) 					validasiGagal('No. Telp harus berisi angka saja.');

kirimPesanJikaValidasiGagal();

// --------------------------------------------------------------------------------- //

if ($check)
{
	// validate image
	$file_extenstion = pathinfo($foto['name'], PATHINFO_EXTENSION);

	if (!in_array($file_extenstion, $allowed_image_extension)) 
	{
		
		echo json_encode([
	        'status'    => 'ERROR',
	        'message'   => 'Gambar tidak valid',
	    ]);

	} 
	else 
	{

		$chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
		$oldname = $foto['name'];
		$newname = time().str_replace($chrc, '', $oldname);
		$target_file = '../../public/img/peminjam/'.$newname;

		//move and rename foto
		if (rename($foto['tmp_name'], $target_file)) 
		{
			$sql = "insert into penyewa values('', '$nomor_identitas', '$nama', '$email', '$alamat', '$jenis_kelamin', '$telp', '$newname', '$status_member')";
			$result = mysqli_query($koneksi,$sql);

			if ($result)
			{
			    echo json_encode([
			        'status'    => 'OK',
			        'message'   => '',
			    ]);
			}
			else
			{
			    echo json_encode([
			        'status'    => 'ERROR',
			        'message'   => mysqli_error($koneksi),
			    ]);
			}

		}
		else 
		{
			echo json_encode([
		        'status'    => 'ERROR',
		        'message'   => 'Gagal mengupload gambar',
		    ]);
		}
	}
}
else 
{

	echo json_encode([
        'status'    => 'ERROR',
        'message'   => 'Gambar tidak ada',
    ]);

}
