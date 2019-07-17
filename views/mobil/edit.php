<script type="text/javascript">
	function loadCover() {
		var OFReader = new FileReader();
		OFReader.readAsDataURL(document.getElementById("foto").files[0]);
		OFReader.onload = function (oFREvent) {
			$("#place-foto").css('background-image', 'url('+oFREvent.target.result+')');
		}
	}
	function publish() {
		var fd = new FormData();
		var id = $('#id-mobil').val();
		var nama = $('#nama-mobil').val();
		var jenis = $('#jenis-mobil').val();
		var merk = $('#merk-mobil').val();
		var warna = $('#warna-mobil').val();
		var nomor_polisi = $('#nomor-polisi').val();
		var nomor_rangka = $('#nomor-rangka').val();
		var nomor_mesin = $('#nomor-mesin').val();
		var slinder = $('#isi-slinder').val();
		var harga = $('#harga-sewa').val();
		var tahun = $('#tahun-mobil').val();
		var status = $('#status-mobil').val();

		fd.append('id', id);
		fd.append('nama', nama);
		fd.append('jenis', jenis);
		fd.append('merk', merk);
		fd.append('warna', warna);
		fd.append('plat_nomor', nomor_polisi);
		fd.append('no_rangka', nomor_rangka);
		fd.append('no_mesin', nomor_mesin);
		fd.append('isi_silinder', slinder);
		fd.append('harga_sewa', harga);
		fd.append('tahun', tahun);
		fd.append('status', status);
		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '<?php echo base_url("api/put/mobil.php"); ?>',
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false,
			type: 'post',
			beforeSend: function() {
				$('#btn-submit').val('Sedang Menambahkan');
			}
		})
		.done(function(data) {
		   	if (data.status == 'OK') {
		   		window.location = '<?php echo base_url("?path=detail_car&id_car=".$_GET['id_car']) ?>';
		   	} else {
				alert(data.message);
		   		$('#btn-submit').val('Simpan Perubahan');
		   	}
		})
		.fail(function(data) {
		  	alert(data.responseText);
		  	//console.log(data.responseJSON);
		  	$('#btn-submit').val('Simpan Perubahan');
		});

		return false;
	}
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

			<!--butuh data mobil-->
			<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
				<div>
					<div class="reservasi">
						<div class="main">
							<div class="frame-reservasi">
								<div class="here">
									<H2>Data Publik Mobil</H2>
								</div>
								<div class="here">
									<p>ID Mobil</p>
									<input type="text" name="id-mobil" placeholder="" class="txt txt-main-color" id="id-mobil" required="true" 
									value="<?php echo $car['id_mobil']; ?>"
									disabled="true">
								</div>
								<div class="here">
									<p>Nama Mobil</p>
									<input type="text" name="nama" placeholder="" class="txt txt-main-color" id="nama-mobil" required="true" 
									value="<?php echo $car['nama']; ?>"
									>
								</div>
								<div class="here">
									<p>Jenis Mobil</p>
									<input type="text" name="jenis" placeholder="" class="txt txt-main-color" id="jenis-mobil" required="true" 
									value="<?php echo $car['jenis']; ?>"
									>
								</div>
								<div class="here">
									<p>Merk Mobil</p>
									<input type="text" name="merk" placeholder="" class="txt txt-main-color" id="merk-mobil" required="true" 
									value="<?php echo $car['merk']; ?>"
									>
								</div>
								<div class="here">
									<p>Warna</p>
									<input type="text" name="warna" placeholder="" class="txt txt-main-color" id="warna-mobil" required="true" 
									value="<?php echo $car['warna']; ?>"
									>
								</div>
								<div class="here">
									<p>Status</p>
									<select class="select" id="status-mobil">
										<!--validasi status kendaraan-->
										<?php if ($car['status'] == 'Bebas') { ?>
											<option value="Bebas" selected="true">Bebas</option>
											<option value="Disewa">Disewa</option>
										<?php } else { ?>
											<option value="Bebas">Bebas</option>
											<option value="Disewa" selected="true">Disewa</option>
										<?php } ?>

									</select>
								</div>
							</div>
							<div class="frame-reservasi">
								<div class="here">
									<H2>Data Inti Mobil</H2>
								</div>
								<div class="here">
									<p>Nomor Polisi</p>
									<input type="text" name="no-polisi" placeholder="" class="txt txt-main-color" id="nomor-polisi" required="true" 
									value="<?php echo $car['plat_nomor']; ?>"
									>
								</div>
								<div class="here">
									<p>Nomor Rangka</p>
									<input type="text" name="no-rangka" placeholder="" class="txt txt-main-color" id="nomor-rangka" required="true" 
									value="<?php echo $car['no_rangka']; ?>"
									>
								</div>
								<div class="here">
									<p>Nomor Mesin</p>
									<input type="text" name="no-mesin" placeholder="" class="txt txt-main-color" id="nomor-mesin" required="true" 
									value="<?php echo $car['no_mesin']; ?>"
									>
								</div>
								<div class="here">
									<p>Isi Silinder</p>
									<input type="text" name="slinder" placeholder="" class="txt txt-main-color" id="isi-slinder" required="true" 
									value="<?php echo $car['isi_silinder']; ?>"
									>
								</div>
							</div>
							<div class="frame-reservasi">
								<div class="here">
									<H2>Lainnya</H2>
								</div>
								<div class="here">
									<p>Harga Sewa</p>
									<input type="text" name="harga" placeholder="" class="txt txt-main-color" id="harga-sewa" required="true" value="<?php echo $car['harga_sewa']; ?>">
								</div>
								<div class="here">
									<p>Tahun Mobil</p>
									<input type="text" name="tahun" placeholder="" class="txt txt-main-color" id="tahun-mobil" required="true" value="<?php echo $car['tahun']; ?>">
								</div>
							</div>
						</div>
						<div class="side">
							<div class="frame-reservasi reservasi-side">
								<div class="here">
									<H2>Gambar Tidak Dapat Diubah</H2>
								</div>
								<div class="here">
									<label for="foto">
										<div class="frame-foto" id="place-foto" style="background-image: url(<?php echo base_url('public/img/mobil/'.$car['foto']) ?>);"></div>
									</label>
								</div>
								<div class="here">
									<input type="submit" name="save" class="btn btn-main-color" id="btn-submit" value="Simpan Perubahan">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	<?php } ?>

</div>
