<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model'); 

		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}

	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->user_model->delUser($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	// method untuk tambah data buku
	public function insert(){

		// baca data dari form insert buku
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$full = $_POST['full'];
		$role = $_POST['role'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->insertUser($uname, $pass, $full, $role);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	//View the Edit page 
	public function edit($username){
		$data['fullname'] = $_SESSION['fullname'];

		$data['role'] = $this->user_model->getRoles();
        $data['users'] = $this->user_model->getUserProfile($username);

		$data['uname'] = $data['users']['username'];
        $data['full'] = $data['users']['fullname'];
        $data['pass'] = $data['users']['password'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/useredit', $data);
        $this->load->view('dashboard/footer');

	}

   	//Update user
	public function update()
	{
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$full = $_POST['full'];
		$role = $_POST['role'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->user_model->updateUser($uname, $pass, $full, $role);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}
}
?>