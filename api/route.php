<?php
//include config
require_once '../config/session.php';
require_once '../config/database.php';

//include controllers
require_once '../controllers/controllerAuth.php';
require_once '../controllers/controllerMobil.php';


//define route
$type = $_REQUEST['type'];
$path = $_REQUEST['path'];

if (isset($type) && isset($path)) {

	//list API post
	if ($type == 'post') {

		if ($path == 'login') {
		
			echo controllerAuth::login(
				$_POST['username'], 
				$_POST['password']
			);

		}

		if ($path == 'new_car') {
			echo controllerMobil::create(
				$_FILES['cover'], 
				$_POST['nama'], 
				$_POST['jenis'], 
				$_POST['merk'], 
				$_POST['warna'], 
				$_POST['nomor_polisi'], 
				$_POST['nomor_rangka'], 
				$_POST['nomor_mesin'], 
				$_POST['slinder'], 
				$_POST['harga'], 
				$_POST['tahun']
			);
		}

	}

	//list API get
	if ($type == 'get') {

		//mobil
		if ($path == 'list_car') {
			echo controllerMobil::list($_GET['limit'], $_GET['offset']);
		}

		if ($path == 'logout') {
			echo controllerAuth::logout();
		}

	}

} else {

	echo 'API error';

}
