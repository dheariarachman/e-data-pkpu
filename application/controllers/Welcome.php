<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    private $_module    = 'Welcome';

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (empty($this->session->userdata('is_loggedin'))) {
            redirect('Login', 'refresh');
        }
    }

    public function index()
    {
        $data = array(
            'title'         => 'Dashboard',
            'content'       => 'layouts/dashboard',
            'getJson'       => site_url( $this->_module . '/getDataNasabah' ),
            'checkDetail'   => site_url( $this->_module . '/checkDetail' ),
            'print_pdf'     => site_url( $this->_module . '/printToPdf' ),
            'print_excel'   => site_url( $this->_module . '/printToExcel' ),
            'getSum'        => site_url( $this->_module . '/getSum' ),
            'getSumPerToday'        => site_url( $this->_module . '/getSumPerToday' )
        );

        $this->load->view('welcome_message', $data);
    }

    public function getSum()
    {
        $data = $this->master_model->getSum('m_data')->result();
        echo json_encode($data);
    }

    public function getSumPerToday()
    {
        $data = $this->master_model->getSumPerToday('m_data')->result();
        echo json_encode($data);
    }

    public function getDataNasabah( $id = '', $val = '')
    {
        $this->output->set_content_type('application/json', 'utf-8');
        echo $this->master_model->generateDatatablesDashboard($id, $val);
    }

    public function checkDetail()
    {
        $id = $this->input->post('id');
        return master::getDataById(array('id' => $id), 'm_data');
    }

    public function logout()
    {
        if ($this->session->userdata('is_loggedin') === true) {
            $this->session->unset_userdata('is_loggedin');
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('display_name');
            $this->session->sess_destroy();
            redirect('Login', 'refresh');
        }
    }

    public function printToPdf()
    {
        $queryTable = $this->master_model->getAll('m_data', 'numbering');
        $data = array(
            'data' => $queryTable
        );
        $tablePdf = $this->load->view('layouts/pdf', $data, true);
        return master::cetak($tablePdf, 'L');
    }

    public function printToExcel()
    {
        $dataQuery = array();
        $title      = 'Daftar Nasabah PT. Solusi Balad Lumampah ( Dalam PKPU )';
        $query      = $this->master_model->getAll('m_data', 'numbering')->result();
        foreach ($query as $key => $value) {
            $dataQuery[$key] = array(
                'A' => $value->numbering,
                'B' => $value->id_jamaah,
                'C' => $value->customer,
                'D' => $value->c_address,
                'E' => $value->power_of_attorney_detail,
                'F' => $value->amount,
            );
        }

        // $dataTitle = master::setExcelTitle(array('No. Urut', 'ID. Jamaah', 'Nama', 'Alamat', 'Kuasa', 'Total Tagiah'));
        // $dataValue = Excel::setExcelValue()
        $dataTitle = Excel::setExcelTitle(array('No. Urut', 'ID. Jamaah', 'Nama', 'Alamat', 'Kuasa', 'Total Tagiah'));
        // print_debug($dataTitle);
        return Excel::exportExcel($title, $dataTitle, $dataQuery);
    }
}
