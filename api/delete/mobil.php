<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = $_GET['id'];

$sql = "DELETE FROM mobil WHERE id_mobil = $id";
$result = mysqli_query($koneksi,$sql);

//gambar belum bisa dihapus

if ($result)
{
    echo json_encode([
        'status'    => 'OK',
        'message'   => 'Mobil berhasil dihapus',
    ]);
}
else
{
    echo json_encode([
        'status'    => 'ERROR',
        'message'   => mysqli_error($koneksi),
    ]);
}
