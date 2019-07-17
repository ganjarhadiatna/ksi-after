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
		var id_sewa = $('#id-sewa').val();
		var tgl_pinjam = $('#tgl-pinjam').val();
		var tgl_akhir_pinjam = $('#tgl-akhir-pinjam').val();
		var lama_pinjam = $('#lama-pinjam').val();
		var harga_sewa = $('#harga-sewa').val();
		var total_bayar = $('#total-biaya').val();
		var status_sewa = $('#status-sewa').val();

		fd.append('id_sewa', id_sewa);
		fd.append('tgl_pinjam', tgl_pinjam);
		fd.append('tgl_akhir_pinjam', tgl_akhir_pinjam);
		fd.append('lama_pinjam', lama_pinjam);
		fd.append('harga_sewa', harga_sewa);
		fd.append('total_bayar', total_bayar);
		fd.append('status_sewa', status_sewa);

		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '<?php echo base_url("api/put/sewa.php"); ?>',
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
		   		window.location = '?path=detail_transaction&id_transaction='+id_sewa;
		   	} else {
				alert(data.message);
		   		$('#btn-submit').val('Simpan Kembali');
		   	}
		})
		.fail(function(data) {
		  	//alert('error terjadi, mohon ulangi lagi nanti.');
		  	console.log(data.responseJSON);
		  	$('#btn-submit').val('Simpan Perubahan');
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
            field: document.getElementById('tgl-pinjam'),
            format: 'YYYY-MM-DD',
            minDate: new Date(),
            maxDate: new Date(2020, 12, 31),
            onSelect: function() {
                startDate = this.getDate();
                updateStartDate();
            }
        }),
        endPicker = new Pikaday({
            field: document.getElementById('tgl-akhir-pinjam'),
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
        	var dt1 = new Date($('#tgl-pinjam').val());
        	var dt2 = new Date($('#tgl-akhir-pinjam').val());
        	$('#lama-pinjam').val(rangeDay(dt1, dt2));

			var price = $('#harga-sewa').val();
			var ttl = (rangeDay(dt1, dt2) * price);
			$('#total-biaya').val(ttl);
        });
    });
</script>
<div>
	<div>
	<?php 
		$rest = file_get_contents(base_url('api/get/sewa.php?id='.$_GET['id_transaction'])); 
		$data = json_decode($rest, true);
	?>
		
	<?php if ($data['status'] == 'ERROR') { ?>

		<h1 class="pad-bot-20px"><?php echo $data['message']; ?></h1>	

	<?php } else { ?>
		
		<?php $dt = $data[0]; ?>

		<!--butuh data mobil-->
		<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
			<div>
				<div class="reservasi">
					<div class="main">
						<div class="frame-reservasi">
							<div class="here">
								<H2>Data Sewa</H2>
							</div>
							<div class="here">
								<p>ID Sewa</p>
								<input type="text" name="id-sewa" placeholder="" class="txt txt-main-color" id="id-sewa" required="true" value="<?php echo $dt['id_sewa']; ?>" disabled="true">
							</div>
							<div class="here">
								<p>Tanggal Pinjam</p>
								<input type="text" name="tgl-pinjam" placeholder="" class="date-picker txt txt-main-color" id="tgl-pinjam" required="true" value="<?php echo $dt['tgl_pinjam']; ?>">
							</div>
							<div class="here">
								<p>Tanggal Akhir Pinjam</p>
								<input type="text" name="tgl-akhir-pinjam" placeholder="" class="date-picker txt txt-main-color" id="tgl-akhir-pinjam" required="true" value="<?php echo $dt['tgl_akhir_pinjam']; ?>">
							</div>
							<div class="here">
								<p>Lama Pinjam</p>
								<input type="text" name="lama-pinjam" placeholder="" class="txt txt-main-color" id="lama-pinjam" required="true" value="<?php echo $dt['lama_pinjam']; ?>" disabled="true">
							</div>
							<div class="here">
								<p>Harga Sewa</p>
								<input type="text" name="harga-sewa" placeholder="" class="txt txt-main-color" id="harga-sewa" required="true" value="<?php echo $dt['harga_sewa']; ?>" disabled="true">
							</div>
							<div class="here">
								<p>Total Pembayaran</p>
								<input type="text" name="total-biaya" placeholder="" class="txt txt-main-color" id="total-biaya" required="true" value="<?php echo $dt['total_bayar']; ?>" disabled="true">
							</div>
							<div class="here">
								<p>Status Transaksi</p>
								<select class="select" id="status-sewa">
									<?php if ($dt['status_sewa'] == 'Selesai') { ?>
										<option value="Selesai" selected="true">Selesai</option>
										<option value="Belum Selesai">Belum Selesai</option>
									<?php } else { ?>
										<option value="Selesai">Selesai</option>
										<option value="Belum Selesai" selected="true">Belum Selesai</option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="side">
						<div class="frame-reservasi">
							<div class="here">
								<H2>Simpan Perubahan</H2>
							</div>
							<div class="here">
								<input type="submit" name="save" class="btn btn-main-color" id="btn-submit" value="Simpan Perubahan">
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</form>
		
		<?php } ?>

	</div>
</div>
