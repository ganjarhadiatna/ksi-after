<?php

require("../koneksi.php");
require("../lib-yudi.php");
require("../../config/session.php");

session::end();

echo json_encode([
	'status'    => 'OK',
	'message'   => 'Logout success',
]);	