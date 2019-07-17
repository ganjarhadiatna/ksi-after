<?php
require_once 'config/url.php';
require_once 'config/session.php';

if (empty(session::get('idadmin'))) {
	header('Location: '.base_url('login.php'));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rental Mobil</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="public/css/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="public/css/assets.css">
	<link rel="stylesheet" type="text/css" href="public/css/header.css">
	<link rel="stylesheet" type="text/css" href="public/css/body.css">
	<link rel="stylesheet" type="text/css" href="public/css/search.css">
	<link rel="stylesheet" type="text/css" href="public/css/story.css">
	<link rel="stylesheet" type="text/css" href="public/css/pikaday.css">

	<!-- JS -->
	<script type="text/javascript" src="public/js/jquery.js"></script>
	<script type="text/javascript" src="public/js/moment.js"></script>
	<script type="text/javascript" src="public/js/pikaday.js"></script>
	<script type="text/javascript">
		function logout() {
			var a = confirm('logout sekarang?');
			if (a == true) {
				$.ajax({
	        		url: '<?php echo base_url('api/auth/logout.php') ?>',
	        		dataType: 'json',
	        	})
	        	.done(function(rest) {
	        		if (rest.status == 'OK') {
	        			window.location = "<?php echo base_url('login.php') ?>";
	        		}
	        	})
	        	.fail(function(e) {
	        		alert(e.statusText);
	        		console.log(e);
	        	});
			}
        }
		$(document).ready(function() {
			var menu = '<?php echo $_GET['side'] ?>';
			$('#'+menu).addClass('active');
		});
	</script>
</head>
<body>

<div id="body">
	<div id="side">
		<div id="side">
			<ul id="side-menu">
				<div class="here bdr-bottom">
					<div class="usr">
						<h2>Options</h2>
					</div>
				</div>
				<div class="here">
					<strong>Main</strong>
					<a href="<?php echo base_url('?side=home&path=home'); ?>">
						<li id="home">
							<span class="icn fa fa-lg fa-home"></span>
							<span class="ttl">Halaman Utama</span>
						</li>
					</a>
				</div>

				<div class="here">
					<strong>Add</strong>
					<a href="<?php echo base_url('?side=add_car&path=new_car'); ?>">
						<li id="add_car">
							<span class="icn fa fa-lg fa-plus"></span>
							<span class="ttl">Tambah Kendaraan</span>
						</li>
					</a>
					<a href="<?php echo base_url('?side=add_customer&path=new_customer'); ?>">
						<li id="add_customer">
							<span class="icn fa fa-lg fa-user-plus"></span>
							<span class="ttl">Tambah Peminjam</span>
						</li>
					</a>
					<a href="<?php echo base_url('?side=add_transaction&path=new_transaction'); ?>">
						<li id="add_transaction">
							<span class="icn fa fa-lg fa-cart-plus"></span>
							<span class="ttl">Tambah Transaksi</span>
						</li>
					</a>
				</div>
				<div class="here">
					<strong>Data</strong>
					<a href="<?php echo base_url('?side=car&path=list_car'); ?>">
						<li id="car">
							<span class="icn fa fa-lg fa-car"></span>
							<span class="ttl">Data Kendaraan</spamn>
						</li>
					</a>
					<a href="<?php echo base_url('?side=customer&path=list_customer'); ?>">
						<li id="customer">
							<span class="icn fa fa-lg fa-users"></span>
							<span class="ttl">Data Peminjam</spamn>
						</li>
					</a>
					<a href="<?php echo base_url('?side=transaction&path=list_transaction'); ?>">
						<li id="transaction">
							<span class="icn fa fa-lg fa-shopping-cart"></span>
							<span class="ttl">Data Transaksi</spamn>
						</li>
					</a>
				</div>
				<div class="here">
					<strong>Tools</strong>
						<li onclick="logout()" style="cursor: pointer;">
							<span class="icn fa fa-lg fa-power-off"></span>
							<span class="ttl">Logout</span>
						</li>
				</div>
			</ul>
		</div>
	</div>
	<div id="main">
		<?php
			$path = $_GET['path'];
			if ($path == 'home') {
				include 'views/home.php';
			}

			//car
			if ($path == 'new_car') {
				include 'views/mobil/create.php';
			}
			if ($path == 'list_car') {
				include 'views/mobil/list.php';
			}
			if ($path == 'detail_car') {
				include 'views/mobil/detail.php';
			}
			if ($path == 'edit_car') {
				include 'views/mobil/edit.php';
			}

			//customer
			if ($path == 'new_customer') {
				include 'views/penyewa/create.php';
			}
			if ($path == 'list_customer') {
				include 'views/penyewa/list.php';
			}
			if ($path == 'detail_customer') {
				include 'views/penyewa/detail.php';
			}
			if ($path == 'edit_customer') {
				include 'views/penyewa/edit.php';
			}

			//transaction
			if ($path == 'new_transaction') {
				include 'views/transaksi/create.php';
			}
			if ($path == 'list_transaction') {
				include 'views/transaksi/list.php';
			}
			if ($path == 'detail_transaction') {
				include 'views/transaksi/detail.php';
			}
			if ($path == 'edit_transaction') {
				include 'views/transaksi/edit.php';
			}

			if (is_null($path)) {
				include 'views/home.php';
			}
		?>
	</div>
</div>
</body>
</html>