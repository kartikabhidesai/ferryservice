<?php

class ApiController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Api_model');
    }

    function index() {
        $data = "userName=Indigo&password=Indigo%40123&agentID=8ef79695-4fe4-4f10-8065-f81869504685";
        $url = "http://indigo.kcits.in/api/api/Authenticate";
        $result = $this->Api_model->getApiRecord($url, $data, 'POST');
        print_r($result);
    }

    function getStop() {

         $data = "token=NgKsXWk2HHwZsOUvAeClfJGVrISyN2Ss";
//         $data = "userName=Indigo&password=Indigo%40123&agentID=8ef79695-4fe4-4f10-8065-f81869504685";
        $url = "http://indigo.kcits.in/api/api/GetStops";
        $result = $this->Api_model->getApiRecord($url, $data, 'GET');
        print_r($result);
        exit;
    }

}

?>