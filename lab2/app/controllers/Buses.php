<?php

class Buses extends Controller
{
    public function __construct()
    {
        $this->busModel = $this->model('Bus');
    }

    public function add()
    {
        // Ckeck for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'busPlate' => trim($_POST['busPlate']),
                'capacity' => trim($_POST['capacity']),
                'busRouteFrom' => trim($_POST['busRouteFrom']),
                'busRouteTo' => trim($_POST['busRouteTo']),
                'busRouteID' => '',
                'busPlate_error' => '',
                'capacity_error' => '',
                'busRouteFrom_error' => '',
                'busRouteTo_error' => '',
            ];

            // Validate BusPlate
            if (empty($data['busPlate'])) {
                $data['busPlate_error'] = 'Please enter Bus registration plate';
            } else {
                // Check bus reg plate
                if ($this->userModel->findBusByRegPlate($data['busPlate'])) {
                    $data['busPlate_error'] = 'This registration plate is already taken';
                }
            }
            // Validate Bus capacity
            if (empty($data['capacity'])) {
                $data['capacity_error'] = 'Please enter the Bus capacity ';
            } elseif ($data['capacity'] < 12) {
                $data['capacity_error'] = 'The capacity is too low';
            }
            // Validate Bus Route From
            if (empty($data['busRouteFrom'])) {
                $data['busRouteFrom_error'] = 'Please select the Bus point of origin';
            }
            // Validate Bus Route To
            if (empty($data['busRouteTo'])) {
                $data['busRouteTo_error'] = 'Please select the Bus destination';
            }

            // Making sure that errors are empty
            if (empty($data['busPlate_error']) && empty($data['capacity_error']) && empty($data['busRouteFrom_error']) && empty($data['busRouteTo_error'])) {
                
                // Find Bus route id
                $route = $this->busModel->findBusRouteID($from, $to);
                if ($route->id) {
                    $data['busRouteID'] = $route->id;
                }

                // Adding the Bus
                if ($this->busModel->add($data)) {
                    Session::flash('addBus_success', 'The Bus have been added');
                    redirect('buses/list');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('buses/add', $data);
            }
        } else {
            // Init Data
            $data = [
                'busPlate' => '',
                'capacity' => '',
                'busRouteFrom' => '',
                'busRouteTo' => '',
                'busRouteID' => '',
                'busPlate_error' => '',
                'capacity_error' => '',
                'busRouteFrom_error' => '',
                'busRouteTo_error' => '',
            ];

            // Load view
            $this->view('buses/add', $data);
        }
    }
}
