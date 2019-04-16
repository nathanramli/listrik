<!-- isi halaman utama setelah navbar -->
<div class="col">				
	<div class="row mt-3">
		<div class="col-11">
			<hr>
			<h5 style="font-family: Courier;">Grafik Penggunaan dan Pembayaran</h5>
			<hr>
			<canvas id="canvas"></canvas>
		</div>
	</div>			

	<script>
		var lineChartData = {
			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
			datasets: [{
				label: 'Penggunaan',
				borderColor: 'rgb(255, 99, 132)',
				backgroundColor: 'rgb(255, 99, 132)',
				fill: false,
				data: [
				<?= $jumlah1 ?>,
				<?= $jumlah2 ?>,
				<?= $jumlah3 ?>,
				<?= $jumlah4 ?>,
				<?= $jumlah5 ?>,
				<?= $jumlah6 ?>
				],
				yAxisID: 'y-axis-1',
			}, {
				label: 'Pembayaran',
				borderColor: 'rgb(54, 162, 235)',
				backgroundColor: 'rgb(54, 162, 235)',
				fill: false,
				data: [
				<?= $jumlahL1 ?>,
				<?= $jumlahL2 ?>,
				<?= $jumlahL3 ?>,
				<?= $jumlahL4 ?>,
				<?= $jumlahL5 ?>,
				<?= $jumlahL6 ?>
				],
				yAxisID: 'y-axis-2'
			}]
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = Chart.Line(ctx, {
				data: lineChartData,
				options: {
					responsive: true,
					hoverMode: 'index',
					stacked: false,
					title: {
						display: true,
						text: 'Data Penggunaaan & Data Pembayaran'
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}, {
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'right',
							id: 'y-axis-2',

							// grid line settings
							gridLines: {
								drawOnChartArea: false, // only want the grid lines for one axis to show up
							},
						}],
					}
				}
			});
		};				
	</script>

	<hr>
	<h5 style="font-family: Courier;">Quick Info</h5>
	<hr>
	<div class="row">
		<div class="col-6 border p-0">
			<div class="col-4 bg-success float-left h-100 text-center pt-5">
				<i class="fa fa-users text-white fa-4x"></i> 
			</div>
			<div class="col-8 float-right h-100 text-center p-4">
				<font face="Comic Sans MS" size="5">
				<?= $jumlahpelanggan; ?><br>
				User terdaftar
				</font>
			</div>			
		</div>		

		<div class="col-6 border p-0 ">
			<div class="col-4 bg-danger float-left h-100 text-center pt-5">
				<i class="fa fa-file-invoice-dollar text-white fa-4x"></i> 
			</div>
			<div class="col-8 float-right h-100 text-center p-5">
				<font face="Comic Sans MS" size="5">
				<?= $jumlahtagihan; ?><br>
				Tunggakan
				</font>
			</div>			
		</div>
		<div class="col-6 border p-0">
			<div class="col-4 bg-warning float-left h-100 text-center pt-5">
				<i class="fa fa-id-card text-white fa-4x"></i> 
			</div>
			<div class="col-8 float-right h-100 text-center p-5">
				<font face="Comic Sans MS" size="5">
				<?= $jumlahadmin ?><br>
				Admin
				</font>
			</div>
		</div>
		<div class="col-6 border p-0">
			<div class="col-4 bg-primary h-100 float-left text-center pt-5">
				<i class="fa fa-check text-white fa-4x"></i> 
			</div>
			<div class="col-8 float-right h-100 text-center p-5">
				<font face="Comic Sans MS" size="5">
				<?= $jumlahlunas ?><br>
				Pembayaran lunas
				</font>
			</div>			

		</div>
	</div>	
	<hr>					
</div>
