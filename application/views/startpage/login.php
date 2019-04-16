<!DOCTYPE html>
<head>
	<title>Login &bull; Pembayaran Listrik</title>

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

	<link href="<?= base_url(); ?>assets/css/Animate.css" rel="stylesheet" />

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
	<div class="hero-image">
		<nav class="navbar navbar-expand-md navbar-light">
			<div class="container">
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand" href="#" style="font-family: 'Chalkboard';"><font size="+2">Pembayaran L<i class="fa fa-bolt fa-xs" data-aos="fade-down" style="color: orange;"></i>strik</font></a>
				<div class="collapse navbar-collapse" id="navbar1">
					<!--ml-auto untuk memindahkan navbar ke arah kiri(margin-left auto)-->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link btn btn-outline-warning" href="<?= base_url(); ?>startpage/register"><font size="+1">Register</font></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">

			<?php if( $this->session->flashdata('gagal') ): ?>

				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<b style="font-size: 13px;">Username atau password salah, silahkan coba lagi.</b>
				</div>

			<?php elseif( $this->session->flashdata('pending') ): ?>

				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<b style="font-size: 13px;">Akun anda masih dalam masa pending, silahkan coba lagi lain waktu.</b>
				</div>

			<?php endif; ?>

			<div data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="700" class="col-md-6 float-right" style="text-align: right; padding-top: 10%;">
				<font color="white" id="quote" style="font-size: 40px; font-weight: bold; text-shadow: 5px 5px 10px black;">Kami berusaha memberikan layanan terbaik bagi anda!</font>
			</div>
			<form method="post" action="" class="col-md-5" style="padding-top: 10%;">
				<div class="form-group">
					<label for="username">
					<font size="+1"><i class="fa fa-user"></i> Username</font>
					</label>
					<input type="text" name="username" class="form-control bg-transparent" style="border-color: black;" id="username" placeholder="Username" required>
				</div>
				<div class="form-group">
					<label for="password"><font size="+1"><i class="fa fa-key"></i> Password</font></label>
					<input type="password" name="password" class="form-control bg-transparent" style="border-color: black;" id="password" placeholder="Password" required>
				</div><br>
				<button type="submit" name="submit" class="btn btn-outline-dark"><i class="fa fa-sign-in-alt"></i> Login</button>
			</form>
		</div>
	</div>
	<!-- Data javascript AOS harus didalam body -->
	<script src="<?= base_url(); ?>assets/css/aos-master/dist/aos.js"></script>
	<script>
		AOS.init();

	</script>
</body>
</html>