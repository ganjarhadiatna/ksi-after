<?php
require("../../config/url.php");
require("../koneksi.php");
require("../lib-yudi.php");

$plat_nomor = htmlspecialchars($_POST['plat_nomor'], ENT_QUOTES);
$no_rangka = htmlspecialchars($_POST['no_rangka'], ENT_QUOTES);
$no_mesin = htmlspecialchars($_POST['no_mesin'], ENT_QUOTES);
$nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
$jenis = htmlspecialchars($_POST['jenis'], ENT_QUOTES);
$merk = htmlspecialchars($_POST['merk'], ENT_QUOTES);
$warna = htmlspecialchars($_POST['warna'], ENT_QUOTES);
$isi_silinder = htmlspecialchars($_POST['isi_silinder'], ENT_QUOTES);
$tahun = htmlspecialchars($_POST['tahun'], ENT_QUOTES);
$harga_sewa = htmlspecialchars($_POST['harga_sewa'], ENT_QUOTES);
$foto = $_FILES['foto'];
$status = 'Bebas'; //default : bebas

/*
| ----------------------------------------------------------------------------------
| Input Validation
| ---------------------------------------------------------------------------------- */

if (! validate_alphanumeric_only($plat_nomor)) 	validasiGagal('Plat nomor harus berisi huruf dan angka saja.');
if (! validate_number_only($no_rangka)) 		validasiGagal('No. Rangka harus berisi angka saja.');
if (! validate_number_only($no_mesin))			validasiGagal('No. Mesin harus berisi angka saja.');
if (! validate_name_only($nama))				validasiGagal('Nama Mobil harus berisi huruf, spasi dan titik saja.');
if (! validate_name_only($jenis))				validasiGagal('Jenis Mobil harus berisi huruf, spasi dan titik saja.');
if (! validate_alphanumeric_only($merk))		validasiGagal('Merk Mobil harus berisi huruf, spasi dan titik saja.');
if (! validate_enum($warna, ['merah', 'biru', 'hitam', 'abu'])) validasiGagal('Warna Mobil harus berisi merah, biru, hitam, abu. (huruf kecil-besar berpengaruh)');
if (! validate_format($tahun, 'dddd'))			validasiGagal('Tahun harus berformat YYYY');
if (! validate_number_only($harga_sewa)) 		validasiGagal('Harga Sewa harus berisi angka saja.');

kirimPesanJikaValidasiGagal();

// --------------------------------------------------------------------------------- //

// image library
$allowed_image_extension = array(
    "png",
    "jpg",
    "jpeg",
    "gif",
    "svg"
);

//check image
$check = file_exists($foto['tmp_name']);

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
		$target_file = '../../public/img/mobil/'.$newname;

		//move and rename foto
		if (rename($foto['tmp_name'], $target_file)) 
		{

			$sql = "insert into mobil values(NULL, '$plat_nomor', '$no_rangka', '$no_mesin', '$nama', '$jenis', '$merk', '$warna', '$isi_silinder', '$tahun', '$harga_sewa', '$newname', '$status')";

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
