<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = htmlspecialchars($_POST['id_penyewa'], ENT_QUOTES);
$nomor_identitas = htmlspecialchars($_POST['nomor_identitas'], ENT_QUOTES);
$nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
$alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
$jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES);
$telp = htmlspecialchars($_POST['telp'], ENT_QUOTES);
//$foto = htmlspecialchars($_POST['foto'], ENT_QUOTES);
$status_member = htmlspecialchars($_POST['status_member'], ENT_QUOTES);

$sql    = "update penyewa set nomor_identitas='$nomor_identitas', nama='$nama', email='$email', alamat='$alamat', jenis_kelamin='$jenis_kelamin', telp='$telp', status_member='$status_member' WHERE id_penyewa = '$id'";
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
