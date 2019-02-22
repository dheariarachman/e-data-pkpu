<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jenisitem extends MY_Controller {

    private $_table     = 'm_type';
    private $_module    = 'M_Jenisitem';
    private $_title     = 'Master Jenis Item';
    
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
            'action'    => site_url( $this->_module . '/saveData'),
            'delete'    => site_url( $this->_module . '/deleteData'),
            'edit'      => site_url( $this->_module . '/editData'),
            'update'    => site_url( $this->_module . '/updateData'),
        );

        $this->load->view('welcome_message', $data);        
    }

    public function getData()
    {
        return master::responseGetData($this->_table);
    }

    public function saveData()
    {        
        $this->form_validation->set_rules('id_type', 'ID Tipe', 'required|is_unique['.$this->_table.'.id_type]');
        $this->form_validation->set_rules('name_type', 'Tipe', 'trim|required');
        
        if ($this->form_validation->run() == TRUE ) {
            $data = $this->input->post();
            return master::saveData($data, $this->_table);
        }
    }

    public function deleteData()
    {
        $data = $this->input->post('id');
        return master::deleteData(array('id_type' => $data), $this->_table);
    }

    public function editData()
    {
        $data   = $this->input->post('id');
        return master::getDataById(array('id_type' => $data), $this->_table);
    }

    public function updateData()
    {
        $id_status      = $this->input->post('id_type');
        $nama_status    = $this->input->post('name_type');
        return master::updateData(array('name_type' => $nama_status), array('id_type' => $id_status), $this->_table);
    }

}

/* End of file M_Jenisitem.php */
