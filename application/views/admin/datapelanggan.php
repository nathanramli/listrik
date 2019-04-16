<!-- isi halaman utama setelah navbar -->
<div class="col">

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('berhasilVerifikasi'); ?>" data-tempat="Pelanggan"></div>

	<br>
	<table id="tabel-pelanggan" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>ID Pelanggan</th>							
				<th>Nama Pelanggan</th>							
				<th>Alamat</th>							
				<th>Nomor KWH</th>
				<th>ID Tarif</th>							
				<th>Status</th>							
				<th>Verifikasi</th>							
			</tr>
		</thead>
		<tbody>

			<?php foreach ($pelanggan as $plgn) : 
				$idtemp = $plgn['id_pelanggan'];
				?>

				<tr>
					<td><?= $plgn['id_pelanggan']; ?></td>
					<td><?= $plgn['nama_pelanggan']; ?></td>
					<td><?= $plgn['alamat']; ?></td>

					<?php if($plgn['status'] === 'pending'): ?>

						<td class="text-center text-secondary">Belum terdaftar</td>
						<td class="text-center text-secondary">-</td>
						<td class="text-center"><span class="badge badge-warning badge-pill">Pending</span></td>
						<td class="text-center">
							<button type="button" class="btn btn-raised btn-success" id="verifModal" data-toggle="modal" data-target=".verif-modal-lg" onclick="gantiID('<?= $idtemp; ?>')"><i class="fa fa-check"></i> Verifikasi</button></a>
						</td>
						<?php else: ?>								

							<td class="text-center"><?= $plgn['nomor_kwh']; ?></td>
							<td class="text-center"><?= $plgn['id_tarif']; ?></td>
							<td class="text-center"><span class="badge badge-success badge-pill">Verified</span></td>
							<td class="text-center text-success"><i class="fa fa-check"></i></td>

						<?php endif;?>

					</tr>

				<?php endforeach; ?>

			</tbody>
		</table>

	</div>
	<div class="modal fade verif-modal-lg" tabindex="-1" role="dialog" aria-labelledby="verifModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Verifikasi Pelanggan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url(); ?>admin/verifikasiuser" method="post">
						<div class="form-group">
							<label for="selectTarif">Daya (Sesuai Rumah)</label>

							<input type="hidden" name="id_pelanggan" id="id_pelanggan">

							<select class="form-control" name="id_tarif" id="selectTarif">
								<?php foreach ($tarif as $trf) : ?>							    	
									<option value="<?= $trf['id_tarif']; ?>"><?= $trf['daya']; ?> VA - Rp.<?= $trf['tarifperkwh']; ?>/kWh</option>
								<?php endforeach; ?>
							</select>

						</div>								
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-outline-success">Verifikasi</button>
					</div>
				</form>
			</div>
		</div>
	</div>				