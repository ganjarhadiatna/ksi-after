<?php

require("../koneksi.php");
require("../lib-yudi.php");

//$limit = $_GET['limit'];
//$offset = $_GET['offset'];

$sql = "SELECT * FROM penyewa";
$result = mysqli_query($koneksi,$sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}

echo json_encode($data);
