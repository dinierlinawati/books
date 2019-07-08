<?php

class User_model extends CI_Model {

	// method untuk membaca data profile user berdasar username
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}
	// method untuk hapus data buku berdasarkan id
	public function delUser($id){
		$this->db->delete('users', array("username" => $id));
	}

	// method untuk insert data buku ke tabel 'books'
	public function insertUser($uname, $pass, $full, $role){
		$data = array(
					"username" => $uname,
					"password" => $pass,
					"fullname" => $full,
					"role" => $role
		);
		$query = $this->db->insert('users', $data);
	}


	public function getRole(){
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function getRoles(){
		$query = $this->db->get('role');
		return $query->result_array();
	}

	public function updateUser($uname, $pass, $full, $role){
		
		$this->db->where('username', $uname);
		$data = array(
				"username" => $uname,
				"password" => $pass,
				"fullname" => $full,
				"role" => $role
		);

		$quary = $this->db->update('users', $data);
	}
}
?>