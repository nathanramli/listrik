

				<!-- isi halaman utama setelah navbar -->
				<div class="col">

					<br>
					<table id="tabel-penggunaan" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>ID Penggunaan</th>							
								<th>Bulan</th>							
								<th>Tahun</th>							
								<th>Meter Awal</th>							
								<th>Meter Akhir</th>							
							</tr>
						</thead>
						<tbody>

							<?php foreach ($penggunaan as $pngn) : ?>

							<tr>
								<td><?= $pngn['id_penggunaan']; ?></td>
								<td><?= $pngn['bulan']; ?></td>
								<td><?= $pngn['tahun']; ?></td>
								<td><?= $pngn['meter_awal']; ?></td>
								<td><?= $pngn['meter_akhir']; ?></td>
							</tr>

							<?php endforeach; ?>

						</tbody>
					</table>
						
				</div>		
