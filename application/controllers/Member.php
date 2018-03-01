<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Member extends CI_Controller {
			
		private $tabel_member = "member";
		private $tabel_upgrade = "upgrade";
		private $tabel_content = "content";
	
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Login_model');
			$this->load->model('Member_model');
			$this->load->library('Cek_login');
		}

		public function index()
		{
			$sesi = $this->session->userdata('member_masuk');
			if ($sesi == 'ya') {
				redirect('member/dashboard');
			} else {
				$this->load->view('form_login');
			}
		}
	
		public function proses() {
			$input = $this->input->post();
			if (isset($input['tombol'])) {
				$data_login = array(
								'email' => $input['email'], 
								'password' => md5($input['password'])
							);
				$cek = $this->Login_model->cek($data_login, $this->tabel_member);
				// echo $cek->num_rows();
				$data = $cek->result_array();
				
				// print_r();
				// echo $data[0]['nama'];
				
				if ($cek->num_rows() > 0) {
					$data_masuk = array(
									'member_masuk' => 'ya',
									'nama' => $data[0]['nama'],
									'id_member' => $data[0]['id']
								);
					$this->session->set_userdata($data_masuk);
					redirect('member/dashboard');
				} else {
					redirect('member');
				}
			} else {
				redirect();
			}
		}

		public function signup() {
			$notifikasi = null;
			$page = $this->uri->segment(3);
			if ($page == 'proses') {
				$input = $this->input->post();
				// var_dump($input);
				if (isset($input['tombol'])) {
					// echo "Tombol Sudah diset";
					$data_input = null;
					if (!isset($input['line']) && !isset($input['nohp'])) {
						$data_input = array(
								'nama' => $input['nama'], 
								'email' => $input['email'],
								'password' => md5($input['password']),
								'status' => 'free',
								'tingkat' => $input['tingkat']
							);
					} else if (!isset($input['line']) && isset($input['nohp'])) {
						$data_input = array(
								'nama' => $input['nama'], 
								'email' => $input['email'],
								'password' => md5($input['password']),
								'status' => 'free',
								'tingkat' => $input['tingkat'],
								'line' => $input['nohp']
							);
					} else if (!isset($input['nohp']) && isset($input['line'])) {
						$data_input = array(
								'nama' => $input['nama'], 
								'email' => $input['email'],
								'password' => md5($input['password']),
								'status' => 'free',
								'tingkat' => $input['tingkat'],
								'line' => $input['line']
							);
					} else {
						$data_input = array(
								'nama' => $input['nama'], 
								'email' => $input['email'],
								'password' => md5($input['password']),
								'status' => 'free',
								'tingkat' => $input['tingkat'],
								'line' => $input['line'],
								'wa' => $input['nohp']
							);
					}
					// var_dump($input);
					// var_dump($data_input);
					$signup = $this->Login_model->create($this->tabel_member, $data_input);
					if ($signup) {
						$notifikasi = array('status' => 'sukses');
					} else {
						$notifikasi = array('status' => 'gagal');
					}
				}
			}
			$this->load->view('form_signup', $notifikasi);	
		}


		public function dashboard() {
			$this->cek_login->cek_sesi_member();
			$page = $this->uri->segment(3);

			// untuk judul halaman
			$title = "Home";
			if (isset($page)) {
				if ($page == 'upgrade') {
					$title = "Upgrade Membership";
				} else if ($page == 'upload_bukti') {
					$title = "Upload Bukti Pembayaran";
				}	
			}

			// untuk genreate tingkat sama status
			$id_member = $this->session->userdata('id_member');
			$status = NULL;
			$tingkat = NULL;
			if (isset($id_member)) {
				$where = array('id' => $id_member);
				$data = $this->Member_model->view_id($where, $this->tabel_member);
				$status = $data[0]['status'];
				$tingkat = $data[0]['tingkat'];
			}

			// untuk contentnya
			$menu = NULL;
			if (isset($page) && $page == 'smp') {
				$where = array('kategori' => 'smp');
				$menu = $this->Member_model->view_id($where,$this->tabel_content);
			} else {
				$where = array('kategori' => 'sma');
				$menu = $this->Member_model->view_id($where,$this->tabel_content);
			}

			// untuk sesuaikan dengan url nya
			$url = $this->uri->segment(4);
			$isi = NULL;
			if (isset($url)) {
				$where = array('link' => $url);
				$isi = $this->Member_model->view_id($where, $this->tabel_content);
			}

			$data = array(
						'page' => $page,
						'title' => $title,
						'nama' => $_SESSION['nama'],
						'status' => $status,
						'tingkat' => $tingkat,
						'content' => $menu,
						'url' => $url,
						'isi' => $isi
					);
			$this->load->view('member/layout',$data);


			// untuk logout
			if (isset($page) && $page == 'logout') {
				$this->session->sess_destroy();
				redirect('member');
			}
		}

		// AKSI
		public function do_upload() {
			
			$post = $this->input->post();

			// $config['upload_path']          = './uploads/';
			$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('foto')) {
            	$file = $this->upload->data();
            	$nama_file = $file['file_name'];
            	$datanya = array(
            					'id_member' => $_SESSION['id_member'],
            					'lunas' => 0,
            					'bukti_pembayaran' => $nama_file
            				);
            	$this->Login_model->create($this->tabel_upgrade, $datanya);
            	redirect('member/dashboard/terimakasih');
            } else {
            	echo "Gagal";
            }
		}

		public function coba() {
			$id = $this->session->userdata('id_member');
			echo $id;
			if (isset($id)) {
				$where = array('id' => $id);
				$data = $this->Member_model->view_id($where, $this->tabel_member);
				print_r($data);
				echo "<br>";
				echo $data[0]['status'];
			} else {
				echo "Tidak terset";
			}
		}

	}
	
	/* End of file Member.php */
	/* Location: ./application/controllers/Member.php */
?>
