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
					window.location = '<?php echo base_url("?side=transaction&path=list_transaction"); ?>';
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
	<?php 
		$rest = file_get_contents(base_url('api/get/sewa.php?id='.$_GET['id_transaction'])); 
		$data = json_decode($rest, true);
	?>
		
	<?php if ($data['status'] == 'ERROR') { ?>

		<h1 class="pad-bot-20px"><?php echo $data['message']; ?></h1>	

	<?php } else { ?>
		
		<?php $dt = $data[0]; ?>

		<div>
			<div class="reservasi">
				<div class="main">
					<div class="frame-reservasi">
						<div class="here">
							<H2>Detail Admin</H2>
						</div>
						<div class="here">
							<table>
								<tbody>
									<tr>
										<td>ID Admin</td>
										<td>:</td>
										<td>
											<strong class="maincolor">
												<?php echo $dt['id_admin']; ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>Nama Admin</td>
										<td>:</td>
										<td>
											<?php echo $dt['nama_admin']; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
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
										<td>
											<strong class="maincolor">
												<?php echo $dt['id_penyewa']; ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>:</td>
										<td><?php echo $dt['nama_penyewa']; ?></td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>:</td>
										<td><?php echo $dt['jenis_kelamin']; ?></td>
									</tr>
									<tr>
										<td>Nomor Telpon</td>
										<td>:</td>
										<td><?php echo $dt['telp']; ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td>:</td>
										<td><?php echo $dt['email']; ?></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td><?php echo $dt['alamat']; ?></td>
									</tr>
									<tr>
										<td>Status Member</td>
										<td>:</td>
										<td><?php echo $dt['status_member']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="here">
							<a href="<?php echo base_url('?path=detail_customer&id_customer='.$dt['id_penyewa']); ?>">
								<button class="btm btn btn-sekunder-color">Detail</button>
							</a>
						</div>
						<div class="here">
							<a href="<?php echo base_url('?path=edit_customer&id_customer='.$dt['id_penyewa']); ?>">
								<button class="btm btn btn-sekunder-color">Ubah</button>
							</a>
						</div>
					</div>
					<div class="frame-reservasi">
						<div class="here">
							<H2>Detail Mobil</H2>
						</div>
						<div class="here">
							<table>
								<tbody>
									<tr>
										<td>ID Mobil</td>
										<td>:</td>
										<td>
											<strong class="maincolor">
												<?php echo $dt['id_mobil'] ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>Nama Mobil</td>
										<td>:</td>
										<td><?php echo $dt['nama_mobil']; ?></td>
									</tr>
									<tr>
										<td>Jenis Mobil</td>
										<td>:</td>
										<td><?php echo $dt['jenis']; ?></td>
									</tr>
									<tr>
										<td>Merk Mobil</td>
										<td>:</td>
										<td><?php echo $dt['merk']; ?></td>
									</tr>
									<tr>
										<td>Warna Mobil</td>
										<td>:</td>
										<td><?php echo $dt['warna']; ?></td>
									</tr>
									<tr>
										<td>Tahun Mobil</td>
										<td>:</td>
										<td><?php echo $dt['tahun']; ?></td>
									</tr>
									<tr>
										<td>No. Polisi</td>
										<td>:</td>
										<td><?php echo $dt['plat_nomor']; ?></td>
									</tr>
									<tr>
										<td>No. Mesin</td>
										<td>:</td>
										<td><?php echo $dt['no_mesin']; ?></td>
									</tr>
									<tr>
										<td>No. Rangka</td>
										<td>:</td>
										<td><?php echo $dt['no_rangka']; ?></td>
									</tr>
									<tr>
										<td>Isi Silinder</td>
										<td>:</td>
										<td><?php echo $dt['isi_silinder']; ?></td>
									</tr>
									<tr>
										<td>Status Mobil</td>
										<td>:</td>
										<td>
											<strong class="maincolor">
												<?php echo $dt['status']; ?>
											</strong>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="here">
							<a href="<?php echo base_url('?path=detail_car&id_car='.$dt['id_mobil']); ?>">
								<button class="btm btn btn-sekunder-color">Detail</button>
							</a>
						</div>
						<div class="here">
							<a href="<?php echo base_url('?path=edit_car&id_car='.$dt['id_mobil']); ?>">
								<button class="btm btn btn-sekunder-color">Ubah</button>
							</a>
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
							<H2>Detail Pembayaran</H2>
						</div>
						<div class="here">
							<table>
								<tbody>
									<tr>
										<td>ID</td>
										<td>:</td>
										<td>
											<strong class="maincolor">
												<?php echo $dt['id_sewa']; ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>Tanggal Pinjam</td>
										<td>:</td>
										<td><?php echo $dt['tgl_pinjam']; ?></td>
									</tr>
									<tr>
										<td>Tanggal Akhir Pinjam</td>
										<td>:</td>
										<td><?php echo $dt['tgl_akhir_pinjam']; ?></td>
									</tr>
									<tr>
										<td>Lama Pinjam</td>
										<td>:</td>
										<td><?php echo $dt['lama_pinjam']; ?> Hari</td>
									</tr>
									<tr>
										<td>Harga Sewa</td>
										<td>:</td>
										<td>
											<strong class="maincolor">
												Rp. <?php echo $dt['harga_sewa']; ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>Total Pembayaran</td>
										<td>:</td>
										<td>
											<strong class="maincolor">
												Rp. <?php echo $dt['total_bayar']; ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td>Status Sewa</td>
										<td>:</td>
										<td><?php echo $dt['status_sewa']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="here">
							<a href="<?php echo base_url('?path=edit_transaction&id_transaction='.$dt['id_sewa']); ?>">
								<button class="btm btn btn-sekunder-color">Ubah</button>
							</a>
							<button class="btm btn btn-sekunder-color" onclick="deleteTransaksi('{{ $sw->id_sewa }}')">Hapus</button>
							<div class="pad-bot-15px"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>

</div>
