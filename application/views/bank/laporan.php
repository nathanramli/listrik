<div class="col">
	<br>
	<table id="tabel-laporan" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Bulan</th>							
				<th>Tahun</th>							
				<th>Banyak Pembayaran</th>							
				<th>Laporan</th>							
			</tr>
		</thead>
		<tbody>

			<?php foreach ($laporan as $lpr) : ?>

			<tr>
				<?php $ex = explode('/', $lpr['bulan_bayar']); ?>
				<td align="center"><?= $ex[0]; ?></td>
				<td align="center"><?= $ex[1]; ?></td>
				<td><b><?= $lpr['count']; ?></b> Pembayaran</td>
				<?php $id = str_replace('/', '__', $lpr['bulan_bayar']); ?>
				<td><a href="<?= base_url(); ?>bank/printlaporan/<?= $id; ?>" class="btn btn-raised btn-info" target="_blank"><i class="fa fa-print"></i> Cetak Laporan</a></td>
			</tr>

			<?php endforeach; ?>

		</tbody>
	</table>
</div>