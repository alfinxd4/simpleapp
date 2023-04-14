<?php

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        // if login admin
        if ($this->session->userdata('masuk') == TRUE) {
            // view dashboard page
            $this->load->view('v_dashboard');
        } else {
            $url = base_url();
            redirect($url);
        }
    }
}
