<!-- isi halaman utama setelah navbar -->
<div class="col">

	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksiPenggunaan'); ?>" data-tempat="Penggunaan"></div>

	<br>
	<table id="tabel-penggunaan" class="table  table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>							
				<th>ID Pelanggan</th>							
				<th>Bulan</th>							
				<th>Tahun</th>							
				<th>Meter Awal</th>							
				<th>Meter Akhir</th>							
				<th>
					<button type="button" class="btn btn-outline-success tambahPenggunaan" id="tambahModal" data-toggle="modal" data-target=".tambah-modal-lg"><i class="fa fa-plus-circle"></i> Tambah Data</button>			
				</th>
			</tr>
		</thead>

		<tbody>

			<?php foreach ($penggunaan as $pgn) : ?>

				<tr>
					<td><?= $pgn['id_penggunaan']; ?></td>
					<td><?= $pgn['id_pelanggan']; ?></td>
					<td><?= $pgn['bulan']; ?></td>
					<td><?= $pgn['tahun']; ?></td>
					<td><?= $pgn['meter_awal']; ?> kWh</td>
					<td><?= $pgn['meter_akhir']; ?> kWh</td>
					<td>
						<button type="button" class="btn btn-warning editUpdatePenggunaan" data-toggle="modal" data-target=".edit-modal-lg" data-id="<?= $pgn['id_penggunaan']; ?>">
							<i class="fa fa-edit"></i> Edit
						</button>
						<a href="<?= base_url(); ?>admin/hapuspenggunaan/<?= $pgn['id_penggunaan']; ?>" class="btn btn-danger ml-1 tombol-hapus">
							<i class="fa fa-trash-alt"></i> Hapus
						</a>
					</td>
				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>
</div>
<div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Edit data penggunaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>admin/editdatapenggunaan" method="post">

					<input type="hidden" name="id_penggunaan" id="edid_penggunaan" >

					<div class="form-group">
						<label for="selectUser">ID Pelanggan</label>

						<select class="form-control" name="id_pelanggan" id="selectUser">
							<?php foreach ($pelanggan as $plgn) : ?>							    	
								<option value="<?= $plgn['id_pelanggan']; ?>"><?= $plgn['id_pelanggan']; ?> - <?= $plgn['nama_pelanggan']; ?></option>
							<?php endforeach; ?>
						</select>

					</div>		
					<div class="form-group">
						<label for="edbulan">Bulan</label>
						<input type="number" min="1" value="1" max="12" class="form-control" name="bulan" id="edbulan" >
					</div>
					<div class="form-group">
						<label for="edtahun">Tahun</label>
						<input type="number" min="2010" value="2019" max="2100" name="tahun" class="form-control" id="edtahun" >
					</div>
					<div class="form-group">
						<label for="edmeterawal">Meter Awal</label>
						<input type="number" min="0" value="0" class="form-control" name="meterawal" id="edmeterawal" >
					</div>
					<div class="form-group">
						<label for="edmeterakhir">Meter Akhir</label>
						<input type="number" min="1" value="1" class="form-control" name="meterakhir" id="edmeterakhir" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div>				
<div class="modal fade tambah-modal-lg" tabindex="-1" role="dialog" aria-labelledby="tambahModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Tambah data penggunaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>admin/tambahdatapenggunaan" method="post">
					<div class="form-group">
						<label for="selectUser">ID Pelanggan</label>

						<select class="form-control updateBulan" name="id_pelanggan" id="selectUser">
							<?php foreach ($pelanggan as $plgn) : ?>							    	
								<option value="<?= $plgn['id_pelanggan']; ?>"><?= $plgn['id_pelanggan']; ?> - <?= $plgn['nama_pelanggan']; ?></option>
							<?php endforeach; ?>
						</select>
						<small class="text-danger" id="kataDanger">* Penggunaan pada bulan ini sudah diinput</small>

					</div>								
					<div class="form-group">
						<label for="bulan">Bulan</label>
						<input type="number" min="1" value="1" max="12" class="form-control" name="bulan" id="bulan" readonly="" required="">
					</div>
					<div class="form-group">
						<label for="tahun">Tahun</label>
						<input type="number" min="2010" value="2019" max="2100" name="tahun" class="form-control" id="tahun" readonly="" required="">
					</div>
					<div class="form-group">
						<label for="meterawal">Meter Awal</label>
						<input type="number" min="0" value="0" class="form-control" name="meterawal" id="meterawal"  readonly="">
					</div>
					<div class="form-group">
						<label for="meterakhir">Meter Akhir</label>
						<input type="number" min="1" value="1" class="form-control" name="meterakhir" id="meterakhir" >
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary tombolTambahPenggunaan"><i class="fa fa-plus"></i> Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

