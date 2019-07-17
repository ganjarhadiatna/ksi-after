<?php

require("../../koneksi.php");
require("../../lib-yudi.php");

$src = $_GET['src'];
$ctr = $_GET['ctr'];

$sql = "
	SELECT 
		sewa.id_penyewa,
		sewa.id_admin,
		sewa.id_sewa,
		sewa.id_mobil,
		sewa.tgl_pinjam,
		sewa.tgl_akhir_pinjam,
		sewa.lama_pinjam,
		sewa.total_bayar,
		sewa.status_sewa,
		admin.nama as nama_admin,
		penyewa.nama as nama_penyewa,
		mobil.foto
	FROM 
		sewa
	LEFT JOIN
		admin 
	ON 
		sewa.id_admin = admin.id_admin
	LEFT JOIN
		penyewa 
	ON 
		sewa.id_penyewa = penyewa.id_penyewa
	LEFT JOIN
		mobil 
	ON 
		sewa.id_mobil = mobil.id_mobil
	WHERE 
		$ctr
	LIKE 
		'%$src%'
";

$result = mysqli_query($koneksi, $sql);

if ($result)
{

	if ($result->num_rows > 0) 
	{
		$data = [];
		while ($row = mysqli_fetch_assoc($result)) {
		    array_push($data, $row);
		}

		echo json_encode($data);
	}

	if (empty($result->num_rows))
	{
		echo json_encode([
	        'status'    => 'ERROR',
	        'message'   => 'Data Tidak Ditemukan',
	    ]);
	}

}
else 
{
	echo json_encode([
        'status'    => 'ERROR',
        'message'   => mysqli_error($koneksi),
    ]);
}