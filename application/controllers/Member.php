<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Member extends CI_Controller {
			
		private $tabel = "member";
	
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Login_model');
		}

		public function index()
		{
			$this->load->view('form_login');
		}
	
		public function proses() {
			$input = $this->input->post();
			if (isset($input['tombol'])) {
				$data_login = array(
								'username' => $input['email'], 
								'password' => md5($input['password'])
							);
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
					$signup = $this->Login_model->create($this->tabel, $data_input);
					if ($signup) {
						$notifikasi = array('status' => 'sukses');
					} else {
						$notifikasi = array('status' => 'gagal');
					}
				}
			}
			$this->load->view('form_signup', $notifikasi);	
		}

	}
	
	/* End of file Member.php */
	/* Location: ./application/controllers/Member.php */
?>