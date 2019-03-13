<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Master_model extends MY_Model {

        public function cetak_rig($id, $table) {
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('id',$id);
			$query = $this->db->get();

			return $query;
		}

		public function getNumbering($id = '', $table = '')
		{
			$this->db->select('numbering');
			$this->db->from($table);
			$this->db->where('id' , $id);
			$query = $this->db->get()->row();
			return $query;
		}

		public function getSum($table = '')
		{
			$this->db->select('COUNT(customer) customer,  SUM(amount) total, DATE(created_on) GROUPING');
			$this->db->from($table);
			$this->db->group_by('GROUPING');
			return $this->db->get();
		}

		public function getSumPerToday($table = '')
		{
			$this->db->select('COUNT(customer) customer,  SUM(amount) total, DATE(MAX(created_on)) GROUPING');
			$this->db->from($table);
			return $this->db->get();
		}

		public function generateDatatables()
		{
			$this->datatables->select('numbering, id_jamaah, customer, c_address, phone_number, power_of_attorney_detail, amount, id');
			$this->datatables->from('m_data');
			return $this->datatables->generate();
		}

		public function generateDatatablesDashboard($where_col = '', $where_val = '')
		{
			$this->datatables->select('numbering, id_jamaah, customer, c_address, phone_number, power_of_attorney_detail, amount, id');
			$this->datatables->from('m_data');
			if(!empty($where_val)) {
				$this->datatables->like($where_col, $where_val);
			}
			return $this->datatables->generate();
		}

		public function generateDatatablesPerusahaan()
		{
			$this->datatables->select('id, numbering, name, instansi, job_title, address, phone_number, email');
			$this->datatables->from('m_data_perusahaan');
			return $this->datatables->generate();
		}
    }

/* Mnd of file master_model.MYp */
