<script type="text/javascript">
	function deleteTransaksi(id) {
		var a = confirm('Yakin ingin menghapus transaksi ini?');
		if (a == true) {
			$.ajax({
				url: '<?php echo base_url('api/delete/sewa.php'); ?>',
				type: 'get',
				dataType: 'json',
				data: {'id': id},
			})
			.done(function(rest) {
				if (rest.status == 'OK') {
					$('#place').html('');
					getSewa(10, 0);
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

	function getSewa(limit, offset) {
			var server = '<?php echo base_url(); ?>';

			$.ajax({
				url: '<?php echo base_url('api/get/sewa_list.php'); ?>',
				type: 'get',
				dataType: 'json',
				data: {
					'limit': limit,
					'offset': offset,
				}
			})
			.done(function(data) {
				var rest = [];
				for (var i = 0; i < data.length; i++) {
					rest += '\
						<tr>\
							<td>'+(i + 1)+'</td>\
							<td><div class="foto" style="background-image: url('+server+'public/img/mobil/'+data[i].foto+');"></td>\
							<td>'+data[i].nama_admin+'</td>\
							<td>'+data[i].nama_penyewa+'</td>\
							<td>'+data[i].tgl_pinjam+'</td>\
							<td>'+data[i].tgl_akhir_pinjam+'</td>\
							<td>'+data[i].lama_pinjam+' Hari</td>\
							<td>\
								<strong>'+data[i].status_sewa+'</strong>\
							</td>\
							<td>Rp. '+data[i].total_bayar+'</td>\
							<td>\
								<a href="'+server+'?path=detail_transaction&id_transaction='+data[i].id_sewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-eye"></span>\
									</button>\
								</a>\
								<a href="'+server+'?path=edit_transaction&id_transaction='+data[i].id_sewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-pencil"></span>\
									</button>\
								</a>\
								<button class="bg btn btn-primary-color" onclick="deleteTransaksi('+data[i].id_sewa+')">\
									<span class="fa fa-lg fa-trash"></span>\
								</button>\
							</td>\
						</tr>\
					';
				}
				$('#place').append(rest);

			})
			.fail(function(e) {
				console.log(e.responseText);
			});
	}
	function getSearch(limit, offset) {
			
			var server = '<?php echo base_url(); ?>';

			var src = $('#txt-search').val();
			var ctr = $('#ctr-search').val();

			$('#place').html('');

			$.ajax({
				url: '<?php echo base_url('api/get/search/sewa_list.php'); ?>',
				type: 'get',
				dataType: 'json',
				data: {
					'limit': limit,
					'offset': offset,
					'src': src,
					'ctr': ctr
				}
			})
			.done(function(data) {
				var rest = [];
				for (var i = 0; i < data.length; i++) {
					rest += '\
						<tr>\
							<td>'+(i + 1)+'</td>\
							<td><div class="foto" style="background-image: url('+server+'public/img/mobil/'+data[i].foto+');"></td>\
							<td>'+data[i].nama_admin+'</td>\
							<td>'+data[i].nama_penyewa+'</td>\
							<td>'+data[i].tgl_pinjam+'</td>\
							<td>'+data[i].tgl_akhir_pinjam+'</td>\
							<td>'+data[i].lama_pinjam+' Hari</td>\
							<td>\
								<strong>'+data[i].status_sewa+'</strong>\
							</td>\
							<td>Rp. '+data[i].total_bayar+'</td>\
							<td>\
								<a href="'+server+'?path=detail_transaction&id_transaction='+data[i].id_sewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-eye"></span>\
									</button>\
								</a>\
								<a href="'+server+'?path=edit_transaction&id_transaction='+data[i].id_sewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-pencil"></span>\
									</button>\
								</a>\
								<button class="bg btn btn-primary-color" onclick="deleteTransaksi('+data[i].id_sewa+')">\
									<span class="fa fa-lg fa-trash"></span>\
								</button>\
							</td>\
						</tr>\
					';
				}
				$('#place').append(rest);

			})
			.fail(function(e) {
				console.log(e.responseText);
			});
	}
	$(document).ready(function() {
		$('#place').html('');
		getSewa(10, 0);
	});
</script>
<div class="room">
	
	<div class="frame-search">
		<form method="get" action="javascript:void(0)" onsubmit="getSearch(10, 0)">
			<input type="text" name="src" placeholder="Cari..." class="txt txt-sekunder-color" id="txt-search" required="true">
			<select class="select" name="ctr" id="ctr-search">
				<option value="id_sewa">ID</option>
				<option value="tgl_pinjam">Tgl Pinjam</option>
				<option value="tgl_akhir_pinjam">Tgl Akhir Pinjam</option>
				<option value="lama_pinjam">Lama Pinjam</option>
				<option value="total_bayar">Total Bayar</option>
			</select>
			<button class="src btn btn-main-color" type="submit">
				<span class="fa fa-lg fa-search"></span>
			</button>
		</form>
	</div>
	<div class="pad-bot-20px"></div>

	<div class="frame-reservasi">
		<div class="here">
			<table>
				<thead>
					<tr>
						<th>No</th>
						<th>Kendaraan</th>
						<th>Admin</th>
						<th>Nama Peminjam</th>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Akhir Pinjam</th>
						<th>Lama Pinjam</th>
						<th>Status Sewa</th>
						<th>Total Bayar</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="place"></tbody>
				<tbody>
					<!--pake for-->
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><strong class="maincolor">Rp. 00</strong></td>
						<td>
							<button class="bg btn btn-main-color">
								<span class="fa fa-lg fa-print"></span>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
