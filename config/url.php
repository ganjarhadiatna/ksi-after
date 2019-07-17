<?php
/*
--
Code by Ganjar Hadiatna
--
*/
function base_url($value='')
{
	if ($value == '') {
		return 'http://'.$_SERVER['SERVER_NAME'].''.dirname($_SERVER['REQUEST_URI'].'?').'/';
	} else {
		return 'http://'.$_SERVER['SERVER_NAME'].''.dirname($_SERVER['REQUEST_URI'].'?').'/'.$value;
	}
}