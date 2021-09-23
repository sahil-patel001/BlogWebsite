<?php

namespace App\Controllers;

session_start();

use App\Models\UserModel;
use App\Models\AdminModel;

class Pages extends BaseController
{
    public function index()
    {
        helper('form');

        echo view('templetes/header');
        echo view('pages/signup');
        echo view('templetes/footer');
    }

    public function showme ($page = 'signup') 
    {
        helper('form');

        echo view('templetes/header');
        echo view('pages/'.$page);
        echo view('templetes/footer');
    }
    
    function save()  
    {
        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'account' => $this->request->getVar('account'),
            'phone' => $this->request->getVar('phone'),
        ];

        if($data['account'] == 'User'){
            $user = new UserModel();

            if($user->insert($data)){
                $_SESSION['success'] = "Register Successfully.";
                // $session = session();
                // $session->setFlashdata('success','Successfully Register');
                // return redirect()->to('/login');
                echo view('templetes/header');
                echo view('pages/login');
                echo view('templetes/footer');
            } else {
                var_dump($admin->errors());
            } 
        } elseif($data['account'] == 'Admin'){

            $admin = new AdminModel();

            if($admin->insert($data)){
                $_SESSION['success'] = "Register Successfully.";
                // $session = session();
                // $session->setFlashdata('success','Successfully Register');
                return redirect()->to('/login');
                // echo view('templetes/header');
                // echo view('pages/login');
                // echo view('templetes/footer');
            } else {
                var_dump($admin->errors());
            } 
    }
    }

    function login()
    {

    }
}