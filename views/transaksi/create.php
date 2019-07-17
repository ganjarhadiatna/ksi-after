<script type="text/javascript">

	function chooseCar(id) {
		var id_kendaraan = $('#frame-car-'+id).find('#id').attr('key');
		var nama_kendaraan = $('#frame-car-'+id).find('#nama').attr('key');
		var harga_kendaraan = $('#frame-car-'+id).find('#harga').attr('key');

		$('#id-mobil').val(id_kendaraan);
		$('#nama-mobil').val(nama_kendaraan);
		$('#harga-sewa').val(harga_kendaraan);

		carList('hide');
	}

	function carList(stt) {
		if (stt == 'open') {
			$('#car-list').show();
		} else {
			$('#car-list').hide();
		}
	}

	function chooseProfile(id) {
		var id_peminjam = $('#frame-profile-'+id).find('#id').attr('key');
		var nomor_identitas = $('#frame-profile-'+id).find('#ktp').attr('key');
		var nama_peminjam = $('#frame-profile-'+id).find('#nama').attr('key');

		$('#id-penyewa').val(id_peminjam);
		$('#nomor-identitas').val(nomor_identitas);
		$('#nama-lengkap').val(nama_peminjam);

		customerList('hide');
	}

	function customerList(stt) {
		if (stt == 'open') {
			$('#customer-list').show();
		} else {
			$('#customer-list').hide();
		}
	}

	function publish() {
		var fd = new FormData();

		var id_penyewa = $('#id-penyewa').val();

		var tanggal_penyewaan = $('#tanggal-penyewaan').val();
		var tanggal_akhir_penyewaan = $('#tanggal-akhir-penyewaan').val();

		var id_mobil = $('#id-mobil').val();

		var harga_sewa = $('#harga-sewa').val();
		var lama_pinjam = $('#lama-pinjam').val();
		var total_biaya = $('#total-biaya').val();

		//mobil
		fd.append('id_mobil', id_mobil);
		fd.append('harga_sewa', harga_sewa);
		fd.append('lama_pinjam', lama_pinjam);

		//penyewa
		fd.append('id_penyewa', id_penyewa);

		//sewa
		fd.append('tgl_pinjam', tanggal_penyewaan);
		fd.append('tgl_akhir_pinjam', tanggal_akhir_penyewaan);
		fd.append('total_bayar', total_biaya);

		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '<?php echo base_url("api/post/sewa.php"); ?>',
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
		   		window.location = '<?php echo base_url("?side=transaction&path=list_transaction"); ?>';
		   	} else {
				var messageBoxParagraph = document.createElement("p");
				var messagebox 			= document.getElementById("input-validation-message-box");

				messagebox.innerHTML = ''; //reset

				messageBoxParagraph.innerHTML = data.message;
				messagebox.appendChild(messageBoxParagraph);
				window.scrollTo(0, 0);

		   		$('#btn-submit').val('Tambahkan Data');
		   	}
		   	//console.log(data);
		})
		.fail(function(e) {
		  	//alert('error terjadi, mohon ulangi lagi nanti.');
		  	alert(e.responseText);
		  	$('#btn-submit').val('Tambahkan Data');
		});

		return false;
	}
	function rangeDay(dt1, dt2)
	{
		var one_day = 1000 * 60 * 60 * 24;
		var date1 = dt1.getTime();
		var date2 = dt2.getTime();
		var diff = Math.abs(date1 - date2);
		return Math.round(diff / one_day);
	}
	$(document).ready(function() {
		var startDate,
        endDate,
        updateStartDate = function() {
            startPicker.setStartRange(startDate);
            endPicker.setStartRange(startDate);
            endPicker.setMinDate(startDate);
        },
        updateEndDate = function() {
            startPicker.setEndRange(endDate);
            startPicker.setMaxDate(endDate);
            endPicker.setEndRange(endDate);
        },
        startPicker = new Pikaday({
            field: document.getElementById('tanggal-penyewaan'),
            format: 'YYYY-MM-DD',
            minDate: new Date(),
            maxDate: new Date(2020, 12, 31),
            onSelect: function() {
                startDate = this.getDate();
                updateStartDate();
            }
        }),
        endPicker = new Pikaday({
            field: document.getElementById('tanggal-akhir-penyewaan'),
            format: 'YYYY-MM-DD',
            minDate: new Date(),
            maxDate: new Date(2030, 12, 31),
            onSelect: function() {
                endDate = this.getDate();
                updateEndDate();
            }
        }),
        _startDate = startPicker.getDate(),
        _endDate = endPicker.getDate();

        if (_startDate) {
            startDate = _startDate;
            updateStartDate();
        }

        if (_endDate) {
            endDate = _endDate;
            updateEndDate();
        }

        $('.date-picker').on('change', function(event) {
        	event.preventDefault();
        	var dt1 = new Date($('#tanggal-penyewaan').val());
        	var dt2 = new Date($('#tanggal-akhir-penyewaan').val());
        	$('#lama-pinjam').val(rangeDay(dt1, dt2));

			var price = $('#harga-sewa').val();
			var ttl = (rangeDay(dt1, dt2) * price);
			$('#total-biaya').val(ttl);
        });

	});
