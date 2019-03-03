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
        
    }

/* Mnd of file master_model.MYp */
