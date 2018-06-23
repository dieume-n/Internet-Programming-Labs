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
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'firstName_error' => '',
                'lastName_error' => '',
                'city_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirmPassword_error' => ''
            ];

            // Validate Firstname
            if (empty($data['firstName'])) {
                $data['firstName_error'] = 'Please enter your firstName';
            }
            // Validate Lastname
            if (empty($data['lastName'])) {
                $data['lastName_error'] = 'Please enter your lastName';
            }

            // Validate Lastname
            if (empty($data['city'])) {
                $data['city_error'] = 'Please enter your city';
            }
            // Validate Email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter your email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'This email is already taken';
                }
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be atleast 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirmPassword'])) {
                $data['confirmPassword_error'] = 'Please confirm password';
            } else {
                if ($data['password'] !== $data['confirmPassword']) {
                    $data['confirmPassword_error'] = 'Password do not match';
                }
            }

            // Making sure that errors are empty
            if (empty($data['firstName_error']) && empty($data['lastName_error']) && empty($data['email_error']) && empty($data['city_error']) && empty($data['password_error']) && empty($data['confirmPassword_error'])) {
                // Hashing password
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

                // Register user
                if ($this->userModel->register($data)) {
                    Session::flash('register_success', 'You are now registered and can log in');
                    redirect('users/login');
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
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'firstName_error' => '',
                'lastName_error' => '',
                'city_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirmPassword_error' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Ckeck for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter your email';
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }

            // Making sure that errors are empty
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // Session variables;
                    $this->createUserSession($loggedInUser);
                } else {
                    Session::flash('login_fail', 'Invalid email or password', 'alert alert-danger');
                    redirect('users/login');
                    exit;
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            // Init Data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];
            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        Session::set('user_id', $user->id);
        Session::set('user_email', $user->email);
        Session::set('user_fname', $user->firstName);
        redirect('users/portal');
    }

    public function logout()
    {
        Session::unset('user_id');
        Session::unset('user_email');
        Session::unset('user_fname');
        Session::destroy();
        redirect('/');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function portal()
    {
        $user = $this->userModel->findUserbyID(Session::get('user_id'));

        if ($user) {
            $this->view('users/portal', $user);
        } else {
            die('sorry');
        }
        
    }

    public function list()
    {
        if($this->isLoggedIn()){
            $data = $this->userModel->allusers();
            if ($data) {
                $this->view('users/list', $data);
            } else {
                die('Something went wrong');
            }
        }else{
            redirect('/');
        }
    }
}
