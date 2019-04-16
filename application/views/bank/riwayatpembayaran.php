<!-- isi halaman utama setelah navbar -->
<div class="col">

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksiBankTransaksi'); ?>"></div>

	<br>
	<table id="tabel-riwayatPembayaran" class="table  table-bordered table-striped table-hover">
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

			<?php foreach ($pembayaran as $pbyr) : ?>

				<tr>
					<td><?= $pbyr['id_pembayaran']; ?></td>
					<td><?= $pbyr['id_tagihan']; ?></td>
					<td><?= $pbyr['id_pelanggan']; ?></td>
					<td><?= $pbyr['tanggal_pembayaran']; ?></td>
					<td><?= $pbyr['bulan_bayar']; ?></td>
					<td>Rp. <?= $pbyr['biaya_admin']; ?></td>
					<td>Rp. <?= $pbyr['total_bayar']; ?></td>

					<td class="text-center">
						<button type="button" class="btn btn-primary detailBayarUpdate mb-1" data-toggle="modal" data-target=".detail-modal-lg" data-id="<?= $pbyr['id_pembayaran']; ?>">
							<i class="fa fa-search"></i> Detail
						</button>					
					</td>

				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>

</div>	
<div class="modal fade detail-modal-lg" tabindex="-1" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Detail Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<font face="courier">
					<h5 class="text-center">Pembayaran</h5>
					ID Pembayaran : <span class="text-info" id="did_pembayaran"></span><br><br>
					ID Tagihan : <span class="text-info" id="did_tagihan"></span><br><br>
					ID Pelanggan : <span class="text-info" id="did_pelanggan"></span><br><br>
					Nama Pelanggan : <span class="text-info" id="dnama_pelanggan"></span><br><br>
					Tanggal Pembayaran : <span class="text-info" id="dtanggal_pembayaran"></span><br><br>
					Bulan yang diBayar : <span class="text-info" id="dbulan_bayar"></span><br><br>
					Biaya admin : <span class="text-info">Rp. 2000</span><br><br>
					Total Bayar : <span class="text-info" id="dtotal_bayar"></span><br><br>
				</font>
				<hr>
				<a href="" id="id_targetpembayaran" class="btn btn-outline-primary float-right" target="_blank"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
	</div>	
</div>			
