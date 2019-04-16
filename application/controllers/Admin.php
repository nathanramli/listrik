<?php

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Penggunaan');
		$this->load->model('Akun');
		$this->load->model('Tarif');
		$this->load->model('Tagihan');
		$this->load->model('Data_admin');
		$this->load->model('FungsiTambahan');
		$this->load->model('Pembayaran');

		$this->load->library('pdf');

		if($this->session->has_userdata('idakun')){
			if($this->session->has_userdata('pangkat')){
				if($this->session->userdata('pangkat') === "pelanggan")
					redirect('user');
				elseif($this->session->userdata('pangkat') === "bank")
					redirect('bank');
			}else
				redirect('startpage');
		}else
			redirect('startpage');

	}


	public function index(){
		$data['jumlahtagihan'] = $this->Tagihan->jumlahTagihan("tunggakan");
		$data['jumlahpelanggan'] = $this->Akun->jumlahSemuaPelanggan();
		$data['jumlahadmin'] = $this->Data_admin->jumlahSemuaAdmin();
		$data['jumlahlunas'] = $this->Tagihan->jumlahTagihan("lunas");

		$data['jumlah1'] = $this->Penggunaan->jumlahPenggunaanByBulan(1);
		$data['jumlah2'] = $this->Penggunaan->jumlahPenggunaanByBulan(2);
		$data['jumlah3'] = $this->Penggunaan->jumlahPenggunaanByBulan(3);
		$data['jumlah4'] = $this->Penggunaan->jumlahPenggunaanByBulan(4);
		$data['jumlah5'] = $this->Penggunaan->jumlahPenggunaanByBulan(5);
		$data['jumlah6'] = $this->Penggunaan->jumlahPenggunaanByBulan(6);

		$data['jumlahL1'] = $this->Tagihan->jumlahTagihan("lunas bulan",1);
		$data['jumlahL2'] = $this->Tagihan->jumlahTagihan("lunas bulan",2);
		$data['jumlahL3'] = $this->Tagihan->jumlahTagihan("lunas bulan",3);
		$data['jumlahL4'] = $this->Tagihan->jumlahTagihan("lunas bulan",4);
		$data['jumlahL5'] = $this->Tagihan->jumlahTagihan("lunas bulan",5);
		$data['jumlahL6'] = $this->Tagihan->jumlahTagihan("lunas bulan",6);

		if($this->Akun->jumlahSemuaPelanggan("pending"))
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;

		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('templates/footer_admin');

	}

	/********************************************************
						BAGIAN TAGIHAN
	********************************************************/	
	
	public function datatagihan(){
		$data['tagihan'] = $this->Tagihan->getAllTagihan();

		if($this->Akun->jumlahSemuaPelanggan("pending"))
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;


		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/datatagihan', $data);
		$this->load->view('templates/footer_admin');
	}

	/********************************************************
						BAGIAN DATA ADMIN
	********************************************************/

	public function dataadmin(){
		$data['dataadmin'] = $this->Data_admin->getAllAdmin();

		if($this->Akun->jumlahSemuaPelanggan("pending")) 
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;

		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/dataadmin',$data);
		$this->load->view('templates/footer_admin');
	}

	public function tambahadmin(){
		$idlevel = htmlspecialchars($this->input->post('id_level'));
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$namaadmin = htmlspecialchars($this->input->post('namaadmin'));

		$password = md5(GARAM.$password);	

		$idadmin = $this->FungsiTambahan->cariIdkosong("admin");

		$this->Data_admin->tambahAdmin($idadmin, $username, $password, $namaadmin, $idlevel);

		$this->session->set_flashdata('aksiAdmin', "Ditambah");
		redirect('admin/dataadmin');
	}

	public function editadmin(){
		$idadmin = htmlspecialchars($this->input->post('id_admin'));
		$idlevel = htmlspecialchars($this->input->post('id_level'));
		$username = htmlspecialchars($this->input->post('username'));
		$password = htmlspecialchars($this->input->post('password'));
		$namaadmin = htmlspecialchars($this->input->post('namaadmin'));

		$password = md5(GARAM.$password);	

		$this->Data_admin->editAdminByID($idadmin, $username, $password, $namaadmin, $idlevel);

		$this->session->set_flashdata('aksiAdmin', "Diedit");

		redirect('admin/dataadmin');
	}		

	public function hapusadmin($id){
		$this->Data_admin->hapusAdminById($id);
		$this->session->set_flashdata('aksiAdmin', "Dihapus");

		redirect('admin/dataadmin');
	}


	public function checkdataadmin(){
		echo json_encode($this->Data_admin->getAdminByID($this->input->post('id')));
	}


	/********************************************************
						BAGIAN PELANGGAN
	********************************************************/

	public function datapelanggan(){
		$data['pelanggan'] = $this->Akun->getAllUser();
		$data['tarif'] = $this->Tarif->getAllTarif();

		if($this->Akun->jumlahSemuaPelanggan("pending"))
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;


		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/datapelanggan', $data);
		$this->load->view('templates/footer_admin');
	}

	public function verifikasiuser(){
		$id_pelanggan = htmlspecialchars($this->input->post('id_pelanggan'));
		$id_tarif = htmlspecialchars($this->input->post('id_tarif'));
		$this->Akun->verifikasipelanggan($id_pelanggan, $id_tarif);
		$this->session->set_flashdata('berhasilVerifikasi', "Diverifikasi");
		redirect('admin/datapelanggan');
	}	


	/********************************************************
							BAGIAN PENGGUNAAN
	********************************************************/

	public function datapenggunaan(){

		$data['penggunaan'] = $this->Penggunaan->getAllPenggunaan();
		$data['pelanggan'] = $this->Akun->getAllUser("verified");

		if($this->Akun->jumlahSemuaPelanggan("pending"))
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;


		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/datapenggunaan', $data);
		$this->load->view('templates/footer_admin');

	}	

	public function tambahdatapenggunaan(){
		// Data penggunaan
		$id = htmlspecialchars($this->input->post('id_pelanggan'));
		$bulan = htmlspecialchars($this->input->post('bulan'));
		$tahun = htmlspecialchars($this->input->post('tahun'));
		$meterawal = htmlspecialchars($this->input->post('meterawal'));
		$meterakhir = htmlspecialchars($this->input->post('meterakhir'));

		$id_penggunaan = $this->Penggunaan->tambahDataPenggunaan($id, $bulan, $tahun, $meterawal, $meterakhir, true);

		$jumlah_meter = $meterakhir-$meterawal;

		$this->Tagihan->tambahTagihan( $id_penggunaan, $id, $bulan, $tahun, $jumlah_meter);

		$this->session->set_flashdata('aksiPenggunaan', "Ditambah");
		redirect('admin/datapenggunaan');
	}

	public function editdatapenggunaan(){
		$idpenggunaan = htmlspecialchars($this->input->post('id_penggunaan'));
		$idpelanggan = htmlspecialchars($this->input->post('id_pelanggan'));
		$bulan = htmlspecialchars($this->input->post('bulan'));
		$tahun = htmlspecialchars($this->input->post('tahun'));
		$meterawal = htmlspecialchars($this->input->post('meterawal'));
		$meterakhir = htmlspecialchars($this->input->post('meterakhir'));

		$this->Penggunaan->editPenggunaanById( $idpenggunaan, $idpelanggan, $bulan, $tahun, $meterawal, $meterakhir );

		$jumlah_meter = $meterakhir - $meterawal;

		$this->Tagihan->editTagihan( $idpenggunaan, $idpelanggan, $bulan, $tahun, $jumlah_meter );

		$this->session->set_flashdata('aksiPenggunaan', "Diedit");
		redirect('admin/datapenggunaan');
	}

	public function hapuspenggunaan($id){
		$this->Penggunaan->hapusPenggunaanById($id);
		$this->session->set_flashdata('aksiPenggunaan', "Dihapus");
		redirect('admin/datapenggunaan');
	}

	public function checkdatapenggunaan(){
		echo json_encode($this->Penggunaan->getPenggunaanByID($this->input->post('id')));
	}	

	public function checkdatapenggunaanbypelanggan(){
		echo json_encode($this->Penggunaan->getPenggunaanByIdPelangganAscBulan($this->input->post('id')));
	}	

	/********************************************************
							BAGIAN TARIF
	********************************************************/

	public function tarif(){
		$data['tarif'] = $this->Tarif->getAllTarif();

		if($this->Akun->jumlahSemuaPelanggan("pending"))
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;

		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/tarif', $data);
		$this->load->view('templates/footer_admin');
	}	

	public function tambahtarif(){
		$daya = htmlspecialchars($this->input->post('daya'));
		$tarifperkwh = htmlspecialchars($this->input->post('tarifperkwh'));

		$idtarif = $this->FungsiTambahan->cariIdKosong("tarif");

		$this->Tarif->tambahTarif($idtarif, $daya, $tarifperkwh);
		$this->session->set_flashdata('aksiTarif', "Ditambah");

		redirect('admin/tarif');
	}


	public function edittarif(){
		$id_tarif = htmlspecialchars($this->input->post('id_tarif'));
		$daya = htmlspecialchars($this->input->post('daya'));
		$tarifperkwh = htmlspecialchars($this->input->post('tarifperkwh'));

		$this->Tarif->editTarifByID($id_tarif, $daya, $tarifperkwh);

		$this->session->set_flashdata('aksiTarif', "Diedit");

		redirect('admin/tarif');
	}	

	public function hapustarif($id){
		$this->Tarif->hapusTarifById($id);
		$this->session->set_flashdata('aksiTarif', "Dihapus");
		redirect('admin/tarif');
	}

	public function checktarif(){
		echo json_encode($this->Tarif->getTarifByID($this->input->post('id')));
	}


	/********************************************************
							LAPORAN
	********************************************************/


	public function laporan(){
		$data['laporan'] = $this->Pembayaran->getAllPembayaranGroup();

		if($this->Akun->jumlahSemuaPelanggan("pending"))
			$data['jumlahuserpending'] = $this->Akun->jumlahSemuaPelanggan("pending");
		else
			$data['jumlahuserpending'] = null;

		$this->load->view('templates/header_admin', $data);
		$this->load->view('admin/laporan', $data);
		$this->load->view('templates/footer_admin');		
	}

	public function printlaporan($bulan){
		$hasil = str_replace('__', '/', $bulan);
		$pembayaran = $this->Pembayaran->getPembayaranByBulan($hasil);


        $pdf = new FPDF();

        // membuat halaman baru
        $pdf->AddPage();
        $pdf->SetTitle("Laporan Pembayaran");

	    $pdf->SetFont('Arial','B',15);
	    // Move to the right
	    $pdf->Cell(80);
	    // Title
	    $pdf->Cell(30,10,'Laporan Pembayaran ('.$hasil.')',0,0,'C');
	    // Line break
	    $pdf->Ln(20);

		$pdf->SetFont('Arial','',8);

	    // Colors, line width and bold font
	    $pdf->SetFillColor(255,0,0);
	    $pdf->SetTextColor(255);
	    $pdf->SetDrawColor(128,0,0);
	    $pdf->SetLineWidth(.3);
	    $pdf->SetFont('','B');

	    // Header
        $pdf->Cell(18,7,'ID Bayar',1,0,'C',true);
        $pdf->Cell(18,7,'ID Tghn',1,0,'C',true);
        $pdf->Cell(20,7,'ID Plgn',1,0,'C',true);
        $pdf->Cell(35,7,'Nama Plgn',1,0,'C',true);
        $pdf->Cell(25,7,'Nama Bank',1,0,'C',true);
        $pdf->Cell(32,7,'Tgl Bayar',1,0,'C',true);
        $pdf->Cell(18,7,'B. Admin',1,0,'C',true);
        $pdf->Cell(25,7,'Total Bayar',1,0,'C',true);
	    $pdf->Ln();

	    // Color and font restoration
	    $pdf->SetFillColor(224,235,255);
	    $pdf->SetTextColor(0);
	    $pdf->SetFont('');

	    $totalall = 0;
	    // Data
	    foreach($pembayaran as $row)
	    {
	        $pdf->Cell(18,6,$row['id_pembayaran'],'LR');
	        $pdf->Cell(18,6,$row['id_tagihan'],'LR');
	        $pdf->Cell(20,6,$row['id_pelanggan'],'LR');
	        $pdf->Cell(35,6,$row['nama_pelanggan'],'LR');
	        $pdf->Cell(25,6,$row['nama_bank'],'LR');
	        $pdf->Cell(32,6,$row['tanggal_pembayaran'],'LR');
	        $pdf->Cell(18,6,'Rp. '.$row['biaya_admin'],'LR');
	        $pdf->Cell(25,6,'Rp. '.$row['total_bayar'],'LR');
	        $totalall += $row['total_bayar'];
	        $pdf->Ln();
	    }

	    $pdf->SetFont('','B');
        $pdf->Cell(191,8,'Total Pembayaran : Rp.'.$totalall.' ',1,0, 'R');
	    // Closing line
	    $pdf->Output();

 	}	

	/********************************************************
						FITUR TAMBAHAN
	********************************************************/


	public function logout(){

		$array_items = array('idakun', 'pangkat', 'nama', 'level');
		$this->session->unset_userdata($array_items);

		redirect('startpage');
	}
}