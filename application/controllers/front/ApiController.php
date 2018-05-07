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
        $url = "http://indigo.kcits.in/api/api/GetStops&token=gVggkw0k8SchDpuYiZqAXbG1DL2sqsnB";
        $result = $this->Api_model->getApiRecord($url, $data, 'GET');
        print_r($result);
        exit;
    }

    function getTrips() {

        $data = "";
//         $data = "userName=Indigo&password=Indigo%40123&agentID=8ef79695-4fe4-4f10-8065-f81869504685";
        $url = "http://indigo.kcits.in/api/api/GetTrips?access_token=gVggkw0k8SchDpuYiZqAXbG1DL2sqsnB?departureDate=31/03/2018&destinationID=2&sourceID=1";
        $result = $this->Api_model->getApiRecord($url, $data, 'GET');
        print_r($result);
        exit;
    }

    function getupdateBooking() {

        $data = "bookingID=11834&returnBookingID=0&email=priyankas@keyconcepts.co.in&paymentMode=&receiptnumber=&remark=&mobile=9586382983&transactionID=pay_9t7JEWfTlh6BFv&isCorporateBooking=false&companyName=&cgstNo=&address=";
        $url = "http://indigo.kcits.in/api/api/UpdateBooking";
        $result = $this->Api_model->getApiRecord($url, $data, 'POST');
        print_r($result);
        exit;
    }

}

?>