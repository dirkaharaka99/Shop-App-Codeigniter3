<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->model('transaksi_model');
		$this->load->library('pagination');
	}


	public function index($offset = 0)
	{
		$search = $this->input->get('search');
		$total_rows = $this->transaksi_model->count_all_data();
		$limit = 10;

		$config_pagination['base_url'] = base_url().'index.php/transaksi/index';
		$config_pagination['total_rows'] = $total_rows;
		$config_pagination['per_page'] = $limit;
		$config_pagination['full_tag_open'] = '<div class="pagination">';
		$config_pagination['full_tag_close'] = '</div>';
		$config_pagination['cur_tag_open'] = '<a class="active">';
		$config_pagination['cur_tag_close'] = '</a>';
		$config_pagination['next_link'] = 'Next >>';
		$config_pagination['prev_link'] = '<< Prev';

		$this->pagination->initialize($config_pagination);
		$pagination = $this->pagination->create_links();
		// $queryAllTransaksi = $this->transaksi_model->getDataTransaksi($offset, $limit, $search);
        $joinKodeBarang = $this->transaksi_model->joinKodeBarang($offset, $limit, $search);
        
		$DATA = array(
			// 'queryAllTransaksi' => $queryAllTransaksi,
			'pagination' => $pagination,
			'offset' => $offset,
            'joinKodeBarang' =>  $joinKodeBarang,
		);
		$this->load->view('transaksi', $DATA);
	}

    public function halaman_tambah() 
	{
        $queryAllBarang = $this->transaksi_model->getDataBarang();
        $DATA = array('queryAllBarang' => $queryAllBarang);
		$this->load->view('tambah_transaksi', $DATA);
	}

    public function fungsiTambah()
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required',
			array('required' => '{field} tidak boleh kosong'));
		$this->form_validation->set_rules('qty', 'Qty', 'required|numeric',
			array('required' => '{field} tidak boleh kosong',
				  'numeric' => '{field} hanya boleh bertipe angka'
			));
		$this->form_validation->set_rules('jumlah_harga', 'Jumlah Barang', 'required|numeric',
			array('required' => '{field} tidak boleh kosong',
			'numeric' => '{field} hanya boleh bertipe angka'
			));

		if($this->form_validation->run()){
            $kode_barang = $this->input->post('kode_barang');
            $qty = $this->input->post('qty');
            $jumlah_harga = $this->input->post('jumlah_harga');
            
            $data = array(
                'kode_barang' => $kode_barang,
                'qty' => $qty,
                'jumlah_harga' => $jumlah_harga,
            );
            $transaksi = new Transaksi_model;
            $res = $transaksi->insertDataTransaksi($data);
            $this->session->set_flashdata('status','Tambah Data Transaksi Sukses');
            redirect(site_url('/transaksi'));
		}else{
			$this->halaman_tambah();
		}
}
	
    
    public function halaman_ubah($id)
	{
        $queryAllBarang = $this->transaksi_model->getDataBarang();
        $data = array('queryAllBarang' => $queryAllBarang);
		
		$transaksi = new Transaksi_model;
		$data['transaksi'] = $transaksi->editDataTransaksi($id);

		$this->load->view('ubah_transaksi', $data);
	}


    public function fungsiUbah($id)
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required',
			array('required' => '{field} tidak boleh kosong'));
		$this->form_validation->set_rules('qty', 'Qty', 'required|numeric',
			array('required' => '{field} tidak boleh kosong',
			  'numeric' => '{field} hanya boleh bertipe angka'
		));
		$this->form_validation->set_rules('jumlah_harga', 'Jumlah Barang', 'required|numeric',
			array('required' => '{field} tidak boleh kosong',
			'numeric' => '{field} hanya boleh bertipe angka'
		));
		if($this->form_validation->run()){
            $kode_barang = $this->input->post('kode_barang');
            $qty = $this->input->post('qty');
            $jumlah_harga = $this->input->post('jumlah_harga');
            
            $data = array(
                'kode_barang' => $kode_barang,
                'qty' => $qty,
                'jumlah_harga' => $jumlah_harga,
            );
            $transaksi = new Transaksi_model;
            $res = $transaksi->updateDataTransaksi($data, $id);
            $this->session->set_flashdata('status','Ubah Data Transaksi Sukses');
            redirect(site_url('/transaksi'));
		}else{
			$this->halaman_ubah($id);
		}
	}

    public function fungsiDelete($id)
	{
		$barang = new Transaksi_model;
        $barang->deleteDataTransaksi($id);
        $this->session->set_flashdata('status','Data Transaksi berhasil dihapus');
        redirect(site_url('/transaksi'));
    
	}

     
}
