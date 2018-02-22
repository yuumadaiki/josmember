<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Member_model extends CI_Model {
	
		public function baca_data($table) {
			$data;
			$query = $this->db->get($table);
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$data[] = $row;
				}
				$query->free_result();
			} else {
				$data = NULL;
			}

			return $data;
		}

		public function hapus($table, $where) {
			return $this->db->delete($table, $where);
		}
	
	}
	
	/* End of file Member_model.php */
	/* Location: ./application/models/Member_model.php */
?>