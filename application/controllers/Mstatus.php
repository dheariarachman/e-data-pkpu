<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Mstatus extends MY_Controller {

    private $_table     = 'm_status';
    private $_module    = 'mstatus';
    private $_title     = 'Master Status';
    
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
        $this->form_validation->set_rules('id_status', 'ID Status', 'required|is_unique[m_status.id_status]');
        $this->form_validation->set_rules('name_status', 'Nama Status', 'trim|required');
        
        if ($this->form_validation->run() == TRUE ) {
            $data = $this->input->post();
            return master::saveData($data, $this->_table);
        }
    }

    public function deleteData()
    {
        $data = $this->input->post('id');
        return master::deleteData(array('id_status' => $data), $this->_table);
    }

    public function editData()
    {
        $data   = $this->input->post('id');
        return master::getDataById(array('id_status' => $data), $this->_table);
    }

    public function updateData()
    {
        $id_status      = $this->input->post('id_status');
        $nama_status    = $this->input->post('name_status');
        return master::updateData(array('name_status' => $nama_status), array('id_status' => $id_status), $this->_table);
    }
}

/* End of file mstatus.php */
