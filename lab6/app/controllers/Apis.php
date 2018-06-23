<?php

class Apis extends Controller
{
    public function __construct()
    {
        $this->apiModel = $this->model('Api');
    }

    public function generate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => 'Lab 6',
                'description' => 'This page allows you to generate api keys',
                'api' => '',
                'api_error' => '',
            ];

            $api = $this->apiModel->generateApi();
            if ($this->apiModel->save(Session::get('user_id'), $api)) {

                $apiData= $this->apiModel->getApiByUserID(Session::get('user_id'));
                if($apiData){
                    $data['api'] = end($apiData)->apiKey;
                    $this->view('apis/generate', $data);
                }else{
                    $data['api_error'] = 'Please generate an api key'; 
                    Session::flash('api_fail', 'Sorry we were not able to generate an api key', 'alert alert-danger');
                    redirect('apis/generate');
                }    
            }else{
                Session::flash('api_fail', 'Sorry we were not able to generate an api key', 'alert alert-danger');
                redirect('apis/generate');
            }
        } else {
            // Init Data
            $data = [
                'title' => 'Lab 6',
                'description' => 'This page allows you to generate api keys',
                'api' => '',
                'api_error' => '',
            ];
            // Load view
            $this->view('apis/generate', $data);
        }


        // $api = $this->apiModel->generateApi();
        // $user_id = Session::get('user_id');
        // // if($this->apiModel->save($user_id, $api)){
        //     echo json_encode($api);
        // }else{
            // die("something went wrong");
        //}
    }

    public function process($request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $api = $_SERVER['HTTP_X_API_KEY'];
            if($this->apiModel->checkApi($api)){
                $this->orderModel = $this->model('Order');

                if (isset($request)) {
                    switch ($request) {
                        case "all":
                            $orders = $this->orderModel->fetchAllOrder();
                            print_r($orders);
                            break;
                        
                        default:
                        echo json_encode($this->orderModel->fetchAllOrder(), JSON_FORCE_OBJECT);
                    }
                }

            }else{
                echo json_encode("Sorry");
            }
            

           
        }
    }
}