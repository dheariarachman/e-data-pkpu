<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Barang extends MY_Controller {

    private $_table     = 'm_barang';
    private $_module    = 'M_Barang';
    private $_title     = 'Master Barang';
    private $_m_type    = 'm_type';
    private $_m_status_barang    = 'm_status_barang';
    private $_m_rig     = 'm_rig';
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(array('master_model'));
    }

    public function index()
    {
        $data = array(
            'content'       => $this->_module . '/main',
            'title'         => $this->_title,
            'class'         => $this->_module,
            'form'          => $this->_module . '/form',
            'action'        => site_url( $this->_module . '/saveData'),
            'delete'        => site_url( $this->_module . '/deleteData'),
            'edit'          => site_url( $this->_module . '/editData'),
            'update'        => site_url( $this->_module . '/updateData'),
            'typeSource'    => site_url( $this->_module . '/getDataTypeBarang'),
            'statusSource'  => site_url( $this->_module . '/getDataStatusBarang'),
            'rigSource'     => site_url( $this->_module . '/getDataRig')
        );

        $this->load->view('welcome_message', $data);        
    }

    public function getData()
    {
        return master::responseGetData($this->_table);
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

    public function getDataRig()
    {
        $params = $this->input->get('q');
        return master::getDataSelect($this->_m_rig, array('name_rig' => $params));
    }

    public function saveData()
    {
        $this->form_validation->set_rules('id_type', 'Tipe', 'required');
        $this->form_validation->set_rules('serial_num', 'Serial Number', 'trim|required|is_unique['.$this->_table.'.serial_num]');
        $this->form_validation->set_rules('name_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('stock_in', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('id_status_barang', 'Status Barang', 'required');

        if ($this->form_validation->run() !== FALSE ) {
            $data = $this->input->post();
            return master::saveData($data, $this->_table);
        }
    }

    public function deleteData()
    {
        $data = $this->input->post('id');
        return master::deleteData(array('id_barang' => $data), $this->_table);
    }

    public function editData()
    {
        $data   = $this->input->post('id');
        return master::getDataById(array('id_barang' => $data), $this->_table);
    }

    public function updateData()
    {
        $id = $this->input->post('id');
        $data = array(
            'id_type'           => $this->input->post('id_type'),
            'name_barang'       => $this->input->post('name_barang'),
            's_n'               => $this->input->post('s_n'),
            'stock_in'          => $this->input->post('stock_in'),
            'id_status_barang'  => $this->input->post('id_status_barang'),
        );
        
        return master::updateData($data, array('id_barang' => $id), $this->_table);
    }
}

/* End of file M_Jenisitem.php */
