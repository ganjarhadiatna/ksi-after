<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id             = htmlspecialchars($_POST['id_pinjam'], ENT_QUOTES);
$tgl_pinjam     = htmlspecialchars($_POST['tgl_pinjam'], ENT_QUOTES);
$lama_pinjam    = htmlspecialchars($_POST['lama_pinjam'], ENT_QUOTES);
$id_penyewa     = htmlspecialchars($_POST['id_penyewa'], ENT_QUOTES);
$id_mobil       = htmlspecialchars($_POST['id_mobil'], ENT_QUOTES);

$sql = "update detail_sewa set tgl_pinjam=$tgl_pinjam, lama_pinjam=$lama_pinjam, id_penyewa=$id_penyewa, id_mobil=$id_mobil WHERE id_pinjam = $id";
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
