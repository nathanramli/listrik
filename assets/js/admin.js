const flashData = $('.flash-data').data('flashdata');
const namaData = $('.flash-data').data('tempat');

if( flashData ){
	Swal.fire({
		title: 'Data ' + namaData,
		text: 'Berhasil ' + flashData + ' !',
		type: 'success'
	});	
}


$('.tombol-hapus').on('click', function(e){
	e.preventDefault();

	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Apakah anda yakin?',
	  text: "Data ini akan dihapus!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Ya, Hapus data!',
	  animation: false,
	  customClass: {
	  	popup: 'animated tada'
	  }
	}).then((result) => {
	  if (result.value) {
	  	document.location.href = href;
	  }
	})
});

// Bagian data table

$(document).ready(function(){
	$('#tabel-tagihan').DataTable({
		"lengthChange": false,
		"pageLength": 6,
		"language":{
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
			"infoFiltered" : "(Diseleksi dari _MAX_ data)",
			"info" : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty" : "Tidak ada data",
			"zeroRecords" : "Tidak ada data yang cocok",
			"emptyTable" : "Tidak ada data didalam tabel",
			"search": "Cari :"
		}
	});
});




$(document).ready(function(){
	$('#tabel-pelanggan').DataTable({
		"lengthChange": false,
		"pageLength": 6,
		"order": [[ 6, "desc"]],
		"language":{
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
			"infoFiltered" : "(Diseleksi dari _MAX_ data)",
			"info" : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty" : "Tidak ada data",
			"zeroRecords" : "Tidak ada data yang cocok",
			"emptyTable" : "Tidak ada data didalam tabel",
			"search": "Cari :"
		}
	});
});

$(document).ready(function(){
	$('#tabel-laporan').DataTable({
		"lengthChange": false,
		"pageLength": 6,
		"language":{
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
			"infoFiltered" : "(Diseleksi dari _MAX_ data)",
			"info" : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty" : "Tidak ada data",
			"zeroRecords" : "Tidak ada data yang cocok",
			"emptyTable" : "Tidak ada data didalam tabel",
			"search": "Cari :"
		}
	});
});

$(document).ready(function(){
	$('#tabel-tarif').DataTable({
		"lengthChange": false,
		"pageLength": 6,
		"language":{
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
			"infoFiltered" : "(Diseleksi dari _MAX_ data)",
			"info" : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty" : "Tidak ada data",
			"zeroRecords" : "Tidak ada data yang cocok",
			"emptyTable" : "Tidak ada data didalam tabel",
			"search": "Cari :"
		},
		"columnDefs": [{
			"targets" : 3,
			"searchable": false,
			"orderable": false
		}]
	});
});		

$(document).ready(function(){
	$('#tabel-admin').DataTable({
		"lengthChange": false,
		"pageLength": 6,
		"language":{
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
			"infoFiltered" : "(Diseleksi dari _MAX_ data)",
			"info" : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty" : "Tidak ada data",
			"zeroRecords" : "Tidak ada data yang cocok",
			"emptyTable" : "Tidak ada data didalam tabel",
			"search": "Cari :"
		},
		"columnDefs": [{
			"targets" : 5,
			"searchable": false,
			"orderable": false
		}]
	});
});				

$(document).ready(function(){
	$('#tabel-penggunaan').DataTable({
		"lengthChange": false,
		"pageLength": 6,
		"language":{
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
			"infoFiltered" : "(Diseleksi dari _MAX_ data)",
			"info" : "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty" : "Tidak ada data",
			"zeroRecords" : "Tidak ada data yang cocok",
			"emptyTable" : "Tidak ada data didalam tabel",
			"search": "Cari :"
		},
		"columnDefs": [{
			"targets" : 6,
			"searchable": false,
			"orderable": false
		}]
	});
});

// Ajax query

$('.editUpdatePenggunaan').on('click', function(){
	var id = $(this).data('id');

	$.ajax({
		url: "http://localhost/listrik/admin/checkdatapenggunaan", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){
			$('#edid_penggunaan').val(data[0].id_penggunaan);
			$('#selectUser').val(data[0].id_pelanggan);
			$('#edbulan').val(data[0].bulan);
			$('#edtahun').val(data[0].tahun);
			$('#edmeterawal').val(data[0].meter_awal);
			$('#edmeterakhir').val(data[0].meter_akhir);
		}
	});
});

$('.editUpdateAdmin').on('click', function(){
	var id = $(this).data('id');

	$.ajax({
		url: "http://localhost/listrik/admin/checkdataadmin", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){
			$('#edid_admin').val(data[0].id_admin);
			$('#edselectUser').val(data[0].id_level);
			$('#edusername').val(data[0].username);
			$('#edpassword').val(null);
			$('#ednamaadmin').val(data[0].nama_admin);
		}
	});
});

$('.tambahPenggunaan').on('click', function(){ 
	$(".updateBulan").trigger("change"); 
});


$('.updateBulan').on('change', function(){
	var id = $(this).children("option:selected").val();

	var d = new Date(),
		n = d.getMonth()+1,
		y = d.getFullYear();

	var banding1 = ''+ y + '' + n;

	$.ajax({
		url: "http://localhost/listrik/admin/checkdatapenggunaanbypelanggan", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){
			if( data[0] ){
				var banding2 = ''+ data[0].tahun + '' + data[0].bulan;

				var banding1int = parseInt(banding1);
				var banding2int = parseInt(banding2);

				if( banding1int > banding2int){
					$('#meterawal').val(data[0].meter_akhir);					
					$('#meterakhir').val(data[0].meter_akhir);					
					$('#tahun').val(y);
					$('#bulan').val(n);					
					$('#meterakhir').removeAttr("readonly");					
					$('#kataDanger').html('');
					$('.tombolTambahPenggunaan').removeAttr('disabled');
				} 
				else{
					$('#tahun').val(data[0].tahun);
					$('#bulan').val(data[0].bulan);					
					$('#meterawal').val(data[0].meter_awal);					
					$('#meterakhir').val(data[0].meter_akhir);					
					$('#meterakhir').attr("readonly", true);					
					$('#kataDanger').html('* Penggunaan pada bulan ini sudah diinput');
					$('.tombolTambahPenggunaan').attr('disabled', true);
				}
			}else{
				$('#tahun').val(y);
				$('#bulan').val(n);
				$('#meterawal').val(0);					
				$('#meterakhir').val(1);					
				$('#meterakhir').removeAttr("readonly");					
				$('#kataDanger').html('');
				$('.tombolTambahPenggunaan').removeAttr('disabled');
			}
		}
	});
});			


$('.editUpdateTarif').on('click', function(){
	var id = $(this).data('id');

	$.ajax({
		url: "http://localhost/listrik/admin/checktarif", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){
			$('#edid_tarif').val(data[0].id_tarif);
			$('#eddaya').val(data[0].daya);
			$('#edtarifperkwh').val(data[0].tarifperkwh);
		}
	});
});			

// Front end

$(document).ready(function(){
	$('#sidebarCollapse').on('click', function(){
		$('#sidebar').toggleClass('active');
		$('#tombol').toggleClass('fa-arrow-right');
	});
});			

function gantiID(x){
	document.getElementById('id_pelanggan').value = x;
}