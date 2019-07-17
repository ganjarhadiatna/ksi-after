<?php

require("../koneksi.php");
require("../lib-yudi.php");

$username       = htmlspecialchars($_POST['username'], ENT_QUOTES);
$password       = htmlspecialchars($_POST['password'], ENT_QUOTES);
$nama           = htmlspecialchars($_POST['nama'], ENT_QUOTES);
$alamat         = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
$jenis_kelamin  = htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES);
$telp           = htmlspecialchars($_POST['telp'], ENT_QUOTES);

$sql = "insert into admin values ('', '$username', '$password', '$nama', '$alamat', '$jenis_kelamin', '$telp')";
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
