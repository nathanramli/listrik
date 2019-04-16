
			</div>
			<!-- akhir halaman utama -->
		</div>

		<!-- Data javascript AOS harus didalam body -->

		<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
		<script src="<?= base_url(); ?>assets/css/aos-master/dist/aos.js"></script>
		<script src="<?= base_url(); ?>assets/js/admin.js"></script>
		<script>
			$(document).ready(function(){
				$('body').bootstrapMaterialDesign();
			});				
			AOS.init();		
		</script>
	</body>
</html>