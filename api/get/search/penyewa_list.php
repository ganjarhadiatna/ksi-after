<?php

require("../../koneksi.php");
require("../../lib-yudi.php");

$src = $_GET['src'];
$ctr = $_GET['ctr'];

$sql = "
	SELECT
		* 
	FROM 
		penyewa 
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