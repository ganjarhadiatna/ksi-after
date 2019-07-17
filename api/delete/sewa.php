<?php

require("../koneksi.php");
require("../lib-yudi.php");

$id = $_GET['id'];

$sql = "DELETE FROM sewa WHERE id_sewa = $id";
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
