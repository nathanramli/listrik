$(document).ready(function(){
	$('#sidebarCollapse').on('click', function(){
		$('#sidebar').toggleClass('active');
		$('#tombol').toggleClass('fa-arrow-right');
	});
});			

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
			"emptyTable" : "Tidak ada tagihan",
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
	$('#tabel-pembayaran').DataTable({
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
			"emptyTable" : "Tidak ada tagihan",
			"search": "Cari :"
		},
		"columnDefs": [{
			"targets" : 6,
			"searchable": false,
			"orderable": false
		},
		{
			"targets" : 8,
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
		}//,
		// "columnDefs": [{
		// 	"targets" : 3,
		// 	"searchable": false,
		// 	"orderable": false
		// }]
	});
});	


// JQUERY AJAX

$('.bayarUpdate').on('click', function(){
	var id = $(this).data('id');
	$.ajax({
		url: "http://localhost/listrik/user/getbayar", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){
			var harga1 = parseInt(data[0].tarifperkwh);
			var harga2 = parseInt(data[0].jumlah_meter);
			var total = harga1*harga2+2000;
			$('#jumlahmeteran').val(data[0].jumlah_meter);
			$('#bulan').val(data[0].bulan);
			$('#tahun').val(data[0].tahun);
			$('#tarif').val(data[0].tarifperkwh);
			$('#totalbayar').val(total);
			$('#id_tagihan').val(data[0].id_tagihan);
			$('#info').html('<b>* Rp.' + data[0].tarifperkwh + ' x ' + data[0].jumlah_meter + ' kWh + 2000 = Rp.' + total + '</b>');
		}
	});
});		

$('.detailBayarUpdate').on('click', function(){
	var id = $(this).data('id');
	$.ajax({
		url: "http://localhost/listrik/user/getdetailpembayaran", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){

			$('#did_pembayaran').html(data[0].id_pembayaran);
			$('#did_tagihan').html(data[0].id_tagihan);
			$('#dtanggal_pembayaran').html(data[0].tanggal_pembayaran);
			$('#dbulan_bayar').html(data[0].bulan_bayar);
			$('#dtotal_bayar').html('Rp. ' + data[0].total_bayar);
			$('#did_bank').html(data[0].id_bank);
			$('#dnama_bank').html(data[0].nama_bank);
			$('#dstatus').html(data[0].status);
			$('#id_targetpembayaran').attr("href", "http://localhost/listrik/user/printpembayaran/" + data[0].id_pembayaran);
		}
	});
});		

$('.detailUpdate').on('click', function(){
	var id = $(this).data('id');
	$.ajax({
		url: "http://localhost/listrik/user/getdetailbayar", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){			
			$('#did_pembayaran').html(data[0].id_pembayaran);
			$('#did_tagihan').html(data[0].id_tagihan);
			$('#dtanggal_pembayaran').html(data[0].tanggal_pembayaran);
			$('#dbulan_bayar').html(data[0].bulan_bayar);
			$('#dtotal_bayar').html('Rp. ' + data[0].total_bayar);
			$('#did_bank').html(data[0].id_bank);
			$('#dnama_bank').html(data[0].nama_bank);
			$('#dstatus').html(data[0].status);
		}
	});
});		

// SweetAlert

const flashData = $('.flash-data').data('flashdata');
const namaData = $('.flash-data').data('tempat');

if( flashData ){
	Swal.fire({
		title: 'Berhasil melakukan ' + namaData,
		text: 'Tunggu hingga ' + namaData + ' di Verifikasi oleh Bank !',
		type: 'success'
	});	
}