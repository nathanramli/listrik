<!-- isi halaman utama setelah navbar -->
<div class="col">
	
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksiAdmin'); ?>" data-tempat="Admin"></div>

	<br>
	<table id="tabel-admin" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>ID Admin</th>							
				<th>Username</th>							
				<th>Password</th>							
				<th>Nama Admin</th>							
				<th>Level</th>							
				<th>
					<button type="button" class="btn btn-outline-success" id="tambahModal" data-toggle="modal" data-target=".tambah-modal-lg"><i class="fa fa-plus-circle"></i> Tambah Admin</button>			
				</th>
			</tr>
		</thead>

		<tbody>

			<?php foreach ($dataadmin as $dadm) : ?>

				<tr>
					<td><?= $dadm['id_admin']; ?></td>
					<td><?= $dadm['username']; ?></td>
					<td>&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;</td>
					<td><?= $dadm['nama_admin']; ?></td>
					<td><?= $dadm['nama_level']; ?></td>
					<td>
						<button type="button" class="btn btn-warning editUpdateAdmin" data-toggle="modal" data-target=".edit-modal-lg" data-id="<?= $dadm['id_admin']; ?>" 
							<?php if($dadm['id_level'] == 1){ ?> 
								disabled 
							<?php } ?> 
							>
							<i class="fa fa-edit"></i> Edit
						</button>
						<a href="<?= base_url(); ?>admin/hapusadmin/<?= $dadm['id_admin']; ?>" class="btn btn-danger ml-1 tombol-hapus 
						<?php if($dadm['id_level'] == 1){ ?> 
							disabled 
						<?php } ?>" >
							<i class="far fa-trash-alt"></i> Hapus
						</a>
					</td>
				</tr>

			<?php endforeach; ?>

		</tbody>
	</table>
</div>
	
<!-- MODAL EDIT ADMIN -->

<div class="modal fade edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Edit Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>admin/editadmin" method="post">
					<input type="hidden" name="id_admin" id="edid_admin">
					<div class="form-group">
						<label for="edselectUser">Level Admin</label>

						<select class="form-control" name="id_level" id="edselectUser" >
							<option value="2">Admin</option>
							<option value="3">Petugas Entry</option>
						</select>

					</div>								  
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" id="edusername" required="">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="text" name="password" class="form-control" id="edpassword" required="">
					</div>
					<div class="form-group">
						<label for="namaadmin">Nama Admin</label>
						<input type="text" name="namaadmin" class="form-control" id="ednamaadmin" required="">
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

<!-- MODAL TAMBAH ADMIN -->

<div class="modal fade tambah-modal-lg" tabindex="-1" role="dialog" aria-labelledby="tambahModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulmodal">Tambah Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url(); ?>admin/tambahadmin" method="post">
					
					<div class="form-group">
						<label for="selectUser">Level Admin</label>

						<select class="form-control" name="id_level" id="selectUser">
							<option value="2">Admin</option>
							<option value="3">Petugas Entry</option>
						</select>

					</div>								  
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" id="username" >
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="text" name="password" class="form-control" id="password" >
					</div>
					<div class="form-group">
						<label for="namaadmin">Nama Admin</label>
						<input type="text" name="namaadmin" class="form-control" id="namaadmin" >
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