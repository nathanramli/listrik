<!doctype html>
<html lang="en">
	<head>
		<meta charset=utf-8>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Dashboard &bull; Pembayaran Listrik</title>


		<!-- jQuery dan popper nya -->
		<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
		<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>

		<script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>		

		<!-- Bootstrap js -->
		<script src="<?= base_url(); ?>assets/js/bootstrap-material-design.js"></script>

		<script src="<?= base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>

		<script src="<?= base_url(); ?>assets/js/Chart.min.js"></script>

		<!-- bootstrap css -->
		<link href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" />

		<link href="<?= base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />		

		<!-- font-awe css -->
		<link href="<?= base_url(); ?>assets/css/fontawesome/css/all.min.css" rel="stylesheet" />

		<!-- AOS MASTER CSS -->
		<link href="<?= base_url(); ?>assets/css/aos-master/dist/aos.css" rel="stylesheet" />

		<link href="<?= base_url(); ?>assets/css/Animate.css" rel="stylesheet" />

		<!-- Listrik css buatan -->
		<link href="<?= base_url(); ?>assets/css/listrik.css" rel="stylesheet" />

		<!-- Icon web -->
		<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/logo.png">
	

		<style>
		body{
			background: #fafafa;
		}

		a, a:hover, a:focus{
			color: inherit;
			text-decoration: none;
			transition: all 0.3s;
		}

		.badge-notify{
		   background: red;
		   position: relative;
		   top: -15px;
		   left: -20px;
		   font-size: 10px;
		}		
		</style>

	</head>
	<body>


		<div class="wrapper">
			<nav id="sidebar">
				<div class="sidebar-header mt-3"><h3 style="font-family: casual;" class="animated swing">Pembayaran Listr<i style="color: orange; font-size: 80%;" data-aos="fade-down" class="fa fa-bolt"></i>k</h3>
				</div>

				<ul class="list-unstyled components mt-5">
					<li>
						<a href="<?= base_url(); ?>user"><i class="fa fa-home" style="color: red;"></i> Home</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>user/penggunaan"><i class="fa fa-clock" style="color: darkblue;"></i> Riwayat Penggunaan</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>user/pembayaran"><i class="fa fa-money-check-alt" style="color: green;"></i> Riwayat Pembayaran</a>
					</li>
					<li>
						<a href="<?= base_url(); ?>user/tagihan">
							<i class="fa fa-file-invoice-dollar" style="color: orange;"></i> 
							<span class="badge badge-notify text-white"><?= $jumlahtunggakan; ?></span>
							<font>Tagihan</font>
						</a>
					</li>
				</ul>
			</nav>

			<!-- letak halaman utama -->
			<div class="col">

				<nav class="navbar navbar-expand-lg bg-warning">
					<button id="sidebarCollapse" type="button" class="btn btn-info">
						<i id="tombol" class="fa fa-arrow-left"></i>
					</button>
					<div class="navbar-nav ml-auto">
						<div class="dropdown">
							<button class="btn bg-transparent" data-toggle="dropdown"><i class="far fa-user"></i> <?= $this->session->userdata('nama'); ?></button>
							<div class="dropdown-menu bg-warning dropdown-menu-right">
								<a class="dropdown-item" href="<?= base_url(); ?>user/logout"><i class="fa fa-sign-out-alt"></i>&nbsp;Logout</a>
							</div>

						</div>
					</div>
				</nav>				