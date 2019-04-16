<!-- isi halaman utama setelah navbar -->
<div class="col">
	<div class="row mt-3">
		<div class="col-11">
			<hr>
			<h5 style="font-family: Courier;">Grafik Keuntungan hasil Pembayaran</h5>
			<hr>
			<canvas id="canvas"></canvas>
		</div>
	</div>			

	<script>
		var lineChartData = {
			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
			datasets: [{
				label: 'Keuntungan Biaya Admin',
				borderColor: 'rgb(255, 155, 0)',
				backgroundColor: 'rgb(255, 155, 0)',
				fill: true,
				data: [
					<?= $jumlahL1; ?>,
					<?= $jumlahL2; ?>,
					<?= $jumlahL3; ?>,
					<?= $jumlahL4; ?>,
					<?= $jumlahL5; ?>,
					<?= $jumlahL6; ?>
				],
				yAxisID: 'y-axis-1',
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
						text: 'Data Keuntungan 2019 (berdasarkan biaya admin)'
					},
					scales: {
						yAxes: [{
							type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
							display: true,
							position: 'left',
							id: 'y-axis-1',
						}],
					}
				}
			});
		};				
	</script>
</div>