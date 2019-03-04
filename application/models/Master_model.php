<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Master_model extends MY_Model {

        public function cetak_rig($id) {
			$this->db->select('*');
			$this->db->from('m_data');
			$this->db->where('id',$id);
			$query = $this->db->get();

			return $query;
		}

		public function generateDatatables()
		{
			$this->datatables->select('numbering, id_jamaah, customer, c_address, phone_number, power_of_attorney_detail, amount, id');
			$this->datatables->from('m_data');
			return $this->datatables->generate();
		}
				
    }

/* Mnd of file master_model.MYp */
