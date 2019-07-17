<div class="dashboard">
	<div class="col-3">
		
		<div class="card-dash">
			<div class="top">
				Tambah Kendaraan
			</div>
			<a href="<?php echo base_url('?side=add_car&path=new_car'); ?>">
				<div class="mid">
					<div class="fa fa-lg fa-plus"></div>
				</div>
			</a>
		</div>

		<div class="card-dash">
			<div class="top">
				Tambah Peminjam
			</div>
			<a href="<?php echo base_url('?side=add_customer&path=new_customer'); ?>">
				<div class="mid">
					<div class="fa fa-lg fa-user-plus"></div>
				</div>
			</a>
		</div>

		<div class="card-dash">
			<div class="top">
				Tambah Transaksi
			</div>
			<a href="<?php echo base_url('?side=add_transaction&path=new_transaction'); ?>">
				<div class="mid">
					<div class="fa fa-lg fa-cart-plus"></div>
				</div>
			</a>
		</div>

		<div class="card-dash">
			<div class="top">
				Daftar Kendaraan
			</div>
			<a href="<?php echo base_url('?side=car&path=list_car'); ?>">
				<div class="mid">
					<div class="fa fa-lg fa-car"></div>
				</div>
			</a>
		</div>

		<div class="card-dash">
			<div class="top">
				Daftar Peminjam
			</div>
			<a href="<?php echo base_url('?side=customer&path=list_customer'); ?>">
				<div class="mid">
					<div class="fa fa-lg fa-users"></div>
				</div>
			</a>
		</div>

		<div class="card-dash">
			<div class="top">
				Daftar Transaksi
			</div>
			<a href="<?php echo base_url('?side=transaction&path=list_transaction'); ?>">
				<div class="mid">
					<div class="fa fa-lg fa-shopping-cart"></div>
				</div>
			</a>
		</div>


	</div>
</div>