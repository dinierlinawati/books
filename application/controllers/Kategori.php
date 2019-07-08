<?php
class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('kategori_model'); # <- add this

		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}

	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->kategori_model->delKate($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/kategori');
	}

	// method untuk tambah data buku
	public function insert(){

		// baca data dari form insert buku
		$kate = $_POST['kate'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->kategori_model->insertKate($kate);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/kategori');
	}

	public function edit($id){
        $data['view_category'] = $this->kategori_model->showKate($id);

        $data['fullname'] = $_SESSION['fullname'];

        if (empty($data['view_category'])){
            show_404();
        }

        $data['idkategori'] = $data['view_category']['idkategori'];
        $data['kategori'] = $data['view_category']['kategori'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editkategori', $data);
        $this->load->view('dashboard/footer');
    }

   	public function update(){
   		// baca data dari form insert buku
   		$idkategori = $_POST['idkategori'];
		$kategori = $_POST['kategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->kategori_model->updateKate($idkategori, $kategori);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/kategori');

	}

}
?>