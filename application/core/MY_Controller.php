<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    private $_m_type        = 'm_type';
    private $_m_status      = 'm_status';
    private $_m_status_barang      = 'm_status_barang';
    private $_m_barang      = 'm_barang';
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getDataTypeBarang()
    {
        $params = $this->input->get('q');
        return master::getDataSelect($this->_m_type, array('name_type' => $params));
    }

    public function getDataStatusBarang()
    {
        $params = $this->input->get('q');
        return master::getDataSelect($this->_m_status_barang, array('name_status_barang' => $params));
    }

    public function getDataStatusPosisi()
    {
        $params = $this->input->get('q');
        return master::getDataSelect($this->_m_status, array('name_status' => $params));
    }

    public function getDataBarang($id_col = '', $id = '')
    {
        $params = $this->input->get('q');
        $condition = array();
        if(!empty($id)) {
            $condition = array($id_col => $id);
        }
        return master::getDataSelect($this->_m_barang, array('name_barang' => $params), $condition);
    }
}
