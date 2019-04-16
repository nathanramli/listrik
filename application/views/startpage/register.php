<!DOCTYPE html>
<head>
	<title>Register &bull; Pembayaran Listrik</title>

	<!-- jQuery dan popper nya -->
	<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>

	<script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

	<!-- Bootstrap js -->
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>

	<script src="<?= base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>

	<!-- bootstrap css -->
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/css/bootstrap-reboot.min.css" rel="stylesheet" />

	<link href="<?= base_url(); ?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet" />

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
		background-image: linear-gradient(rgba(0, 0, 0, 0.1),rgba(0, 0, 0, 0.1)), url('<?= base_url(); ?>assets/img/home5.jpg');
		width: 100%;
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		position: relative;
	}
	#username:hover, #password:hover, #konfirmasipassword:hover{
		box-shadow: 3px 3px white;
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
				<a class="navbar-brand" href="#" style="font-family: 'Chalkboard'; color:white;"><font size="+2">Pembayaran L<i class="fa fa-bolt fa-xs" data-aos="fade-down" style="color: yellow;"></i>strik</font></a>
				<div class="collapse navbar-collapse" id="navbar1">
					<!--ml-auto untuk memindahkan navbar ke arah kiri(margin-left auto)-->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link btn btn-outline-danger" href="<?= base_url(); ?>startpage"><font color="black" size="">Login</font></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">

			<div class="flash-data" data-flashdata="<?= $this->session->flashdata('register'); ?>"></div>

			<center style="padding-top:3%;">
				<form method="post" action="" class="col-md-6" data-aos="zoom-in" style=" background-color: rgba(0, 0, 0, 0.5); border-radius: 3px; color: silver; padding: 20px;" onsubmit="return checkData()">

					<div class="form-group">
						<label style="float: left;" for="nama">
							<font size="-1"> <i class="fa fa-id-card"></i> Nama</font>
						</label>
						<input type="text" class="form-control bg-transparent shadow-none rounded-0 border-left-0 border-right-0 border-top-0" style="color: silver;" id="nama" name="nama" placeholder="Nama" required>
					</div>

					<label style="float: left;" for="username">
						<font size="-1">
							<i class="fa fa-user"></i> Username
						</font>
					</label>

					<div class="input-group">
						<input type="text" class="form-control bg-transparent shadow-none rounded-0 border-left-0 border-right-0 border-top-0" style="color: silver;" id="username" name="username" placeholder="Username" onblur="checkAvailability()" required>
						<div class="input-group-append" >
							<span class="input-group-text bg-transparent border-top-0 border-right-0 border-left-0 rounded-0">
								<i id="status" class=""></i>
							</span>
						</div>
					</div>

					<div class="form-group mt-3">
						<label style="float: left;" for="password">
							<font size="-1">
								<i class="fa fa-key"></i> Password
							</font>
						</label>
						<input type="password" data-toggle="tooltip" title="Isikan password anda" data-placement="right" data-trigger="hover" class="form-control bg-transparent shadow-none rounded-0 border-left-0 border-right-0 border-top-0" style="color: silver;" id="password" name="password" placeholder="Password" onkeyup="return checkPass()" required>
					</div>

					<label style="float: left;" for="konfirmasipassword">
						<font size="-1"> <i class="fa fa-lock"></i> Konfirmasi Password
						</font>
					</label>
					<div class="input-group">
						<input type="password" data-toggle="tooltip" title="Konfirmasi Password Anda" data-placement="right" data-trigger="hover" class="form-control bg-transparent shadow-none rounded-0 border-left-0 border-right-0 border-top-0" style="color: silver;" id="konfirmasipassword" placeholder="Konfirmasi Password" onkeyup="return checkPass()" required>
						<div class="input-group-append" >
							<span class="input-group-text bg-transparent border-top-0 border-right-0 border-left-0 rounded-0">
								<i class="" id="ikon"></i>
							</span>
						</div>				
					</div>

					<div class="form-group mt-3">
						<label style="float: left;" for="alamat">
							<font size="-1"> <i class="fa fa-home"></i> Alamat Rumah (Isi dengan benar)</font>
						</label>
						<input type="text" class="form-control bg-transparent shadow-none rounded-0 border-left-0 border-right-0 border-top-0" style="color: silver;" id="alamat" name="alamat" placeholder="Alamat" required>
					</div>					
					<br>
					<button type="submit" name="submit" class="btn btn-outline-success"><i class="fa fa-user-plus"></i> Register</button>
				</form>
			</center>
		</div>
	</div>
	<!-- Data javascript AOS harus didalam body -->
	<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
	<script src="<?= base_url(); ?>assets/css/aos-master/dist/aos.js"></script>
	<script>
		AOS.init();

		const flashData = $('.flash-data').data('flashdata');

		if( flashData ){
			Swal.fire({
				title: 'Anda ' + flashData + ' mendaftar!',
				text:  'Silahkan tunggu hingga akun anda terverifikasi. Terimakasih',
				type: 'success'
			});	
		}

		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});

		function checkAvailability(){
			$("#status").addClass("fa fa-spinner fa-spin");
			jQuery.ajax({
				url: "http://localhost/listrik/startpage/check_availability", 
				data: 'username='+$("#username").val(),
				type: "POST",
				success: function(data){
					if(data){
						$("#status").removeClass("fa fa-spinner fa-spin");
						$("#status").addClass("fa fa-check text-success");
					}else{
						$("#status").removeClass("fa fa-spinner fa-spin");
						$("#status").addClass("fa fa-times text-danger");						
					}
				}
			});
		}

		function checkPass(){
			var pass1 = document.getElementById('password').value;
			var pass2 = document.getElementById('konfirmasipassword').value;

			if(pass1 && pass2){
				if(pass1 === pass2){
					document.getElementById('ikon').classList.remove('fa', 'fa-times');
					document.getElementById('ikon').classList.add('fa', 'fa-check');
					document.getElementById('ikon').style.color = "green";
				}else{
					document.getElementById('ikon').classList.remove('fa', 'fa-check');
					document.getElementById('ikon').classList.add('fa', 'fa-times');
					document.getElementById('ikon').style.color = "red";
				}
			}else{
				document.getElementById('ikon').classList.remove('fa', 'fa-check');
				document.getElementById('ikon').classList.remove('fa', 'fa-times');
			}
		}

		function checkData(){
			if(document.getElementById('ikon').classList.contains("fa-check") ){
				return true;
			}else{
				alert('Masukan data dengan benar (konfirmasi password/username availability) !');
				return false;
			}
		}
	</script>
</body>
</html>