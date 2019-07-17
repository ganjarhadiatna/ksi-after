<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

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
		penyewa.jenis_kelamin,
		penyewa.telp,
		penyewa.email,
		penyewa.alamat,
		penyewa.status_member,
		mobil.foto,
		mobil.nama as nama_mobil,
		mobil.jenis,
		mobil.merk,
		mobil.warna,
		mobil.tahun,
		mobil.plat_nomor,
		mobil.no_mesin,
		mobil.no_rangka,
		mobil.isi_silinder,
		mobil.status,
		mobil.harga_sewa
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
		id_sewa = '$id'
";

$result = mysqli_query($koneksi,$sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}

echo json_encode($data);
