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
            'cetak'     => site_url($this->_module . '/printData'),
            'cetak_pe'  => site_url($this->_module . '/printDataRig')
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

            $birth_date     = $this->input->post('birth_date');

            $n_birth_date   = date('Y-m-d', strtotime($birth_date));

            $email          = $this->input->post('email');

            $data = master::decode_string($this->input->post());
            $data['birth_date'] = $n_birth_date;
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
            $array_val[$data_arr_d[0]] = urldecode($data_arr_d[1]);
        }
        
        $n_birth_date   = date('Y-m-d', strtotime($array_val['birth_date']));
        $array_val['birth_date'] = $n_birth_date;
        return master::updateData(master::decode_string($array_val), array('id' => $id), $this->_table);
    }

    public function printData( $id = '')
    {
        $getDataById = $this->master_model->getById(array('id' => $id), $this->_table)->result();
        
        $data = array(
            'date'              => master::getDateIndo(date('D-Y-m-d')),
            'nominal'           => $getDataById[0]->amount,
            'c_address'         => $getDataById[0]->c_address,
            'name'              => $getDataById[0]->customer,
            'documet'           => $getDataById[0]->other_document,
            'bilyet_k'          => $getDataById[0]->bilyet_k,
            'bilyet_s'          => $getDataById[0]->bilyet_s,
            'ktp'               => $getDataById[0]->ktp,
            'bank_evidence'     => $getDataById[0]->bank_evidence,
            'family_card'       => $getDataById[0]->family_card,
            'receipt'           => $getDataById[0]->receipt,
            'passport'          => $getDataById[0]->passport,
            'power_of_attorney' => $getDataById[0]->power_of_attorney,
            'letter_bill'       => $getDataById[0]->letter_bill,
            'other_document'    => $getDataById[0]->other_document,
            'birth_date'        => master::getDateIndoDMY(date('d-m-Y', strtotime($getDataById[0]->birth_date))),
            'birth_city'        => $getDataById[0]->birth_city,
            'phone_number'      => $getDataById[0]->phone_number,
            'email'             => $getDataById[0]->email,
            'id_jamaah'         => $getDataById[0]->id_jamaah,
            'numbering'         => $getDataById[0]->numbering,
        );
        $html = $this->load->view($this->_module . '/cetak', $data, true);
   
        master::cetak($html);
    }

    public function printDataRig( $id = '')
    {
        $data['cetak'] = $this->master_model->cetak_rig($id);
        master::cetak($this->load->view($this->_module . '/cetak_pengajuan', $data, true), '');
    }
}

/* End of file M_Jenisitem.php */
