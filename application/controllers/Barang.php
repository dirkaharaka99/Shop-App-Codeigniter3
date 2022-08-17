<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->model('barang_model');
	}


	public function index($offset = 0)
	{
		$search = $this->input->get('search');
		$total_rows = $this->barang_model->count_all_data();
		$limit = 10;

		$config_pagination['base_url'] = base_url().'index.php/barang/index';
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
		$queryAllBarang = $this->barang_model->getDataBarang($offset, $limit, $search);

		$data = [
			'queryAllBarang' => $queryAllBarang,
			'pagination' => $pagination,
			'offset' => $offset
		];
	
		$this->load->view('barang', $data);
	}

    public function halaman_tambah(){
        $this->load->view('tambah_barang');
    }

    public function fungsiTambah()
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|is_unique[barang.kode_barang]|max_length[4]',
			array('required' => '{field} tidak boleh kosong',
				  'is_unique' => 'Kode barang Sudah ada',
				  'max_length' => '{field} hanya boleh {param} karakter',
				));
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required',
			array('required' => '{field} tidak boleh kosong'));
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric',
			array('required' => '{field} tidak boleh kosong',
				  'numeric' => '{field} hanya boleh bertipe angka'
		));
		$this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|numeric',
			array('required' => '{field} tidak boleh kosong',
				  'numeric' => '{field} hanya boleh bertipe angka'
			));
		// $this->form_validation->set_rules('gambar_barang', 'Gambar Barang', 'required',
		// array('required' => '{field} tidak boleh kosong',
		// ));

		if($this->form_validation->run()){
			$ori_filename = $_FILES['gambar_barang']['name'];
			$new_name = time()."".str_replace(' ','_',$ori_filename);
			$config = [
				'upload_path' => './images/',
				'allowed_types' => 'gif|jpeg|jpg|png',
				'file_name' => $new_name,
			];
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('gambar_barang'))
				{
					$imageError = array('imageError' => $this->upload->display_errors());
					$this->load->view('tambah_barang',$imageError);
				}
			
			else{
				$gambar_barang = $this->upload->data('file_name');
				$kode_barang = $this->input->post('kode_barang');
				$nama_barang = $this->input->post('nama_barang');
				$stok = $this->input->post('stok');
				$harga_barang = $this->input->post('harga_barang');
				

				$data = array(
					'gambar_barang' => $gambar_barang,
					'kode_barang' => $kode_barang,
					'nama_barang' => $nama_barang,
					'stok' => $stok,
					'harga_barang' => $harga_barang,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				);
				$barang = new Barang_model;
				$res = $barang->insertDataBarang($data);
				$this->session->set_flashdata('status','Tambah Data Sukses');
				redirect(site_url('barang/index'));
				}
		}else{
			$this->halaman_tambah();
		}
    }

    public function halaman_ubah($kode_barang)
	{
		$barang = new Barang_model;
		$data['barang'] = $barang->editDataBarang($kode_barang);
		$this->load->view('ubah_barang', $data);
	}

    public function fungsiUbah($kode_barang)
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required',
			array('required' => 'Kode Barang tidak boleh kosong'));
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required',
			array('required' => 'Nama Barang tidak boleh kosong'));
		$this->form_validation->set_rules('stok', 'Stok', 'required');
		$this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required');

		if($this->form_validation->run()){
			$old_filename = $this->input->post('old_gambar_barang');
			$new_filename = $_FILES['gambar_barang']['name'];
			if($new_filename == TRUE)
			{
				$update_filename = time()."_".str_replace(' ','_',$_FILES['gambar_barang']['name']);
				$config = [
					'upload_path' => "./images/",
					'allowed_types' => "jpg|png|jpg|jpeg",
					'file_name' => $update_filename,
				];
				$this->load->library('upload', $config);
				if($this->upload->do_upload('gambar_barang'))
				{
					if(file_exists("./images/".$old_filename)){
						unlink("./images/".$old_filename);
					}
				}
			}	
			else
			{
				$update_filename = $old_filename;
			}
			$kode_barangs = $this->input->post('kode_barang');
			$nama_barang = $this->input->post('nama_barang');
			$stok = $this->input->post('stok');
			$harga_barang = $this->input->post('harga_barang');
	
			$data = array(
				'gambar_barang' => $update_filename,
				'kode_barang' => $kode_barangs,
				'nama_barang' => $nama_barang,
				'stok' => $stok,
				'harga_barang' => $harga_barang, 
				'updated_at' =>  date('Y-m-d H:i:s'),
			);
	
			$barang = new Barang_model;
			$res = $barang->updateDataBarang($data, $kode_barang);
			$this->session->set_flashdata('status','Update Barang Sukses');
			redirect(site_url('barang/index'));
	
		}
		else{
			return $this->halaman_ubah($kode_barang);
		}
      
	}

    public function fungsiDelete($kode_barang)
	{
		$barang = new Barang_model;
		if($barang->checkGambarBarang($kode_barang))
		{
			$data = $barang->checkGambarBarang($kode_barang);
			if(file_exists("./images/".$data->gambar_barang))
			{
				unlink("./images/".$data->gambar_barang);
			}
			$barang->deleteDataBarang($kode_barang);
			$this->session->set_flashdata('status','Data Barang dan Gambar berhasil dihapus');
			redirect(base_url(''));
		}
	}

	
}
