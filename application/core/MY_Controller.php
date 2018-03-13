<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";
class MY_Controller extends MX_Controller {

    protected $data = array();
    function __construct()
    {
        $this->data['pagetitle'] = '';
        parent::__construct();
    }

    protected function render($the_view = NULL,$template='admin')
    {
        if(is_null($template))
        {
            $this->load->view($the_view,$this->data);
        }
        else
        {
            $this->data['content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('layouts/index', $this->data);
        }
    }
}