<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admin extends CI_Controller {
	
		private $tabel = "admin";
		private $tabel_member = "member";
		private $tabel_upgrade = "upgrade";
		private $tabel_post = "content";

		private	$data_login = array('status_masuk' => 'ya');

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
			// $this->data_login = array('status_masuk' => 'ya');
			$page = $this->uri->segment(3);
			$this->cek_login->cek_sesi($this->data_login, 'status_masuk', 'ya', 'admin');

			// untuk edit post
			$view_id = NULL;
			if ($page == 'edit_post') {
				$id_content = $this->uri->segment(4);
				$where = array('id_content' => $id_content);
				$view_id = $this->Member_model->view_id($where, $this->tabel_post);
			}

			// update post
			$update_data = $this->input->post();
			if (($page == 'edit_post') && isset($update_data['tombol'])) {
				// print_r($update_data);
				$data_baru = array(
									'judul' => $update_data['judul'],
									'author' => $update_data['author'],
									'kategori' => $update_data['kategori'],
									'status' => $update_data['status'],
									'link' => url_title($update_data['judul'], '-', TRUE),
									'date' => date('Y-m-d H:i:s')
								);
				$where = array('id_content' => $update_data['id_content']);
				$update = $this->Member_model->update_data($this->tabel_post, $where, $data_baru);
				redirect($this->uri->uri_string());
			}

			// untuk upgrade bagian nama
			$nama = NULL;
			if ($page == 'upgrade') {
				$data_upgrade = $this->Member_model->baca_data($this->tabel_upgrade);
				$nama = $this->Member_model->nama();
			}

			$data = array(
						'page' => $page,
						'menu' => base_url('asset/dashboard_admin/menu.php'),
						'content' => 'dashboard',
						'member' => $this->Member_model->baca_data($this->tabel_member),
						'upgrade' => $this->Member_model->baca_data($this->tabel_upgrade),
						'post' => $this->Member_model->baca_data($this->tabel_post),
						'post_id' => $view_id,
						'nama' => $nama
					);



			$this->load->view('admin/dashboard/layout',$data);

			// untuk logout
			if ($page == 'logout') {
				$this->session->sess_destroy('status_masuk');
				redirect('admin');
			}
		}

		// Aksi untuk Member
		public function hapus() {
			$this->cek_login->cek_sesi($this->data_login, 'status_masuk', 'ya', 'admin');
			$id = $this->uri->segment(3);
			$where = array('id' => $id);
			$this->Member_model->hapus($this->tabel_member, $where);
			redirect('admin/dashboard/member');
		}


		// Aksi untuk post
		public function input_data() {
			$this->cek_login->cek_sesi($this->data_login, 'status_masuk', 'ya', 'admin');
			$post = $this->input->post();
			$data_input = array(
							'judul' => $post['judul'], 
							'content' => $post['content'],
							'author' => $post['author'],
							'kategori' => $post['kategori'],
							'date' => date('Y-m-d H:i:s'),
							'view' => 0,
							'status' => $post['status'],
							'link' => url_title($post['judul'], '-', TRUE)
						);
			$input = $this->Member_model->create($this->tabel_post, $data_input);
			redirect('admin/dashboard/post');
		}

		public function hapus_post() {
			$this->cek_login->cek_sesi($this->data_login, 'status_masuk', 'ya', 'admin');
			$id = $this->uri->segment(3);
			$where = array('id_content' => $id);
			$this->Member_model->hapus($this->tabel_post, $where);
			redirect('admin/dashboard/post');
		}

		public function hapus_upgrade() {
			$this->cek_login->cek_sesi($this->data_login, 'status_masuk', 'ya', 'admin');
			$id = $this->uri->segment(3);
			$where = array('id_upgrade' => $id);
			$this->Member_model->hapus($this->tabel_upgrade, $where);
			redirect('admin/dashboard/upgrade');
		}

		public function upgrade_member() {
			$get = $this->input->get();
			$id_upgrade = $get['id_upgrade'];
			$id_member = $get['id_member'];
			$where_upgrade = array('id_upgrade' => $id_upgrade);
			$where_member = array('id' => $id_member);
			$baru_ugrade = array('lunas' => 1 );
			$baru_member = array('status' => 'premium' );
			$this->Member_model->update_data($this->tabel_upgrade, $where_upgrade, $baru_ugrade);
			$this->Member_model->update_data($this->tabel_member, $where_member, $baru_member);
			redirect('admin/dashboard/upgrade');
		}

	}
	
	/* End of file Admin.php */
	/* Location: ./application/controllers/Admin.php */


?>
