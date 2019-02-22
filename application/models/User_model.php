<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

    private $_m_user = 'm_user';

    public function login($username = '', $password = '')
    {
        $condition = array('username' => $username, 'password' => $password);
        $this->db->select('*');
        $this->db->from($this->_m_user);
        $this->db->where($condition);
        $result = $this->db->get();
        if($result->num_rows() > 0) {
            $array = array(
                'userid'        => $result->row('id_user'),
                'display_name'  => $result->row('display_name'),
                'nik'           => $result->row('nik'),
            );
            $this->setLastLogin($result->row('id_user'));
            $this->session->set_userdata( $array );
        }
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
