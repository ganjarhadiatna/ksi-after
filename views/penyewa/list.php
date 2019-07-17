<script type="text/javascript">
	function deletePeminjam(id) {
		var a = confirm('Yakin ingin menghapus peminjam ini?');
			if (a == true) {

			$.ajax({
				url: '<?php echo base_url('api/delete/penyewa.php'); ?>',
				type: 'get',
				dataType: 'json',
				data: {'id': id},
			})
			.done(function(rest) {
				if (rest.status == 'OK') {
					$('#place').html('');
					getPeminjam(10, 0);
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
	function getPeminjam(limit, offset) {
			var server = '<?php echo base_url(); ?>';

			$.ajax({
				url: '<?php echo base_url('api/get/penyewa_list.php'); ?>',
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
							<td>\
								<div class="foto" style="background-image: url('+server+'public/img/peminjam/'+data[i].foto+'); margin: auto;"></div>\
							</td>\
							<td>'+data[i].nomor_identitas+'</td>\
							<td>'+data[i].nama+'</td>\
							<td>'+data[i].jenis_kelamin+'</td>\
							<td>'+data[i].alamat+'</td>\
							<td>'+data[i].telp+'</td>\
							<td>'+data[i].email+'</td>\
							<td>\
								<a href="'+server+'?path=detail_customer&id_customer='+data[i].id_penyewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-eye"></span>\
									</button>\
								</a>\
								<a href="'+server+'?path=edit_customer&id_customer='+data[i].id_penyewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-pencil"></span>\
									</button>\
								</a>\
								<button class="bg btn btn-primary-color" onclick="deletePeminjam('+data[i].id_penyewa+')">\
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
				url: '<?php echo base_url('api/get/search/penyewa_list.php'); ?>',
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
							<td>\
								<div class="foto" style="background-image: url('+server+'public/img/peminjam/'+data[i].foto+'); margin: auto;"></div>\
							</td>\
							<td>'+data[i].nomor_identitas+'</td>\
							<td>'+data[i].nama+'</td>\
							<td>'+data[i].jenis_kelamin+'</td>\
							<td>'+data[i].alamat+'</td>\
							<td>'+data[i].telp+'</td>\
							<td>'+data[i].email+'</td>\
							<td>\
								<a href="'+server+'?path=detail_customer&id_customer='+data[i].id_penyewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-eye"></span>\
									</button>\
								</a>\
								<a href="'+server+'?path=edit_customer&id_customer='+data[i].id_penyewa+'">\
									<button class="bg btn btn-primary-color">\
										<span class="fa fa-lg fa-pencil"></span>\
									</button>\
								</a>\
								<button class="bg btn btn-primary-color" onclick="deletePeminjam('+data[i].id_penyewa+')">\
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
		getPeminjam(10, 0);
	});
</script>
<div class="room">
	
	<div class="frame-search">
		<form method="get" action="javascript:void(0)" onsubmit="getSearch(10, 0)">
			<input type="text" name="src" placeholder="Cari..." class="txt txt-sekunder-color" id="txt-search" required="true">
			<select class="select" name="ctr" id="ctr-search">
				<option value="id_penyewa">ID</option>
				<option value="nama">Nama</option>
				<option value="alamat">Alamat</option>
				<option value="telp">No. Telpon</option>
				<option value="email">Email</option>
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
						<th>Foto</th>
						<th>No Identitas</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>No. Telpon</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="place"></tbody>
			</table>
		</div>
	</div>
</div>