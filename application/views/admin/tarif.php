<!-- isi halaman utama setelah navbar -->
<div class="col">

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksiTarif'); ?>" data-tempat="Tarif"></div>

	<br>
	<table id="tabel-tarif" class="table  table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>ID Tarif</th>							
				<th>Daya</th>							
				<th>Tarif Per kWh</th>							
				<th>
					<button type="button" class="btn btn-outline-success" id="tambahModal" data-toggle="modal" data-target=".tambah-modal-lg"><i class="fa fa-plus-circle"></i> Tambah Tarif</button>
				</th>
			</tr>
		</thead>

		<tbody>

			<?php foreach ($tarif as $trf) : ?>

				<tr>
					<td><?= $trf['id_tarif']; ?></td>
					<td><?= $trf['daya']; ?> VA</td>
					<td>Rp. <?= $trf['tarifperkwh']; ?></td>
					<td><button type="button" class="btn btn-warning editUpdateTarif" data-toggle="modal" data-target=".edit-modal-lg" data-id="<?= $trf['id_tarif']; ?>"><i class="fa fa-edit"></i> Edit</button><a href="<?= base_url(); ?>admin/hapustarif/<?= $trf['id_tarif']; ?>" class="btn btn-danger ml-1 tombol-hapus"><i class="far fa-trash-alt"></i> Hapus</a></td>
				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>
</div>
<div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Edit Tarif</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>admin/edittarif" method="post">
					<input type="hidden" name="id_tarif" id="edid_tarif">
					<div class="form-group">
						<label for="daya">Daya</label>
						<input type="number" min="1" value="1" class="form-control" name="daya" id="eddaya" >
					</div>
					<div class="form-group">
						<label for="tarifperkwh">Tarif Per Kwh</label>
						<input type="number" min="0" value="0" name="tarifperkwh" class="form-control" id="edtarifperkwh" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>				
<div class="modal fade tambah-modal-lg" tabindex="-1" role="dialog" aria-labelledby="tambahModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Tambah Tarif</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url(); ?>admin/tambahtarif" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="daya">Daya</label>
						<input type="number" min="1" value="1" class="form-control" name="daya" id="daya" >
					</div>
					<div class="form-group">
						<label for="tarifperkwh">Tarif Per Kwh</label>
						<input type="number" min="0" value="0" name="tarifperkwh" class="form-control" id="tarifperkwh" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

