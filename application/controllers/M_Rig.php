<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Rig extends MY_Controller
{

    private $_table     = 'm_data';
    private $_module    = 'M_Rig';
    private $_title     = 'Master Entry Data';

    private $_id         = 'id';
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(array('master_model'));
    }

    public function index()
    {
        $data = array(
            'content'   => $this->_module . '/main',
            'title'     => $this->_title,
            'class'     => $this->_module,
            'form'      => $this->_module . '/form',
            'action'    => site_url($this->_module . '/saveData'),
            'delete'    => site_url($this->_module . '/deleteData'),
            'edit'      => site_url($this->_module . '/editData'),
            'update'    => site_url($this->_module . '/updateData'),
            'cetak'     => site_url( $this->_module . '/printData'),
        );

        $this->load->view('welcome_message', $data);
    }

    public function getData()
    {
        return master::responseGetData($this->_table);
    }

    public function saveData()
    {
        $this->form_validation->set_rules($this->_id, 'ID', 'required|is_unique['.$this->_table.'.'.$this->_id.']');
        $this->form_validation->set_rules('customer', 'Nama Jamaah', 'trim|required');
        $this->form_validation->set_rules('c_address', 'Alamat Jamaah', 'trim|required');
        
        if ($this->form_validation->run() == true) {
            $data = $this->input->post();
            return master::saveData($data, $this->_table);
        }
    }

    public function deleteData()
    {
        $data = $this->input->post('id');
        return master::deleteData(array($this->_id => $data), $this->_table);
    }

    public function editData()
    {
        $data   = $this->input->post('id');
        return master::getDataById(array($this->_id => $data), $this->_table);
    }

    public function updateData()
    {
        $array_val  = array();
        $id         = $this->input->post('id');
        $data       = $this->input->post('data');
        $data_arr   = explode("&", $data);        
        foreach ($data_arr as $key => $value) {
            $data_arr_d   = explode("=", $value);            
            $array_val[$data_arr_d[0]] = $data_arr_d[1];
        }
        return master::updateData($array_val, array('id' => $id), $this->_table);
    }

    public function printData( $id = '')
    {
        master::cetak('html');
    }
}

/* End of file M_Jenisitem.php */
