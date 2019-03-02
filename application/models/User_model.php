<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{

    private $_account = 'account';

    public function login($condition = array())
    {
        $this->db->select('*');
        $this->db->from($this->_account);
        $this->db->where($condition);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function userProfile($condition = array())
    {
        $this->db->select('*');
        $this->db->from($this->_account);
        $this->db->where($condition);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function userSignup($condition = array())
    {        
        return $this->db->insert($this->_account, $condition);
    }

    public function setLastLogin($id)
    {
        $this->db->where(array('id_user' => $id));
        $this->db->update($this->_m_user, array('last_login' => date('d-m-Y H:i:s')));
    }

    public function signup($object = array())
    {
        return $this->db->insert($this->_m_user, $object);
    }
}

/* End of file User_model.php */
