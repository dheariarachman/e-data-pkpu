<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

    private $_m_rig     = 'm_rig';
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
            'getJson'       => site_url($this->_module . '/getDataNasabah'),
            'checkDetail'   => site_url( $this->_module . '/checkDetail' )
        );

        $this->load->view('welcome_message', $data);
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
}
