<!-- isi halaman utama setelah navbar -->
<div class="col">
	<br>
	<table id="tabel-tagihan" class="table  table-bordered table-striped table-hover">
		<thead>
			<tr> 
				<th>ID Tagihan</th>							
				<th>ID Penggunaan</th>							
				<th>ID Pelanggan</th>							
				<th>Bulan</th>
				<th>Tahun</th>							
				<th>Jumlah Meter (Akhir - Awal)</th>							
				<th>Status</th>							
			</tr>
		</thead>
		<tbody>

			<?php foreach ($tagihan as $tghn) : ?>

				<tr>
					<td><?= $tghn['id_tagihan']; ?></td>
					<td><?= $tghn['id_penggunaan']; ?></td>
					<td><?= $tghn['id_pelanggan']; ?></td>
					<td><?= $tghn['bulan']; ?></td>
					<td><?= $tghn['tahun']; ?></td>
					<td><?= $tghn['jumlah_meter']; ?> kWh</td>

					<?php if( $tghn['status'] === 'Belum Lunas' ): ?>

						<td class="text-center text-danger">Belum Lunas</td>

					<?php elseif( $tghn['status'] === 'Pending' ): ?>								

						<td class="text-center text-warning">Pending</td>

					<?php else: ?>								

						<td class="text-center text-success">Lunas</td>

					<?php endif;?>

					</tr>

				<?php endforeach; ?>

			</tbody>
		</table>

	</div>			
