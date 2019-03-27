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

    public function index($id = '')
    {
        $data = array(
            'id'            => $id,
            'title'         => 'Dashboard',
            'content'       => 'layouts/dashboard',
            'getJson'       => site_url( $this->_module . '/getDataNasabah' ),
            'checkDetail'   => site_url( $this->_module . '/checkDetail' ),
            'print_pdf'     => site_url( $this->_module . '/printToPdf' ),
            'print_pdf_non' => site_url( $this->_module . '/printToPdfNon' ),
            'print_excel'   => site_url( $this->_module . '/printToExcel' ),
            'print_excel_non'   => site_url( $this->_module . '/printToExcelNon' ),
            'getSum'        => site_url( $this->_module . '/getSum' ),
            'getSumTotal'   => site_url( $this->_module . '/getSumTotal'),
            'getSumPerToday'            => site_url( $this->_module . '/getSumPerToday' ),
            'getSumNonNasabahPerToday'  => site_url( $this->_module . '/getSumNonNasabahPerToday' )
        );

        $this->load->view('welcome_message', $data);
    }

    public function getSumTotal()
    {
        $data = $this->master_model->getByQuery('SELECT SUM(amount) AS amount FROM( SELECT SUM(amount) AS amount FROM m_data UNION ALL SELECT SUM(amount) AS amount FROM m_data_perusahaan ) x')->result();
        echo json_encode($data);
    }

    public function getSum()
    {
        $data = $this->master_model->getSum('m_data', 'GROUPING', 'COUNT(customer) customer,  SUM(amount) total, DATE(created_on) GROUPING')->result();
        echo json_encode($data);
    }

    public function getSumPerToday()
    {
        $data = $this->master_model->getSum('m_data', '', 'COUNT(customer) customer,  SUM(amount) total, DATE(MAX(created_on)) GROUPING')->result();
        echo json_encode($data);
    }

    public function getSumNonNasabahPerToday()
    {
        $data = $this->master_model->getSum('m_data_perusahaan', '', 'COUNT(name) customer,  SUM(amount) total, DATE(MAX(created_on)) GROUPING')->result();
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
        $title      = 'Daftar Jamaah PT. Solusi Balad Lumampah ( Dalam PKPU )';
        return master::cetak($tablePdf, 'L', $title);
    }

    public function printToPdfNon()
    {
        $queryTable = $this->master_model->getAll('m_data_perusahaan', 'numbering');
        $data = array(
            'data' => $queryTable
        );
        $tablePdf = $this->load->view('layouts/pdf_perusahaan', $data, true);
        $title      = 'Daftar Non Jamaah PT. Solusi Balad Lumampah ( Dalam PKPU )';
        return master::cetak($tablePdf, 'L', $title);
    }

    public function printToExcelNon()
    {
        $dataQuery  = array();
        $title      = 'Daftar Non Jamaah PT. Solusi Balad Lumampah ( Dalam PKPU )';
        $query      = $this->master_model->getAll('m_data_perusahaan', 'numbering', 'numbering, instansi, name, address, phone_number, power_of_attorney_detail, amount')->result();
        foreach ($query as $key => $value) {
            $dataQuery[$key] = array(
                'A' => $value->numbering,
                'B' => $value->instansi,
                'C' => $value->address,
                'D' => $value->name,
                'E' => $value->phone_number,
                'F' => $value->power_of_attorney_detail,
                'G' => $value->amount,
            );
        }        
        
        $dataTitle      = Excel::setExcelTitle(array(['No. ', 8], ['Instansi', 15], ['Alamat', 18], ['PIC', 20], ['Telepon', 20], ['Kuasa', 18], ['Total Tagihan', 20]));
        $excelValue     = Excel::setExcelValue($dataQuery, 'horizontal_center|vertical_center', true);
        return Excel::exportExcel($title, $dataTitle, $excelValue);
    }

    public function printToExcel()
    {
        $dataQuery  = array();
        $title      = 'Daftar Jamaah PT. Solusi Balad Lumampah ( Dalam PKPU )';
        $query      = $this->master_model->getAll('m_data', 'numbering', 'numbering, id_jamaah, customer, c_address, phone_number, power_of_attorney_detail,amount')->result();
        foreach ($query as $key => $value) {
            $dataQuery[$key] = array(
                'A' => $value->numbering,
                'B' => $value->id_jamaah,
                'C' => $value->customer,
                'D' => $value->c_address,
                'E' => $value->phone_number,
                'F' => $value->power_of_attorney_detail,
                'G' => $value->amount,
            );
        }        
        
        $dataTitle      = Excel::setExcelTitle(array(['No. Urut', 8], ['ID. Jamaah', 15], ['Nama', 18], ['Alamat', 20], ['Telepon', 20], ['Kuasa', 18], ['Total Tagihan', 20]));
        $excelValue     = Excel::setExcelValue($dataQuery, 'horizontal_center|vertical_center', true);
        return Excel::exportExcel($title, $dataTitle, $excelValue);
    }
}
