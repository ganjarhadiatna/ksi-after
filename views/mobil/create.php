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
		var foto = $('#foto')[0].files[0];
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

		fd.append('foto', foto);
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

		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '<?php echo base_url('api/post/mobil.php') ?>',
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
			console.log(data);
			if (data.status == 'OK') {
				window.location = '<?php echo base_url("?side=car&path=list_car"); ?>';
			} else {


				var messageBoxParagraph = document.createElement("p");
				var messagebox 			= document.getElementById("input-validation-message-box");

				messagebox.innerHTML = ''; //reset

				messageBoxParagraph.innerHTML = data.message;
				messagebox.appendChild(messageBoxParagraph);
				window.scrollTo(0, 0);

		   		$('#btn-submit').val('Tambahkan Data');
			}
		   	console.log(data);
		})
		.fail(function(e) {
		  	//alert('error terjadi, mohon ulangi lagi nanti.');
		  	console.log(e);
		  	$('#btn-submit').val('Tambahkan Data');
		});

		return false;
	}
</script>
<div>
	<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
		<div>
			<div class="reservasi">
				<div class="main">
					<div class="frame-reservasi">
						<div id="input-validation-message-box"></div>

						<div class="here">
							<H2>Data Publik Kendaraan</H2>
						</div>
						<div class="here">
							<p>Nama Kendaraan</p>
							<input type="text" name="nama" placeholder="" class="txt txt-main-color" id="nama-mobil" required="true">
						</div>
						<div class="here">
							<p>Jenis Kendaraan</p>
							<input type="text" name="jenis" placeholder="" class="txt txt-main-color" id="jenis-mobil" required="true">
						</div>
						<div class="here">
							<p>Merk Kendaraan</p>
							<input type="text" name="merk" placeholder="" class="txt txt-main-color" id="merk-mobil" required="true">
						</div>
						<div class="here">
							<p>Warna</p>
							<input type="text" name="warna" placeholder="" class="txt txt-main-color" id="warna-mobil" required="true">
						</div>
					</div>
					<div class="frame-reservasi">
						<div class="here">
							<H2>Data Inti Kendaraan</H2>
						</div>
						<div class="here">
							<p>Nomor Polisi</p>
							<input type="text" name="no-polisi" placeholder="" class="txt txt-main-color" id="nomor-polisi" required="true">
						</div>
						<div class="here">
							<p>Nomor Rangka</p>
							<input type="text" name="no-rangka" placeholder="" class="txt txt-main-color" id="nomor-rangka" required="true">
						</div>
						<div class="here">
							<p>Nomor Mesin</p>
							<input type="text" name="no-mesin" placeholder="" class="txt txt-main-color" id="nomor-mesin" required="true">
						</div>
						<div class="here">
							<p>Isi Silinder</p>
							<input type="text" name="slinder" placeholder="" class="txt txt-main-color" id="isi-slinder" required="true">
						</div>
					</div>
					<div class="frame-reservasi">
						<div class="here">
							<H2>Lainnya</H2>
						</div>
						<div class="here">
							<p>Harga Sewa</p>
							<input type="text" name="harga" placeholder="" class="txt txt-main-color" id="harga-sewa" required="true">
						</div>
						<div class="here">
							<p>Tahun Mobil</p>
							<input type="text" name="tahun" placeholder="" class="txt txt-main-color" id="tahun-mobil" required="true">
						</div>
					</div>
				</div>
				<div class="side">
					<div class="frame-reservasi reservasi-side">
						<div class="here">
							<H2>Pilih Gambar</H2>
						</div>
						<div class="here">
							<input type="file" name="foto" id="foto" onchange="loadCover()" required="true" accept="image/*">
							<label for="foto">
								<div class="frame-foto" id="place-foto">
									<span class="fa fa-lg fa-plus"></span>
								</div>
							</label>
						</div>
						<div class="here">
							<input type="submit" name="save" class="btn btn-main-color" id="btn-submit" value="Tambahkan Data">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>