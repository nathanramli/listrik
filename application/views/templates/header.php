<!DOCTYPE html>
	<head>
		<title>Home &bull; Pembayaran Listrik</title>

		<!-- jQuery dan popper nya -->
		<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
		<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>

		<!-- Bootstrap js -->
		<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
		<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

		<!-- bootstrap css -->
		<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?= base_url(); ?>assets/css/bootstrap-reboot.min.css" rel="stylesheet" />

		<!-- font-awe css -->
		<link href="<?= base_url(); ?>assets/css/fontawesome/css/all.min.css" rel="stylesheet" />

		<!-- AOS MASTER CSS -->
		<link href="<?= base_url(); ?>assets/css/aos-master/dist/aos.css" rel="stylesheet" />

		<!-- Listrik css buatan -->
		<link href="<?= base_url(); ?>assets/css/listrik.css" rel="stylesheet" />

		<!-- Icon web -->
		<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/logo.png">

		<style>

			body, html{
				height: 100%;
				margin:0;
			}

			.hero-image {
				background-image: linear-gradient(to right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.8)), url('<?= base_url(); ?>assets/img/home6.jpg');
				width: 100%;
				height: 100%;
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
			}

			#username:hover, #password:hover{
				box-shadow: 5px 5px #333333;
			}

			@media screen and (min-width: 320px) and (max-width: 640px){
				#quote{
					display: none;
				}
			}

		</style>

	</head>
	<body>
