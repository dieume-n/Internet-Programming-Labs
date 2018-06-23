<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->view('pages/index');
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App to share posts with other users'
        ];
  
        $this->view('pages/about', $data);
    }

    public function developer()
    {
        if(isset($_SESSION['user_id'])){
            $data = [
                'title' => 'Lab 6',
                'description' => 'This page allows you to generate api keys'
            ];
            $this->view('pages/developer', $data);
        }else{
            redirect('/');
        }
        
    }
}
