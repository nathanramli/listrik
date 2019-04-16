<!-- isi halaman utama setelah navbar -->
<div class="col">
	<br>
	<table id="tabel-pembayaran" class="table  table-bordered table-striped table-hover">
		<thead>
			<tr> 
				<th>ID</th>							
				<th>ID Tagihan</th>							
				<th>ID Bank</th>							
				<th>Nama Bank</th>							
				<th>Tanggal Bayar</th>
				<th>Bulan Bayar</th>							
				<th>Biaya Admin</th>							
				<th>Total Bayar</th>							
				<th>Detail</th>							
			</tr>
		</thead>
		<tbody>

			<?php foreach ($pembayaran as $pbyr) : ?>

				<tr>
					<td><?= $pbyr['id_pembayaran']; ?></td>
					<td><?= $pbyr['id_tagihan']; ?></td>
					<td><?= $pbyr['id_bank']; ?></td>
					<td><?= $pbyr['nama_bank']; ?></td>
					<td><?= $pbyr['tanggal_pembayaran']; ?></td>
					<td><?= $pbyr['bulan_bayar']; ?></td>
					<td>Rp. <?= $pbyr['biaya_admin']; ?></td>
					<td>Rp. <?= $pbyr['total_bayar']; ?></td>

					<td class="text-center">
						<button type="button" class="btn btn-info btn-raised detailBayarUpdate mb-1" data-toggle="modal" data-target=".detail-modal-lg" data-id="<?= $pbyr['id_pembayaran']; ?>">
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
					Tanggal Pembayaran : <span class="text-info" id="dtanggal_pembayaran"></span><br><br>
					Bulan yang diBayar : <span class="text-info" id="dbulan_bayar"></span><br><br>
					Biaya admin : <span class="text-info">Rp. 2000</span><br><br>
					Total Bayar : <span class="text-info" id="dtotal_bayar"></span><br><br>
					ID Bank : <span class="text-info" id="did_bank"></span><br><br>
					Nama Bank : <span class="text-info" id="dnama_bank"></span><br><br>
					Status : <span class="text-info" id="dstatus"></span><br><br>
				</font>
				<hr>
				<a href="" id="id_targetpembayaran" class="btn btn-outline-primary float-right" target="_blank" role="button"><i class="fa fa-print"></i> Print</a>
			</div>
		</div>
	</div>	
</div>					
