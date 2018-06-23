<?php

class Routes extends Controller
{
    public function __construct()
    {
        $this->routeModel = $this->model('Route');
    }

    public function add()
    {
        // Ckeck for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'from' => trim($_POST['from']),
                'to' => trim($_POST['to']),
                'fare' => (int)trim($_POST['fare']),
                'from_error' => '',
                'to_error' => '',
                'fare_error' => '',
            ];

            // Validate Route From
            if (empty($data['from'])) {
                $data['from_error'] = 'Please enter the departure piont';
            }
            // Validate Bus capacity
            if (empty($data['to'])) {
                $data['to_error'] = 'Please enter the destination ';
            }
            // Validate Bus Route From
            if (empty($data['fare'])) {
                $data['fare_error'] = 'Please enter the ticket price';
            }

            // Making sure that errors are empty
            if (empty($data['from_error']) && empty($data['to_error']) && empty($data['fare_error'])) {
                
                // Find Bus route id
                // $route = $this->busModel->findBusRouteID($from, $to);
                // if ($route->id) {
                //     $data['busRouteID'] = $route->id;
                // }

                // Adding the Bus
                if ($this->routeModel->add($data)) {
                    Session::flash('addRoute_success', 'The route has been added');
                    redirect('routes/list');
                    exit;
                } else {
                    Session::flash('addRoute_failed', 'The route has been added', 'alert alert-danger');
                    redirect('routes/add');
                    exit;
                }
            } else {
                $this->view('routes/add', $data);
            }
        } else {
            // Init Data
            $data = [
                'from' => '',
                'to' => '',
                'fare' => '',
                'from_error' => '',
                'to_error' => '',
                'fare_error' => '',
            ];

            // Load view
            $this->view('routes/add', $data);
        }
    }

    public function list()
    {
        $data = $this->routeModel->all();
        // die(var_dump($routes));
        if ($data) {
            $this->view('routes/list', $data);
        } else {
            die('Something went wrong');
        }
    }
}
