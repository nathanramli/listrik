<!-- isi halaman utama setelah navbar -->
<div class="col">
	<br>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('aksiTagihan'); ?>" data-tempat="Pembayaran"></div>
	<table id="tabel-tagihan" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>ID Tagihan</th>							
				<th>ID Penggunaan</th>							
				<th>Bulan</th>							
				<th>Tahun</th>							
				<th>Jumlah Meter ( Akhir - Awal )</th>							
				<th>Proses</th>							
			</tr>
		</thead>
		<tbody>

			<?php foreach ($tagihan as $tghn) : ?>

				<tr>
					<td><?= $tghn['id_tagihan']; ?></td>
					<td><?= $tghn['id_penggunaan']; ?></td>
					<td><?= $tghn['bulan']; ?></td>
					<td><?= $tghn['tahun']; ?></td>
					<td><?= $tghn['jumlah_meter']; ?> kWh</td>

					<?php if($tghn['status'] == "Belum Lunas"): ?>

						<td>
							<button type="button" class="btn btn-success bayarUpdate" data-toggle="modal" data-target="#bayar-modal-lg" data-id="<?= $tghn['id_tagihan']; ?>">
								<i class="fa fa-dollar-sign"></i> Bayar
							</button>
						</td>

						<?php else: ?>

							<td>
								<a href="" class="btn btn-warning disabled mb-1">
									<i class="fa fa-clock"></i> Pending
								</a>
								<button type="button" class="btn btn-primary detailUpdate mb-1" data-toggle="modal" data-target=".detail-modal-lg" data-id="<?= $tghn['id_tagihan']; ?>">
									<i class="fa fa-search"></i> Detail
								</button>
							</td>

						<?php endif; ?>

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
				</div>
			</div>
		</div>	
	</div>				
	<div class="modal fade" id="bayar-modal-lg" tabindex="-1" role="dialog" aria-labelledby="bayarModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="judulmodal">Bayar Tagihan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url(); ?>user/bayar" method="post">
					<div class="modal-body">
						<input type="hidden" name="id_tagihan" id="id_tagihan">
						<input type="hidden" name="bulan" id="bulan">
						<input type="hidden" name="tahun" id="tahun">

						<div class="form-group">
							<label for="selectUser">ID Bank</label>
							<select class="form-control" name="id_bank" id="selectUser">
								<?php foreach ($bank as $bnk) : ?>							    	
									<option value="<?= $bnk['id_bank']; ?>"><?= $bnk['id_bank']; ?> - <?= $bnk['nama_bank']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>		

						<div class="form-group">
							<label for="jumlahmeteran">Jumlah Meteran</label>
							<input type="number" class="form-control" name="jumlahmeteran" id="jumlahmeteran" readonly="" required="">
						</div>
						<div class="form-group">
							<label for="tarif">Tarif Per kWh</label>
							<input type="number" class="form-control" name="tarif" id="tarif" readonly="" required="">
						</div>
						<div class="form-group">
							<label for="biayaadmin">Biaya Admin</label>
							<input type="number" value="2000"class="form-control" name="biayaadmin" id="biayaadmin" readonly="" required="">
						</div>
						<hr>
						<div class="form-group">
							<label for="totalbayar">Total Bayar :</label>
							<input type="number" name="totalbayar" class="form-control" id="totalbayar" readonly="" required="">
							<small id="info" class="text-info"></small>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>
					</div>
				</form>
			</div>
		</div>
	</div>					