<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = htmlspecialchars($_POST['id_sewa'], ENT_QUOTES);
$tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam'], ENT_QUOTES);
$tgl_akhir_pinjam = htmlspecialchars($_POST['tgl_akhir_pinjam'], ENT_QUOTES);
$harga_sewa = htmlspecialchars($_POST['harga_sewa'], ENT_QUOTES);
$lama_pinjam = htmlspecialchars($_POST['lama_pinjam'], ENT_QUOTES);
$total_bayar = htmlspecialchars($_POST['total_bayar'], ENT_QUOTES);
$status_sewa = htmlspecialchars($_POST['status_sewa'], ENT_QUOTES);

$sql = "
	UPDATE 
		sewa 
	SET 
		tgl_pinjam='$tgl_pinjam', 
		tgl_akhir_pinjam='$tgl_akhir_pinjam', 
		harga_sewa='$harga_sewa', 
		lama_pinjam='$lama_pinjam', 
		total_bayar='$total_bayar', 
		status_sewa='$status_sewa'
	WHERE 
		id_sewa = $id
";

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
