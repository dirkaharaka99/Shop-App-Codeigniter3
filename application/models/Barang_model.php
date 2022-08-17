<?php

class Barang_model extends CI_Model
{
    function __construct() {
        $this->tableName = 'barang';    
    }

	function getDataBarang($offset, $limit, $search = '') {
        $this->db->select('*')->from('barang');
        if(!empty($search)){
            $this->db->like('kode_barang', $search);
            $this->db->or_like('nama_barang', $search);
        }
        $result = $this->db
            ->offset($offset)
            ->limit($limit)
            ->get('');

        return $result->result();  
	}

    function count_all_data(){
        $query = $this->db->select('kode_barang')->get('barang');
        if($query){
            return $query->num_rows();
        }else{
            return false;
        }
    }

    function insertDataBarang($data) {
		
        return $this->db->insert($this->tableName,$data);
       	
	}

    function editDataBarang($kode_barang) {
		$query = $this->db->get_where('barang',['kode_barang' => $kode_barang]);
		return $query->row();
	}

    function updateDataBarang($data, $kode_barang) {
        return $this->db->update('barang',$data, ['kode_barang' => $kode_barang]);
        
    }

    function checkGambarBarang($kode_barang){
        $query = $this->db->get_where('barang', ['kode_barang' => $kode_barang]);
        return $query->row();
    }

    function deleteDataBarang($kode_barang) {
        return $this->db->delete('barang', ['kode_barang' => $kode_barang]);
	}

}

?>