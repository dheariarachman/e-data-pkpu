<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Barang extends MY_Controller {

    private $_table         = 'm_barang';
    private $_module        = 'M_Barang';
    private $_title         = 'Master Barang';

    private $_v_m_full_barang    = 'v_m_full_barang';
    
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
            'statusLokSource'  => site_url( $this->_module . '/getDataStatusPosisi'),
        );

        $this->load->view('welcome_message', $data);        
    }

    public function getData()
    {
        return master::responseGetData($this->_v_m_full_barang);
    }

    public function saveData()
    {
        $this->form_validation->set_rules('id_type', 'Tipe', 'required');
        $this->form_validation->set_rules('count', 'Serial Number', 'trim|required');
        $this->form_validation->set_rules('name_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('stock_in', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('id_status_barang', 'Status Barang', 'required');

        // Change Format Date in php 
        // from d-m-Y to Y-m-d
        $stockIn        = DateTime::createFromFormat('d-m-Y', $this->input->post('stock_in'));
        $stockInFormat  = $stockIn->format('Y-m-d');

        // Get data from POST and unset field stock_in ( date )
        $data = $this->input->post();
        unset($data['stock_in']);

        // Insert field stock_in after re-format
        $data['stock_in'] = $stockInFormat;
        $data['inputed_by'] = '99';

        if ($this->form_validation->run() !== FALSE ) {
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
        return master::getDataById(array('id_barang' => $data), $this->_v_m_full_barang);
    }

    public function updateData()
    {
        $id = $this->input->post('id');

        $stockIn        = DateTime::createFromFormat('Y-m-d', $this->input->post('stock_in'));
        $stockInFormat  = $stockIn->format('Y-m-d');

        $data = array(
            'id_type'           => $this->input->post('id_type'),
            'name_barang'       => $this->input->post('name_barang'),
            'count'             => $this->input->post('count'),
            'stock_in'          => $stockInFormat,
            'id_status_barang'  => $this->input->post('id_status_barang'),
            'id_status'         => $this->input->post('id_status'),
        );
        
        return master::updateData($data, array('id_barang' => $id), $this->_table);
    }
}

/* End of file M_Jenisitem.php */
