<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = $_GET['id'];

$sql = "SELECT * FROM detail_sewa WHERE id_pinjam = $id";
$result = mysqli_query($koneksi,$sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}

echo json_encode($data);
