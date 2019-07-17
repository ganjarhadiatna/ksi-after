<?php

require("../koneksi.php");
require("../lib-yudi.php");

$sql = "SELECT * FROM detail_sewa";
$result = mysqli_query($koneksi,$sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}

echo json_encode($data);
