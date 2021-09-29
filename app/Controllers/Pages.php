<?php

namespace App\Controllers;

// session_start();

use App\Models\UserModel;
use App\Models\AdminModel;

class Pages extends BaseController
{
    public function index()
    {
        helper(['form']);

        return view('pages/signup');
    }

    public function signup()
    {
        helper(['form']);

        return view('pages/signup');
    }

    public function login()
    {
        helper(['form']);

        return view('pages/login');
    }

    public function logout()
    {
        $session = session();
        $session->remove('user');
        $session->remove('admin');
        $session->remove('success');

        return view('pages/login');
    }
    
    function save()  
    {
        $session = session();

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'account' => $this->request->getVar('account'),
            'phone' => $this->request->getVar('phone'),
        ];

        if($data['account'] == 'User'){
            $session->set('account',$data['account']);
            $user = new UserModel();

            if($user->insert($data)){
                $session->set('success','Register Successfully.');

                return redirect()->to('/login');

            } else {
                var_dump($admin->errors());
            } 
        } elseif($data['account'] == 'Admin'){

            $admin = new AdminModel();

            if($admin->insert($data)){
                $session->set('success','Register Successfully.');
                
                return redirect()->to('/login');

            } else {
                var_dump($admin->errors());
            } 
        }
    }
}