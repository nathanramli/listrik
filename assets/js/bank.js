$(document).ready(function(){
	$('#sidebarCollapse').on('click', function(){
		$('#sidebar').toggleClass('active');
		$('#tombol').toggleClass('fa-arrow-right');
	});
});			

$(document).ready(function(){
	$('#tabel-prosesTransaksi').DataTable({
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
			"emptyTable" : "Tidak ada data Pembayaran",
			"search": "Cari :"
		},
		"columnDefs": [{
			"targets" : 7,
			"searchable": false,
			"orderable": false
		}]
	});
});	


$(document).ready(function(){
	$('#tabel-riwayatPembayaran').DataTable({
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
			"emptyTable" : "Tidak ada data Pembayaran",
			"search": "Cari :"
		},
		"columnDefs": [{
			"targets" : 7,
			"searchable": false,
			"orderable": false
		},
		{
			"targets" : 5,
			"searchable": false,
			"orderable": false
		}]
	});
});	

const flashData = $('.flash-data').data('flashdata');
if( flashData ){
	Swal.fire({
		title: 'Berhasil ' + flashData + ' Pembayaran',
//		text: 'Berhasil ' + flashData + ' !',
		type: 'success'
	});	
}

$('.tombol-tolak').on('click', function(e){
	e.preventDefault();

	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Pembayaran ini akan ditotak',
	  text: "Apakah anda yakin?",
	  type: 'error',
	  showCancelButton: true,
	  cancelButtonColor: '#d33',
	  confirmButtonText: '<i class="fa fa-trash-alt"></i> Tolak'
	}).then((result) => {
	  if (result.value) {
	  	document.location.href = href;
	  }
	})
});

$('.tombol-verifikasi-pembayaran').on('click', function(e){
	e.preventDefault();

	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Data ini akan diverifikasi',
	  text: "Apakah anda yakin?",
	  type: 'success',
	  showCancelButton: true,
	  confirmButtonColor: 'green',
	  cancelButtonColor: '#d33',
	  confirmButtonText: '<i class="fa fa-check"></i> Verifikasi!'
	}).then((result) => {
	  if (result.value) {
	  	document.location.href = href;
	  }
	})
});

$('.detailBayarUpdate').on('click', function(){
	var id = $(this).data('id');
	$.ajax({
		url: "http://localhost/listrik/bank/getdetailpembayaran", 
		data: {id : id},
		method: 'post',
		dataType: 'json',
		success: function(data){
			$('#did_pembayaran').html(data[0].id_pembayaran);
			$('#did_tagihan').html(data[0].id_tagihan);
			$('#dtanggal_pembayaran').html(data[0].tanggal_pembayaran);
			$('#dbulan_bayar').html(data[0].bulan_bayar);
			$('#dtotal_bayar').html('Rp. ' + data[0].total_bayar);
			$('#did_pelanggan').html(data[0].id_pelanggan);
			$('#dnama_pelanggan').html(data[0].nama_pelanggan);
			$('#id_targetpembayaran').attr("href", "http://localhost/listrik/bank/printpembayaran/" + data[0].id_pembayaran);
		}
	});
});	