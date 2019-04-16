<?php 

class Bank extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Pembayaran');
		$this->load->model('Tagihan');
		$this->load->model('Akun');

	
		$this->load->library('pdf');

		if($this->session->has_userdata('idakun')){
			if($this->session->has_userdata('pangkat')){
				if($this->session->userdata('pangkat') === "pelanggan")
					redirect('user');
				elseif($this->session->userdata('pangkat') === "admin")
					redirect('admin');
			}else
				redirect('startpage');
		}else
			redirect('startpage');		
	}

	public function index(){
		$data['jumlahL1'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), 'verified', 1)*2000;
		$data['jumlahL2'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), 'verified', 2)*2000;
		$data['jumlahL3'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), 'verified', 3)*2000;
		$data['jumlahL4'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), 'verified', 4)*2000;
		$data['jumlahL5'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), 'verified', 5)*2000;
		$data['jumlahL6'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), 'verified', 6)*2000;

		$this->load->view('templates/header_bank');
		$this->load->view('bank/home', $data);
		$this->load->view('templates/footer_bank');
	}

	public function prosestransaksi(){
		$data['transaksi'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), "pending");

		$this->load->view('templates/header_bank');
		$this->load->view('bank/prosestransaksi', $data);
		$this->load->view('templates/footer_bank');
	}

	public function riwayatpembayaran(){
		$data['pembayaran'] = $this->Pembayaran->getAllPembayaranBank($this->session->userdata('idakun'), "verified");

		$this->load->view('templates/header_bank');
		$this->load->view('bank/riwayatpembayaran', $data);
		$this->load->view('templates/footer_bank');
	}

	public function getdetailpembayaran(){
		echo json_encode($this->Pembayaran->getPembayaranById($this->input->post('id'), "detailPembayaran"));
	}		

	public function verifikasitransaksi($id){
		$this->Pembayaran->verifiedPembayaran($id);
		$id_tagihan = $this->Pembayaran->getTagihanByPembayaran($id);
		$this->Tagihan->updateTagihan($id_tagihan, "lunas");

		$this->session->set_flashdata('aksiBankTransaksi', "Verifikasi");		
		redirect("bank/prosestransaksi");
	}

	public function tolaktransaksi($id){

		// Update dulu tagihan
		$id_tagihan = $this->Pembayaran->getTagihanByPembayaran($id);
		$this->Tagihan->updateTagihan($id_tagihan, "belum lunas");

		// Hapus Pembayaran setelahnya
		$this->Pembayaran->tolakPembayaran($id);

		$this->session->set_flashdata('aksiBankTransaksi', "Menolak");		
		redirect("bank/prosestransaksi");
	}

	public function printpembayaran($id){

        $pembayaran = $this->Pembayaran->getPembayaranById($id, "detailPembayaran");

        $pdf = new FPDF('L','mm','A5');

        // membuat halaman baru
        $pdf->AddPage();
        $pdf->SetTitle("StrukPembayaranListrik");
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Courier','',18);
        $pdf->Image(base_url().'assets/img/watermark.png',75,40,50,70);
        // mencetak string 
        $pdf->Cell(190,0,'STRUK BUKTI PEMBAYARAN TAGIHAN LISTRIK',0,1,'L');

        $pdf->SetFont('Courier','',12);
        $pdf->Cell(40,20,'',0,1,'L');

        $pdf->Cell(35,7,'ID.PLGN',0,0,'L');
        $pdf->Cell(10,7,':',0,0,'L');
        $pdf->Cell(40,7,$pembayaran[0]['nomor_kwh'],0,0,'R');

        $pdf->Cell(20,10,'',0,0,'L');
        $pdf->Cell(20,7,'NO STRUK',0,0,'L');
        $pdf->Cell(25,7,':',0,0,'C');
        $pdf->Cell(40,7,$pembayaran[0]['id_pembayaran'],0,1,'R');

        // 
        $pdf->Cell(35,7,'NAMA PLGN',0,0,'L');
        $pdf->Cell(10,7,':',0,0,'L');
        $pdf->Cell(40,7,$pembayaran[0]['nama_pelanggan'],0,0,'R');

        $pdf->Cell(20,10,'',0,0,'L');
        $pdf->Cell(20,7,'TANGGAL BYR',0,0,'L');
        $pdf->Cell(25,7,':',0,0,'C');
        $pdf->Cell(40,7,$pembayaran[0]['tanggal_pembayaran'],0,1,'R');

        // 
        $pdf->Cell(35,7,'TARIF/DAYA',0,0,'L');
        $pdf->Cell(10,7,':',0,0,'L');
        $pdf->Cell(40,7,$pembayaran[0]['daya']." VA",0,0,'R');

        $pdf->Cell(20,10,'',0,0,'L');
        $pdf->Cell(20,7,'BLN/TAHUN',0,0,'L');
        $pdf->Cell(25,7,':',0,0,'C');
        $pdf->Cell(40,7,$pembayaran[0]['bulan_bayar'],0,1,'R');

        // 
        $pdf->Cell(35,7,'TAGIHAN PLN',0,0,'L');
        $pdf->Cell(10,7,': Rp.',0,0,'L');
        $pdf->Cell(40,7,$pembayaran[0]['total_bayar']-2000,0,0,'R');

        $pdf->Cell(20,10,'',0,0,'L');
        $pdf->Cell(20,7,'STAND-METER',0,0,'L');
        $pdf->Cell(25,7,':',0,0,'C');
        $pdf->Cell(40,7,$pembayaran[0]['meter_awal'].' kWh - '.$pembayaran[0]['meter_akhir'].' kWh',0,1,'R');

        //
        $pdf->SetFont('Courier','B',12);
        $pdf->Cell(190,25,'PLN menyatakan struk ini sebagai bukti pembayaran yang sah, mohon disimpan',0,1,'C');

        // 
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(35,7,'ADMIN BANK',0,0,'L');
        $pdf->Cell(10,7,': Rp.',0,0,'L');
        $pdf->Cell(40,7,'2000',0,1,'R');

        $pdf->Cell(35,7,'RP BAYAR',0,0,'L');
        $pdf->Cell(10,7,': Rp.',0,0,'L');
        $pdf->Cell(40,7,$pembayaran[0]['total_bayar'],0,1,'R');

        $pdf->Cell(40,7,'',0,1,'C');

        $pdf->Cell(190,12,'TERIMA KASIH',0,1,'C');        
        $pdf->Cell(190,0,'"Rincian tagihan dapat dilihat di www.pln.co.id atau PLN terdekat"',0,1,'C');
        $pdf->Cell(190,12,'INFORMASI HUB: 123',0,1,'C');       

        $pdf->Output("I", "StrukPembayaranListrik.pdf");		
	}	

	public function laporan(){
		$data['laporan'] = $this->Pembayaran->getAllPembayaranGroupBank($this->session->userdata('idakun'));

		$this->load->view('templates/header_bank');
		$this->load->view('bank/laporan', $data);
		$this->load->view('templates/footer_bank');		
	}

	public function printlaporan($bulan){
		$hasil = str_replace('__', '/', $bulan);
		$pembayaran = $this->Pembayaran->getPembayaranByBulanBank($hasil, $this->session->userdata('idakun'));


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
		$totalB = 0;
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
	        $totalB += $row['biaya_admin'];
	        $pdf->Ln();
	    }

	    $pdf->SetFont('','B');
        $pdf->Cell(191,8,'Total Pembayaran : Rp.'.$totalall.' & Total Biaya Admin = Rp. '.$totalB,1,0, 'R');
	    // Closing line
	    $pdf->Output();

 	}		

	public function logout(){

		$array_items = array('idakun', 'pangkat', 'nama');
		$this->session->unset_userdata($array_items);

		redirect('startpage');
	}	
}