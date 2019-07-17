<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
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
//$foto = htmlspecialchars($_POST['foto'], ENT_QUOTES);
$status = htmlspecialchars($_POST['status'], ENT_QUOTES);

$sql = "update mobil set plat_nomor='$plat_nomor', no_rangka='$no_rangka', no_mesin='$no_mesin', nama='$nama', jenis='$jenis', merk='$merk', warna='$warna', isi_silinder='$isi_silinder', tahun='$tahun', harga_sewa='$harga_sewa', status='$status' WHERE id_mobil = $id";
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
