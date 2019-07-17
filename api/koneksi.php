<?php
$koneksi=mysqli_connect(
    "localhost",
    "root",
    "delapanbelas",
    "db_rentalmobil"
);


//check koneksi
if (mysqli_connect_errno()) {
    exit(json_encode([
        'status' => 'ERROR',
        'message' => mysqli_error($koneksi),
    ]));
}
