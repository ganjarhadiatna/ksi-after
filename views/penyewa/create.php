
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

		var nomor_identitas = $('#nomor-identitas').val();
		var nama = $('#nama-lengkap').val();
		var jenis_kelamin = $('#jenis-kelamin').val();
		var email = $('#email').val();
		var alamat = $('#alamat-lengkap').text();
		var nomor_telpon = $('#nomor-telpon').val();
		var status_penyewa = $('#status-penyewa').val();
		var cover = $('#foto')[0].files[0];

		//peminjam
		fd.append('nomor_identitas', nomor_identitas);
		fd.append('nama', nama);
		fd.append('jenis_kelamin', jenis_kelamin);
		fd.append('email', email);
		fd.append('alamat', alamat);
		fd.append('telp', nomor_telpon);
		fd.append('status_member', status_penyewa);
		fd.append('foto', cover);

		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '<?php echo base_url("api/post/penyewa.php"); ?>',
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
		   		window.location = '<?php echo base_url("?side=booking&path=list_customer"); ?>';
		   	} else {
				var messageBoxParagraph = document.createElement("p");
                var messagebox          = document.getElementById("input-validation-message-box");

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
		  	console.log(e.responseText);
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
<div>
	<div class="reservasi">
		<div class="main">
			<div class="frame-reservasi">
                <div id="input-validation-message-box"></div>

				<div class="here">
					<H2>Data Peminjam</H2>
				</div>
				<div class="here">
					<p>Nomor Identitas</p>
					<input type="text" name="name" placeholder="" class="txt txt-main-color" required="true" id="nomor-identitas">
				</div>
				<div class="here">
					<p>Nama Lengkap</p>
					<input type="text" name="nama" placeholder="" class="txt txt-main-color" required="true" id="nama-lengkap">
				</div>
				<div class="here">
					<p>Jenis Kelamin</p>
					<select class="select" required="true" id="jenis-kelamin">
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
				<div class="here">
					<p>Email</p>
					<input type="text" name="email" placeholder="" class="txt txt-main-color" required="true" id="email-penyewa">
				</div>
				<div class="here">
					<p>No. Telpon</p>
					<input type="text" name="name" placeholder="" class="txt txt-main-color" required="true" id="nomor-telpon">
				</div>
				<div class="here">
					<p>Alamat Lengkap</p>
					<div class="txt txt-main-color editable" contenteditable="true" id="alamat-lengkap"></div>
				</div>
				<div class="here">
					<p>Setatus Peminjam</p>
					<select class="select" required="true" id="status-penyewa">
						<option value="Biasa">Biasa</option>
						<option value="Member">Member</option>
					</select>
				</div>
			</div>

		</div>
		<div class="side">
			<div class="frame-reservasi reservasi-side">
				<div class="here">
					<H2>Foto Peminjam</H2>
				</div>
				<div class="here">
					<input type="file" name="foto" id="foto" onchange="loadCover()" accept="image/*">
					<label for="foto">
						<div class="frame-foto" id="place-foto">	
							<span class="fa fa-lg fa-plus"></span>
						</div>
					</label>
				</div>
				<div class="here">
					<input type="submit" name="save" class="btn btn-main-color" value="Tambahkan Peminjam" id="btn-submit">
				</div>
			</div>
		</div>
	</div>
</div>
</form>