</script>
<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
	<div class="reservasi">
		<div class="main">
			<div class="frame-reservasi">
				<div id="input-validation-message-box"></div>

				<div class="here nav">
					<H2>Detail Kendaraan</H2>
					<button class="choose btn btn-main-color" type="button" onclick="carList('open')">
						<span>Pilih Kendaraan</span>
					</button>
				</div>
				<?php 
					$rest = file_get_contents(base_url('api/get/mobil.php?id='.$_GET['id_car'])); 
					$data = json_decode($rest, true);
					$car = $data[0];
				?>
				
				<div class="here">
					<p>ID Kendaraan</p>
					<input type="text" name="id-mobil" placeholder="" class="txt txt-main-color" required="true" disabled="true" value="<?php echo $car['id_mobil']; ?>" id="id-mobil">
				</div>
				<div class="here">
					<p>Nama Kendaraan</p>
					<input type="text" name="nama-mobil" placeholder="" class="txt txt-main-color" required="true" disabled="true" value="<?php echo $car['nama']; ?>" id="nama-mobil">
				</div>
				<div class="here">
					<p>Harga Sewa Kendaraan</p>
					<input type="text" name="harga-sewa" placeholder="" class="txt txt-main-color" required="true" disabled="true" value="<?php echo $car['harga_sewa']; ?>" id="harga-sewa">
				</div>
				
			</div>
			<div class="frame-reservasi">
				<div class="here nav">
					<H2>Detail Peminjam</H2>
					<button class="choose btn btn-main-color" type="button" onclick="customerList('open')">
						<span>Pilih Peminjam</span>
					</button>
				</div>
				<div class="here">
					<p>ID Peminjam</p>
					<input type="text" name="id_penyewa" placeholder="" class="txt txt-main-color" required="true" id="id-penyewa" disabled="true">
				</div>
				<div class="here">
					<p>Nomor Identitas</p>
					<input type="text" name="name" placeholder="" class="txt txt-main-color" required="true" id="nomor-identitas" disabled="true">
				</div>
				<div class="here">
					<p>Nama Lengkap</p>
					<input type="text" name="nama" placeholder="" class="txt txt-main-color" required="true" id="nama-lengkap" disabled="true">
				</div>

			</div>
			
		</div>

		<div class="side">
			<div class="frame-reservasi reservasi-side">
				<div class="here">
					<H2>Tanggal Peminjaman</H2>
				</div>
				<div class="here">
					<p>Tanggal Peminjaman</p>
					<input type="text" name="tanggal-penyewaan" placeholder="0000-00-00" class="date-picker txt txt-main-color" required="true" id="tanggal-penyewaan">
				</div>
				<div class="here">
					<p>Tanggal Akhir Peminjaman</p>
					<input type="text" name="tanggal-akhir-penyewaan" placeholder="0000-00-00" class="date-picker txt txt-main-color" required="true" id="tanggal-akhir-penyewaan">
				</div>
				<div class="here">
					<p>Lama Peminjaman / hari</p>
					<input type="text" name="lama-pinjam" placeholder="" class="txt txt-main-color" required="true" id="lama-pinjam" disabled="true">
				</div>
				<div class="here">
					<p>Total Biaya</p>
					<input type="text" name="total-biaya" placeholder="" class="txt txt-main-color" required="true" id="total-biaya" disabled="true">
				</div>
				<div class="here">
					<input type="submit" name="save" class="btn btn-main-color" value="Tambahkan Peminjaman" id="btn-submit">
				</div>
			</div>
		</div>

	</div>

