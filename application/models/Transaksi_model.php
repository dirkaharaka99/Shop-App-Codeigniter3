<?php

class Transaksi_model extends CI_Model
{
	function __construct() {
        $this->tableName = 'transaksi';
     
    }

    function joinKodeBarang($offset, $limit, $search = ''){
        $this->db->select('transaksi.id, transaksi.kode_barang, barang.nama_barang, transaksi.qty, transaksi.jumlah_harga, transaksi.created_at, transaksi.updated_at');
        if(!empty($search)){
            $this->db->like('transaksi.kode_barang', $search);
            $this->db->or_like('transaksi.qty', $search);
            $this->db->or_like('barang.nama_barang', $search);
        }
        $this->db->from('transaksi')
                 ->offset($offset)
                 ->limit($limit)
                 ->join('barang','transaksi.kode_barang = barang.kode_barang','inner');
        $result = $this->db->get()->result();
     
        return $result;
    }

    function getDataBarang() {
		$query = $this->db->get('barang');
		return $query->result();
	}

    function getDataTransaksiById($id) {
		$query = $this->db->get_where('transaksi',['id' => $id]);
		return $query->row();
	}

	function getDataTransaksi($offset, $limit, $search = '') {
        
		// $query = $this->db->get('transaksi');
		// return $query->result();
        $this->db->select('*')->from('transaksi');
        // if(!empty($search)){
        //     $this->db->like('kode_barang', $search);
        //     $this->db->or_like('qty', $search);
        // }

        $result = $this->db
            ->offset($offset)
            ->limit($limit)
            ->get('');

        return $result->result();
	}


    function count_all_data(){
        $query = $this->db->select('kode_barang')->get('transaksi');
        if($query){
            return $query->num_rows();
        }else{
            return false;
        }
    }

    function insertDataTransaksi($data) {
		
        return $this->db->insert($this->tableName,$data);
       	
	}

    function editDataTransaksi($id) {
		$query = $this->db->get_where('transaksi',['id' => $id]);
		return $query->row();
	}


    function updateDataTransaksi($data, $id) {
        return $this->db->update('transaksi',$data, ['id' => $id]);
        
    }

    function deleteDataTransaksi($id) {
        return $this->db->delete('transaksi', ['id' => $id]);
	}


}
