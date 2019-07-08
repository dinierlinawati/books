<?php
class Book extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}

	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk tambah data buku
	public function insert(){

		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

		//View the Edit page 
		public function edit($id){
    			$data['kategori'] = $this->book_model->getKategori();
                $data['view_book'] = $this->book_model->showBook($id);

                $data['fullname'] = $_SESSION['fullname'];

                if (empty($data['view_book'])){
                show_404();
                }

                $data['idbuku'] = $data['view_book']['idbuku'];
                $data['judul'] = $data['view_book']['judul'];
                $data['pengarang'] = $data['view_book']['pengarang'];
                $data['penerbit'] = $data['view_book']['penerbit'];
                $data['idkategori'] = $data['view_book']['idkategori'];
                $data['img'] = $data['view_book']['imgfile'];
                $data['sinopsis'] = $data['view_book']['sinopsis'];
                $data['thnterbit'] = $data['view_book']['thnterbit'];

                $this->load->view('dashboard/header', $data);
                $this->load->view('dashboard/editbuku', $data);
                $this->load->view('dashboard/footer');
    }

   	public function update(){

		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];
		$idbuku	= $_POST['idbuku'];
		
		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->updateBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename, $idbuku);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}

	public function view($id = NULL){
		$data['fullname'] = $_SESSION['fullname'];
		$data['kategori'] = $this->book_model->getKategori();
		$data['books'] = $this->book_model->showBook($id);

                if (empty($data['books'])) {
                        show_404();
                }

                $data['idbuku'] = $data['books']['idbuku'];
                
        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/view', $data);
        $this->load->view('dashboard/footer');
    }

    public function viewop($id = NULL){
		$data['fullname'] = $_SESSION['fullname'];
		$data['books'] = $this->book_model->showBook($id);

                if (empty($data['books'])) {
                        show_404();
                }

                $data['idbuku'] = $data['books']['idbuku'];
                
        $this->load->view('operator/header', $data);
        $this->load->view('operator/viewop', $data);
        $this->load->view('operator/footer');
    }

    public function paging(){
		$this->load->library('pagination');

		$config['base_url'] = '/books/book/paging/';
		$config['total_rows'] = 200;
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		echo $this->pagination->create_links();

}

}
?>