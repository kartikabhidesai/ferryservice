<?php

class Homepage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
        $this->load->model('Account_model');
        $this->load->helper('cookie');
    }

    public function index() {

        $data['page'] = "front/home/index";
        $data['var_meta_title'] = 'login';
        $data['var_meta_description'] = 'login';
        $data['var_meta_keyword'] = 'login';

        $getToken = $this->getToken();
        $getStop = array();
        if ($getToken) {
            $getStop = $this->getStop();
            if ($getStop['message'] == 'Success') {
                $getStop = $getStop['data'];
            } else {
                $data['message'] = $getStop['message'];
                $data['page'] = "front/home/wrong";
            }
        } else {
            $data['page'] = "front/home/wrong";
        }
        $data['js'] = array(
            'front/home.js'
        );
        $data['js_plugin'] = array();

        $data['css'] = array();
        $data['css_plugin'] = array(
        );
        $data['init'] = array(
            'Home.init()'
        );
        $data['getStop'] = $getStop;
        $this->load->view(FRONT_LAYOUT, $data);
    }

    public function getToken() {
        $data = "userName=Indigo&password=Indigo%40123&agentID=8ef79695-4fe4-4f10-8065-f81869504685";
        $url = "http://indigo.kcits.in/api/api/Authenticate";
        $header = array();
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);

        if (isset($result['data']['token'])) {
            $this->session->set_userdata('token', $result['data']['token']);
            return true;
        } else {
            return false;
        }
    }

    public function getStop() {
        $token = $this->session->userdata('token');
        $data = "token=NgKsXWk2HHwZsOUvAeClfJGVrISyN2Ss";
        $url = "http://indigo.kcits.in/api/api/GetStops";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);

        if (isset($result['success'])) {
            return $result;
        } else {
            return $result;
        }
    }

    public function getTrips() {

        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://indigo.kcits.in/api/api/GetTrips?departureDate=31/05/2018&destinationID=2&sourceID=1";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        echo json_encode($result);
        exit;
    }

}

?>