</form>

<div class="frame-popup" id="car-list">
	<div class="fp-place center">
		<div class="top">
			<div class="col-1">
				<h3>Daftar Kendaraan</h3>
			</div>
			<div class="col-2">
				<button class="btn btn-circle btn-primary-color" onclick="carList('hide')">
					<span class="fa fa-lg fa-times"></span>
				</button>
			</div>
		</div>
		<div class="mid">
			<?php 
				$rest = file_get_contents(base_url('api/get/mobil_list.php')); 
				$data = json_decode($rest, true);
			?>
				
			<?php if ($data['status'] == 'ERROR') { ?>
				
				<h1 class="pad-bot-20px">
					<?php echo $data['message']; ?>
				</h1>

			<?php } else { ?>

				<?php

					for ($i=0; $i < count($data); $i++) { 
						# code...
						$car = $data[$i];
				?>

				<div class="frame-car" id="frame-car-<?php echo $car['id_mobil']; ?>" onclick="chooseCar('<?php echo $car['id_mobil']; ?>')">
					<div class="fc-place">
						<div class="col-1">
							<div class="top" title="lihat detail" style="background-image: url('<?php echo base_url('public/img/mobil/'.$car['foto']); ?>');"></div>
						</div>
						<div class="col-2">
							<div class="mid">
								<p key="<?php echo $car['id_mobil']; ?>" id="id">ID Kendaraan : <?php echo $car['id_mobil']; ?></p>
								<p key="<?php echo $car['harga_sewa']; ?>" id="harga">Harga Sewa : Rp. <?php echo $car['harga_sewa']; ?></p>
								<p key="<?php echo $car['nama']; ?>" id="nama">Nama : <?php echo $car['nama']; ?></p>
							</div>
						</div>
					</div>
				</div>

				<?php 
					} 
				?>

			<?php } ?>
		</div>
		<div class="bot"></div>
	</div>
</div>

<div class="frame-popup" id="customer-list">
	<div class="fp-place center">
		<div class="top">
			<div class="col-1">
				<h3>Daftar Peminjam</h3>
			</div>
			<div class="col-2">
				<button class="btn btn-circle btn-primary-color" onclick="customerList('hide')">
					<span class="fa fa-lg fa-times"></span>
				</button>
			</div>
		</div>
		<div class="mid">
			<?php 
				$rest = file_get_contents(base_url('api/get/penyewa_list.php')); 
				$data = json_decode($rest, true);
			?>
				
			<?php if ($data['status'] == 'ERROR') { ?>
				
				<h1 class="pad-bot-20px">
					<?php echo $data['message']; ?>
				</h1>

			<?php } else { ?>

				<?php

					for ($i=0; $i < count($data); $i++) { 
						# code...
						$profile = $data[$i];
				?>

				<div class="frame-car" id="frame-profile-<?php echo $profile['id_penyewa']; ?>" onclick="chooseProfile('<?php echo $profile['id_penyewa']; ?>')">
					<div class="fc-place">
						<div class="col-1">
							<div class="top" title="lihat detail" style="background-image: url('<?php echo base_url('public/img/peminjam/'.$profile['foto']); ?>');"></div>
						</div>
						<div class="col-2">
							<div class="mid">
								<p key="<?php echo $profile['id_penyewa']; ?>" id="id">
									ID Peminjam : <?php echo $profile['id_penyewa']; ?>
								</p>
								<p key="<?php echo $profile['nomor_identitas']; ?>" id="ktp">
									Nomor Identitas : <?php echo $profile['nomor_identitas']; ?>
								</p>
								<p key="<?php echo $profile['nama']; ?>" id="nama">
									Nama : <?php echo $profile['nama']; ?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<?php 
					} 
				?>

			<?php } ?>
		</div>
		<div class="bot"></div>
	</div>
</div>