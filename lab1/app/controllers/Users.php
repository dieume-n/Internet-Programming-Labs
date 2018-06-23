<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Ckeck for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'city' => trim($_POST['city']),
                'firstName_error' => '',
                'lastName_error' => '',
                'city_error' => '',
            ];

            // Validate Firstname
            if (empty($data['firstName'])) {
                $data['firstName_error'] = 'Please enter your first Name';
            }
            // Validate Lastname
            if (empty($data['lastName'])) {
                $data['lastName_error'] = 'Please enter your lastName';
            }
            // Validate Email
            if (empty($data['city'])) {
                $data['city_error'] = 'Please enter a city';
            } 
            

            // Making sure that errors are empty
            if (empty($data['firstName_error']) && empty($data['lastName_error']) && empty($data['city_error'])) {

                // Register user
                if ($this->userModel->register($data)) {
                    Session::flash('register_success', 'You are now registered');
                    redirect('users/list');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            // Init Data
            $data = [
                'firstName' => '',
                'lastName' => '',
                'city' => '',
                'firstName_error' => '',
                'lastName_error' => '',
                'city_error' => '',
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function list()
    {
        $data = $this->userModel->allUsers();

        if ($data) {
            $this->view('users/list', $data);
        } else {
            die('Something went wrong');
        }
    }

}
