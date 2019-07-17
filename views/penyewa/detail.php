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
					window.location = '<?php echo base_url("?side=customer&path=list_customer"); ?>';
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
</script>
<div>
	<div>
	<?php 
		$rest = file_get_contents(base_url('api/get/penyewa.php?id='.$_GET['id_customer'])); 
		$data = json_decode($rest, true);
	?>
		
	<?php if ($data['status'] == 'ERROR') { ?>

		<h1 class="pad-bot-20px"><?php echo $data['message']; ?></h1>	

	<?php } else { ?>
		
		<?php $profile = $data[0]; ?>
		<div>
			<div class="reservasi">
				<div class="main">
					<div class="frame-reservasi">
						<div class="here">
							<H2>Detail Penyewa</H2>
						</div>
						<div class="here">
							<table>
								<tbody>
									<tr>
										<td>ID Penyewa</td>
										<td>:</td>
										<td><?php echo $profile['id_penyewa']; ?></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>:</td>
										<td><?php echo $profile['nama']; ?></td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>:</td>
										<td><?php echo $profile['jenis_kelamin']; ?></td>
									</tr>
									<tr>
										<td>Nomor Telpon</td>
										<td>:</td>
										<td><?php echo $profile['telp']; ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td>:</td>
										<td><?php echo $profile['email']; ?></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td><?php echo $profile['alamat']; ?></td>
									</tr>
									<tr>
										<td>Status Member</td>
										<td>:</td>
										<td><?php echo $profile['status_member']; ?></td>
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
							<div class="foto-detail" style="background-image: url(<?php echo base_url('public/img/peminjam/'.$profile['foto']); ?>); background-size: cover; background-color: #f0f0f0;"></div>
						</div>
						<div class="here">
							<a href="<?php echo base_url("?path=edit_customer&id_customer=".$_GET['id_customer']) ?>">
								<button class="btm btn btn-sekunder-color">Ubah</button>
							</a>
							<button class="btm btn btn-sekunder-color" onclick="deletePeminjam('<?php echo $profile['id_penyewa'] ?>')">Hapus</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>

	</div>


</div>
