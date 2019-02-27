<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class T_Rig extends MY_Controller {

    private $_table     = 't_rig';
    private $_module    = 'T_Rig';
    private $_title     = 'RIG';

    private $_m_rig     = 'm_rig';
    private $_m_type    = 'm_type';

    private $_id        = 'id_rig';
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model(array('master_model'));
    }

    public function index( $id = '' )
    {
        $data = array(
            'content'       => $this->_module . '/main',
            'title'         => $this->_title,
            'class'         => $this->_module,
            'form'          => $this->_module . '/form',
            'dataSource'    => site_url( $this->_module . '/getData/' . $id ),
            'action'        => site_url( $this->_module . '/saveData'),
            'delete'        => site_url( $this->_module . '/deleteData'),
            'edit'          => site_url( $this->_module . '/editData'),
            'update'        => site_url( $this->_module . '/updateData'),
            'rigSource'     => site_url( $this->_module . '/getDataRig' ),
            'typeSource'    => site_url( $this->_module . '/getDataType' ),
            'brgSource'     => site_url( $this->_module . '/getDataBarang' )
        );

        $this->load->view('welcome_message', $data);        
    }

    public function getData( $id = '' )
    {
        $condition = array();
        if(!empty($id)) {
            $condition = array('id_rig' => $id);
        }
        return master::responseGetData($this->_table, $condition);
    }

    public function getDataRig()
    {
        $params = $this->input->post('q');
        return master::getDataSelect($this->_m_rig, array('name_rig' => $params));
    }

    public function getDataType()
    {
        $params = $this->input->post('q');
        return master::getDataSelect($this->_m_type, array('name_type' => $params));
    }

    public function saveData()
    {        
        $this->form_validation->set_rules($this->_id, 'ID Tipe', 'required|is_unique['.$this->_table.'.'.$this->_id.']');
        $this->form_validation->set_rules('name_rig', 'Nama Status Barang', 'trim|required');
        
        if ($this->form_validation->run() == TRUE ) {
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
        $id_rig      = $this->input->post($this->_id);
        $name_rig    = $this->input->post('name_rig');
        return master::updateData(array('name_rig' => $name_rig), array($this->_id => $id_rig), $this->_table);
    }

}

/* End of file M_Jenisitem.php */
