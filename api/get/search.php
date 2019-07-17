<?php

require("../koneksi.php");
require("../lib-yudi.php");

$table   =  $_GET['table'];
$column  =  $_GET['column'];
$value   =  $_GET['value'];

$sql = "SELECT * FROM $table WHERE $column = $value";
$result = mysqli_query($koneksi,$sql);

if (! db_has_record($result)) {
    echo json_encode([
        'status' => 'ERROR',
        'message' => 'Data tidak ditemukan'
    ]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_ignore('password', $row);
    array_push($data, $row);
}

echo json_encode($data);
