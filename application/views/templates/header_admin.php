<!DOCTYPE html>
	<head>
		<title>Dashboard &bull; Admin Control</title>

		<!-- jQuery dan popper nya -->
		<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
		<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>

		<script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>		

		<!-- Bootstrap js -->
		<script src="<?= base_url(); ?>assets/js/bootstrap-material-design.js"></script>
		<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

		<script src="<?= base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>

		<script src="<?= base_url(); ?>assets/js/Chart.min.js"></script>

		<!-- bootstrap css -->
		<link href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" />

		<link href="<?= base_url(); ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />		

		<!-- font-awe css -->
		<link href="<?= base_url(); ?>assets/css/fontawesome/css/all.min.css" rel="stylesheet" />

		<!-- AOS MASTER CSS -->
		<link href="<?= base_url(); ?>assets/css/aos-master/dist/aos.css" rel="stylesheet" />

		<!-- Animate CSS -->
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
				<div class="sidebar-header mt-3" style="font-family: 'Casual';"><h3 class="animated swing">Pembayaran Listr<i style="color: orange; font-size: 80%;" data-aos="fade-down" class="fa fa-bolt"></i>k</h3>
				</div>

				<ul class="list-unstyled components mt-5">
					
					<li>
						<a href="<?= base_url(); ?>admin"><i class="fa fa-chart-line" style="color: red;"></i> Home</a>
					</li>

					<?php if($this->session->userdata('level') == "1"): ?>
					<li>
						<a href="<?= base_url(); ?>admin/dataadmin"><i class="far fa-address-card" style="color: orange;"></i> Data Admin</a>
					</li>
					<?php endif; ?>

					<?php if($this->session->userdata('level') != "2"): ?>
					<li>
						<a href="<?= base_url(); ?>admin/datapenggunaan"><i class="fa fa-dolly-flatbed" style="color: yellow;"></i> Data Penggunaan</a>
					</li>
					<?php endif; ?>

					<?php if($this->session->userdata('level') != "3"): ?>
					<li>
						<a href="<?= base_url(); ?>admin/datapelanggan">
							<i class="fa fa-users" style="color: green;"></i> 
							<span class="badge badge-notify"><?= $jumlahuserpending; ?></span>
							<font style="position: relative; ">Data Pelanggan</font>
						</a>
					</li>
					<?php endif; ?>

					<?php if($this->session->userdata('level') != "2"): ?>
					<li>
						<a href="<?= base_url(); ?>admin/datatagihan">
							<i class="fa fa-coins" style="color: blue;"></i>							
							<span class="badge badge-notify"></span>
							<font style="position: relative;">Data Tagihan</font>
						</a>
					</li>
					<?php endif; ?>

					<li>
						<a href="<?= base_url(); ?>admin/laporan">
							<i class="far fa-file-alt" style="color: maroon;"></i>
							Laporan
						</a>
					</li>

					<?php if($this->session->userdata('level') != "2"): ?>
					<li>
						<a href="<?= base_url(); ?>admin/tarif">
							<i class="fab fa-bitcoin" style="color: purple;"></i>
							<span class="badge badge-notify"></span>
							Tarif
						</a>
					</li>
					<?php endif; ?>

				</ul>
			</nav>

			<!-- letak halaman utama -->
			<div class="col">

				<nav class="navbar navbar-expand-lg bg-warning">
					<button id="sidebarCollapse" type="button" class="btn btn-outline-primary">
						<i id="tombol" class="fa fa-arrow-left"></i>
					</button>
					<div class="navbar-nav ml-auto">
						<div class="dropdown">
							<button class="btn bg-transparent" data-toggle="dropdown"><i class="far fa-user"></i> <?= $this->session->userdata('nama'); ?></button>
							<div class="dropdown-menu dropdown-menu-right bg-warning">
								<a class="dropdown-item" href="<?= base_url(); ?>admin/logout"><i class="fa fa-sign-out-alt"></i>&nbsp;Logout</a>
							</div>

						</div>
					</div>
				</nav>		