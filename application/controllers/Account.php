<?php

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'this_model');
        $this->load->helper('cookie');
    }

    function index() {
        $this->home();
    }

    function home() {
        $data['page'] = "front/home/home";
        $data['var_meta_title'] = 'home';
        $data['var_meta_description'] = 'home';
        $data['var_meta_keyword'] = 'home';
        $data['js'] = array(
            'front/contact.js'
        );
        $data['js_plugin'] = array(
        );
        $data['css'] = array(
        );
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'Contact.contactInit()'
        );
        if ($this->input->post()) {
            $mailCheck = $this->this_model->sendEmail($this->input->post());
            redirect('/');
        }
        $this->load->view(FRONT_LAYOUT, $data);
    }

}

?>