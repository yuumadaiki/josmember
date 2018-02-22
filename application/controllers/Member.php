<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Member extends CI_Controller {
			
		private $tabel_member = "member";
	
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Login_model');
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
				echo $cek->num_rows();
				if ($cek->num_rows() > 0) {
					$data_masuk = array(
									'member_masuk' => 'ya'
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
			// print_r($_SESSION);

			// untuk judul halaman
			$title = "Home";
			if (isset($page)) {
				if ($page == 'upgrade') {
					$title = "Upgrade Membership";
				} else if ($page == 'upload_bukti') {
					$title = "Upload Bukti Pembayaran";
				}	
			}

			$data = array(
						'page' => $page,
						'title' => $title
					);
			$this->load->view('member/layout',$data);


			// untuk logout
			if (isset($page) && $page == 'logout') {
				$this->session->sess_destroy();
				redirect('member');
			}
		}

	}
	
	/* End of file Member.php */
	/* Location: ./application/controllers/Member.php */
?>