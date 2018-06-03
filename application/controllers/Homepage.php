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

    public function submitBooking(){
        $this->session->set_flashdata('success', 'Your booking is successfully. Your booking id is:'.time());
        redirect("/");
        exit;
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
        $fromDate = date('d/m/Y', strtotime($this->input->post('fromDate')));
        $fromstaton = $this->input->post('fromstaton');
        $tostation = $this->input->post('tostation');
        $url = "http://indigo.kcits.in/api/api/GetTrips?departureDate=$fromDate&destinationID=$tostation&sourceID=$fromstaton";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        if (empty($result['data'])) {
            echo $result = '{"success": true,"data": [{"tripID": 3419,"tripDate": "31/03/2018","departureTime": "11:00 AM","arrivalTime": "12:00 PM","duration": "60","fromStationName": "Dahej","toStationName": "Ghogha","ferryName": "Live _ferry","amount": 300,"BaseRate": 250,"PercentageOfDayOfDiffrence": 20,"amountOfDayOfDiffrence": 50,"PercentageOfSeatAvailability": 98,"amountOfSeatAvailability": 0,"amountOfNonWindowsSeat": 250,"amountOfWindowsSeat": 0,"amountOfTimeCharge": 0,"noOfSeatAvailability": 128,"isPassed": false,"isSeatLayout": false,"reservedSeats": 0},{"tripID": 3418,"tripDate": "31/03/2018","departureTime": "04:00 PM","arrivalTime": "05:00 PM","duration": "60","fromStationName": "Dahej","toStationName": "Ghogha","ferryName": "Live _ferry","amount": 240,"BaseRate": 200,"PercentageOfDayOfDiffrence": 20,"amountOfDayOfDiffrence": 40,"PercentageOfSeatAvailability": 100,"amountOfSeatAvailability": 0,"amountOfNonWindowsSeat": 200,"amountOfWindowsSeat": 0,"amountOfTimeCharge": 0,"noOfSeatAvailability": 130,"isPassed": false,"isSeatLayout": false,"reservedSeats": 0}],"message": "Success"}';        
            exit;
        }
        echo json_encode($result);
        exit;
    }

    public function getSeat() {

        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://indigo.kcits.in/api/api/GetSeatLayout?tripID=4624";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        echo json_encode($result);
        exit;
    }

    public function blockSeats() {
        $fields = array(
            'tripID' => "4624",
            'seatIDs' => array(3214, 3215),
            'paxDetails' => array(
                array('passangerCategoryID' => 1, 'pax' => 0),
                array('passangerCategoryID' => 1, 'pax' => 0),
            ),
        );

        $data = http_build_query($fields);

        $token = $this->session->userdata('token');
        $url = "http://indigo.kcits.in/api/api/BlockSeats";
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'POST', $header);
        echo json_encode($result);
        exit;
    }
    
    public function getPickupDetail() {
        $data = "";
        $token = $this->session->userdata('token');
        $url = "http://indigo.kcits.in/api/api/GetBuses?tripID=4624";
       // http://indigo.kcits.in/api/api/GetBuses?tripID=3418
        $header = array('authorization: ' . $token);
        $result = $this->Api_model->curlCall($url, $data, 'GET', $header);
        echo json_encode($result);
        exit;
    }

}

?>