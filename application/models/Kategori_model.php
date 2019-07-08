<?php

class Kategori_model extends CI_Model {

	// method untuk hapus data buku berdasarkan id
	public function delKate($id){
		$this->db->delete('kategori', array("idkategori" => $id));
	}

	public function showKate($id = false){
		// membaca semua data buku dari tabel 'books'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca data buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	// method untuk insert data buku ke tabel 'books'
	public function insertKate($kate){
		$data = array(
					"kategori" => $kate
		);
		$query = $this->db->insert('kategori', $data);
	}
	
	public function updateKate($idkategori, $kategori){
		$data = array(
					"idkategori" => $idkategori,
					"kategori" => $kategori
		);
		$this->db->where('idkategori', $idkategori);
		$this->db->update('kategori', $data);
	}
}

?>