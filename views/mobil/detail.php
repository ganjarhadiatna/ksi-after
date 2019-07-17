<script type="text/javascript">
	var server = '<?php echo base_url(); ?>';
	var id = '<?php echo $_GET['id_car']; ?>';

	function deleteMobil(id_mobil) {
		var a = confirm('Yakin ingin menghapus kendaraan ini?');
			if (a == true) {

			$.ajax({
				url: '<?php echo base_url('api/delete/mobil.php'); ?>',
				type: 'get',
				dataType: 'json',
				data: {'id': id_mobil},
			})
			.done(function(rest) {
				if (rest.status == 'OK') {
					window.location = '<?php echo base_url("?side=car&path=list_car"); ?>';
				} else {
					alert(rest.message);
				}
				//console.log(rest);
			})
			.fail(function(e) {
				//console.log("error");
				alert(e.responseText);
			});
		}
			
	}


	function getDetail(id) {
		$.ajax({
			url: '<?php echo base_url('api/get/mobil.php'); ?>',
			type: 'get',
			dataType: 'json',
			data: {'ids': id},
		})
		.done(function(data) {
			if (data.status == 'OK') {
				console.log(data.data);
			} else {
				console.log(data.message);
			}
		})
		.fail(function(e) {
			console.log(e.responseText);
		});
		
	}
	$(document).ready(function() {
		getDetail(id);
	});
</script>
<div>	
	<?php 
		$rest = file_get_contents(base_url('api/get/mobil.php?id='.$_GET['id_car'])); 
		$data = json_decode($rest, true);
	?>
		
	<?php if ($data['status'] == 'ERROR') { ?>

		<h1 class="pad-bot-20px"><?php echo $data['message']; ?></h1>	

	<?php } else { ?>
		
		<?php $car = $data[0]; ?>

		<div>
			<div class="reservasi">
				<div class="main">
					<div class="frame-reservasi">
						<div class="here">
							<H2>Status Mobil</H2>
						</div>
						<div class="here">
							<?php if ($car['status'] == 'Bebas') { ?>
								<p class="maincolor">Mobil ini tersedia dan dapat Disewakan.</p>
							<?php } else { ?>
								<p class="maincolor">Mobil ini sedang Disewakan.</p>
							<?php } ?>
						</div>
					</div>
					<div class="frame-reservasi">
						<div class="here">
							<H2>Data Mobil</H2>
						</div>
						<div class="here">
							<table>
								<tbody>
									<tr>
										<td>ID Mobil</td>
										<td>:</td>
										<td><?php echo $car['id_mobil']; ?></td>
									</tr>
									<tr>
										<td>Nama Mobil</td>
										<td>:</td>
										<td><?php echo $car['nama']; ?></td>
									</tr>
									<tr>
										<td>Jenis Mobil</td>
										<td>:</td>
										<td><?php echo $car['jenis']; ?></td>
									</tr>
									<tr>
										<td>Merk Mobil</td>
										<td>:</td>
										<td><?php echo $car['merk']; ?></td>
									</tr>
									<tr>
										<td>Warna Mobil</td>
										<td>:</td>
										<td><?php echo $car['warna']; ?></td>
									</tr>
									<tr>
										<td>Tahun Mobil</td>
										<td>:</td>
										<td><?php echo $car['tahun']; ?></td>
									</tr>
									<tr>
										<td>Status Mobil</td>
										<td>:</td>
										<td><strong class="maincolor"><?php echo $car['status']; ?></strong></td>
									</tr>
									<tr>
										<td>Harga Sewa Mobil</td>
										<td>:</td>
										<td><?php echo 'Rp. '.$car['harga_sewa'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="frame-reservasi">
						<div class="here">
							<H2>Data Inti Mobil</H2>
						</div>
						<div class="here">
							<table>
								<tbody>
									<tr>
										<td>No. Polisi</td>
										<td>:</td>
										<td><?php echo $car['plat_nomor'] ?></td>
									</tr>
									<tr>
										<td>No. Mesin</td>
										<td>:</td>
										<td><?php echo $car['no_mesin'] ?></td>
									</tr>
									<tr>
										<td>No. Rangka</td>
										<td>:</td>
										<td><?php echo $car['no_rangka'] ?></td>
									</tr>
									<tr>
										<td>Isi Silinder</td>
										<td>:</td>
										<td><?php echo $car['isi_silinder'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="frame-reservasi">
						<div class="here">
							<H2>Lainnya</H2>
						</div>
						<div class="here">
							<p>Bagian ini bisa berisi catatan untuk Admin.</p>
						</div>
					</div>
				</div>
				<div class="side">
					<div class="frame-reservasi reservasi-side">
						<div class="here">
							<div class="foto-detail" style="background-image: url(<?php echo base_url('public/img/mobil/'.$car['foto']) ?>); background-color: #f0f0f0;"></div>
						</div>
						<div class="here">
							<a href="<?php echo base_url('?path=edit_car&id_car='.$car['id_mobil']) ?>">
								<button class="btm btn btn-sekunder-color" onclick="editMobil('<?php echo $car["id_mobil"] ?>')">Ubah</button>
							</a>
							<button class="btm btn btn-sekunder-color" onclick="deleteMobil('<?php echo $car["id_mobil"] ?>')">Hapus</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>

</div>