<?php

require("../../config/session.php");
require("../koneksi.php");
require("../lib-yudi.php");

$tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam'], ENT_QUOTES);
$tgl_akhir_pinjam = htmlspecialchars($_POST['tgl_akhir_pinjam'], ENT_QUOTES);
$harga_sewa = htmlspecialchars($_POST['harga_sewa'], ENT_QUOTES);
$lama_pinjam = htmlspecialchars($_POST['lama_pinjam'], ENT_QUOTES);
$total_bayar = htmlspecialchars($_POST['total_bayar'], ENT_QUOTES);
$id_admin = session::get('idadmin');
$id_penyewa = htmlspecialchars($_POST['id_penyewa'], ENT_QUOTES);
$id_mobil = htmlspecialchars($_POST['id_mobil'], ENT_QUOTES);
$status_sewa = 'Belum Selesai';

$sql = "insert into sewa values('', '$tgl_pinjam', '$tgl_akhir_pinjam', '$harga_sewa', '$lama_pinjam', '$total_bayar', '$id_admin', '$id_penyewa', '$id_mobil', '$status_sewa')";

$result = mysqli_query($koneksi, $sql);

$sql2 = "update mobil set status='Disewa' WHERE id_mobil = $id_mobil";
$result2 = mysqli_query($koneksi, $sql2);

if ($result && $result2)
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
