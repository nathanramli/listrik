<!-- isi halaman utama setelah navbar -->
<div class="col">

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksiBankTransaksi'); ?>"></div>

	<br>
	<table id="tabel-prosesTransaksi" class="table  table-bordered table-striped table-hover">
		<thead>
			<tr> 
				<th>ID Pembayaran</th>							
				<th>ID Tagihan</th>							
				<th>ID Pelanggan</th>							
				<th>Tanggal Pembayaran</th>
				<th>Bulan Bayar</th>							
				<th>Biaya Admin</th>							
				<th>Total Bayar</th>							
				<th>Status</th>							
			</tr>
		</thead>
		<tbody>

			<?php foreach ($transaksi as $trns) : ?>

				<tr>
					<td><?= $trns['id_pembayaran']; ?></td>
					<td><?= $trns['id_tagihan']; ?></td>
					<td><?= $trns['id_pelanggan']; ?></td>
					<td><?= $trns['tanggal_pembayaran']; ?></td>
					<td><?= $trns['bulan_bayar']; ?></td>
					<td>Rp. <?= $trns['biaya_admin']; ?></td>
					<td>Rp. <?= $trns['total_bayar']; ?></td>

					<td class="text-center">
						<a href="<?= base_url(); ?>bank/verifikasitransaksi/<?= $trns['id_pembayaran']; ?>" class="btn btn-outline-success mb-1 tombol-verifikasi-pembayaran">
							<i class="fa fa-check"></i> Verifikasi
						</a> 
						<a href="<?= base_url(); ?>bank/tolaktransaksi/<?= $trns['id_pembayaran']; ?>" class="btn btn-outline-danger mb-1 tombol-tolak">
							<i class="fa fa-trash-alt"></i> Tolak
						</a>									
					</td>

				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>

</div>		
