<?php

class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Penggunaan');
		$this->load->model('Tagihan');
		$this->load->model('Data_bank');
		$this->load->model('Pembayaran');
		$this->load->model('Akun');
		$this->load->model('FungsiTambahan');

		$this->load->library('pdf');

		if($this->session->has_userdata('idakun')){
			if($this->session->has_userdata('pangkat')){
				if($this->session->userdata('pangkat') === "admin")
					redirect('admin');
				elseif($this->session->userdata('pangkat') === "bank")
					redirect($this->session->userdata('bank'));
			}else
			redirect('startpage');
		}else
		redirect('startpage');		
	}

	public function index(){
		if($this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun')))
		$data['jumlahtunggakan'] = $this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun'));
		else
			$data['jumlahtunggakan'] = null;		

		$jumlah = $this->Penggunaan->getPenggunaanByIdPelanggan($this->session->userdata('idakun'));

		for ($i=0; $i < sizeof($jumlah); $i++) { 
			if($jumlah[$i]['tahun'] == 2019){
				$data['bulan'][$jumlah[$i]['bulan']] = $jumlah[$i]['meter_akhir'];
			}
		}


		$this->load->view('templates/header_user', $data);
		$this->load->view('user/home');
		$this->load->view('templates/footer_user');
	}

	public function penggunaan(){
		$data['penggunaan'] = $this->Penggunaan->getPenggunaanByIdPelanggan($this->session->userdata('idakun'));		

		if($this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun')))
		$data['jumlahtunggakan'] = $this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun'));
		else
			$data['jumlahtunggakan'] = null;		

		$this->load->view('templates/header_user', $data);
		$this->load->view('user/penggunaan', $data);
		$this->load->view('templates/footer_user');		
	}

	public function tagihan(){
		$data['bank'] = $this->Data_bank->getAllBank();
		$data['tagihan'] = $this->Tagihan->getTunggakanByIdPelanggan($this->session->userdata('idakun'));

		if($this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun')))
		$data['jumlahtunggakan'] = $this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun'));
		else
			$data['jumlahtunggakan'] = null;		

		$this->load->view('templates/header_user', $data);
		$this->load->view('user/tagihan', $data);
		$this->load->view('templates/footer_user');		
	}

	public function pembayaran(){
		$data['pembayaran'] = $this->Pembayaran->getPembayaranById($this->session->userdata('idakun'), "pelanggan");		

		if($this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun')))
		$data['jumlahtunggakan'] = $this->Tagihan->jumlahTagihan("tagihan pelanggan", $this->session->userdata('idakun'));
		else
			$data['jumlahtunggakan'] = null;		
		
		$this->load->view('templates/header_user', $data);
		$this->load->view('user/pembayaran', $data);
		$this->load->view('templates/footer_user');		
	}	

	public function bayar(){
		$idpembayaran = $this->FungsiTambahan->cariIdKosong("pembayaran");

		$this->Pembayaran->tambahPembayaran($idpembayaran, $this->input->post('id_tagihan'), $this->session->userdata('idakun'), $this->input->post('totalbayar'), $this->input->post('id_bank'), $this->input->post('bulan'), $this->input->post('tahun'));

		$this->Tagihan->updateTagihan($this->input->post('id_tagihan'), "pending");

		$this->session->set_flashdata('aksiTagihan', 'Membayar');
		redirect('user/tagihan');
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

	public function getdetailbayar(){
		echo json_encode($this->Pembayaran->getPembayaranById($this->input->post('id'), "tagihan"));
	}

	public function getdetailpembayaran(){
		echo json_encode($this->Pembayaran->getPembayaranById($this->input->post('id'), "pembayaran"));
	}	


	public function getbayar(){
		echo json_encode($this->Tagihan->getInfoTagihanFullById($this->input->post('id')));
	}

	public function logout(){

		$array_items = array('idakun', 'pangkat', 'nama');
		$this->session->unset_userdata($array_items);

		redirect('startpage');
	}
}