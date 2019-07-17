<?php 
require_once 'config/url.php';
require_once 'config/session.php';

if (!empty(session::get('idadmin'))) {
	header('Location: '.base_url('?side=home&path=home'));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rental Mobil</title>
	<meta charset="utf-8">
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="public/css/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="public/css/assets.css">
	<link rel="stylesheet" type="text/css" href="public/css/header.css">
	<link rel="stylesheet" type="text/css" href="public/css/body.css">
	<link rel="stylesheet" type="text/css" href="public/css/search.css">
	<link rel="stylesheet" type="text/css" href="public/css/story.css">
	<link rel="stylesheet" type="text/css" href="public/css/sign.css">

	<!-- JS -->
	<script type="text/javascript" src="public/js/jquery.js"></script>
	<script type="text/javascript">
        function alert(message) {
        	$('#alert').show().find('#message').html(message);
        }
        $(document).ready(function() {
        	$('#form-sign').submit(function(event) {
        		var username = $('#username').val();
	        	var password = $('#password').val();
	        	
	        	$.ajax({
	        		url: '<?php echo base_url('api/auth/login.php') ?>',
	        		type: 'post',
	        		dataType: 'json',
	        		data: {'username': username, 'password': password},
	        	})
	        	.done(function(data) {
	        		if (data.status == 'OK') {
	        			window.location = "<?php echo base_url('?side=home&path=home') ?>";
	        		} else {
	        			alert(data.message);
	        		}
	        		console.log(data);
	        	})
	        	.fail(function(e) {
	        		alert(e.responseText);
	        		console.log(e);
	        	});
	        	
        	});
        });
	</script>
</head>
<body>
	<div class="frame-sign">
		<div class="top">
			<h1>Login</h1>
		</div>
		<div class="mid">
			<div id="alert">
				<span id="message">Message</span>
			</div>
			<form method="post" action="javascript:void(0)" id="form-sign">
				<div class="sig-block">
					<p>Username</p>
					<input type="username" name="username" class="txt txt-main-color" required="required" id="username">
				</div>
				<div class="sig-block">
					<p>Password</p>
					<input type="password" name="password" class="txt txt-main-color" required="required" id="password">
				</div>
				<div class="pad-bot-15px"></div>
				<div class="sig-block">
					<input type="submit" name="login" class="btn btn-main-color" value="Login">
				</div>
			</form>
		</div>
		<div class="bot">
			<div class="all">
				<strong>RENTAL MOBIL</strong> @ 2018 all right reserved
			</div>
		</div>
	</div>
</body>
</html>
