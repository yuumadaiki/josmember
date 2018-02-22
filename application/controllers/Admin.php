<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admin extends CI_Controller {
	
		private $tabel = "admin";
		private $tabel_member = "member";
		private $tabel_upgrade = "upgrade";

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Login_model');
			$this->load->model('Member_model');
			$this->load->library('Cek_login');
		}

		public function index()
		{
			if ($this->session->userdata('status_masuk') == 'ya') {
				redirect('admin/dashboard');
			} else {
				$this->load->view('admin/login');
			}
		}

		public function proses() {
			$input = $this->input->post();
			if (isset($input['tombol'])) {
				$data_cek = array(
						'username' => $input['username'],
						'password' => md5($input['pass'])
					);
				$cek = $this->Login_model->cek($data_cek,$this->tabel);
				if ($cek->num_rows() > 0) {
					$buat_sesi = array(
									'status_masuk' => 'ya', 
								);
					$this->session->set_userdata($buat_sesi);
					redirect('admin/dashboard');
				} else {
					redirect('admin');
				}
			} else {
				redirect('admin');
			}
		}
	
		public function dashboard() {
			$datanya = array('status_masuk' => 'ya');
			$page = $this->uri->segment(3);
			$this->cek_login->cek_sesi($datanya, 'status_masuk', 'ya', 'admin');


			$data = array(
						'page' => $page,
						'menu' => base_url('asset/dashboard_admin/menu.php'),
						'content' => 'dashboard',
						'member' => $this->Member_model->baca_data($this->tabel_member),
						'upgrade' => $this->Member_model->baca_data($this->tabel_upgrade)
					);



			$this->load->view('admin/dashboard/layout',$data);

			// untuk logout
			if ($page == 'logout') {
				$this->session->sess_destroy('status_masuk');
				redirect('admin');
			}
		}

		// aksi
		public function hapus() {
			$id = $this->uri->segment(3);
			$this->cek_login->cek_sesi($datanya, 'status_masuk', 'ya', 'admin');
			$where = array('id' => $id);
			$this->Member_model->hapus($this->tabel_member, $where);
			redirect('admin/dashboard/member');
		}

	}
	
	/* End of file Admin.php */
	/* Location: ./application/controllers/Admin.php */


?>