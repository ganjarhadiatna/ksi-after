<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$sql = "SELECT * FROM admin WHERE id_admin = '$id'";
$result = mysqli_query($koneksi,$sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_ignore('password', $row);
    array_push($data, $row);
}

echo json_encode($data);
