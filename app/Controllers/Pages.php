<?php

namespace App\Controllers;

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
        $session->remove('add');

        return view('pages/login');
    }
    
    function save()  
    {
        $session = session();

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'password' => md5($this->request->getVar('password')),
            'account' => $this->request->getVar('account'),
            'phone' => $this->request->getVar('phone'),
            // 'created' => date('Y-m-d H:i:s'),
        ];

        if($data['account'] == 'User'){
            $session->set('account',$data['account']);
            $user = new UserModel();

            if($user->insert($data)){
                $session->set('success','Register Successfully.');

                if($session->get('add') ){
                    return redirect()->to('admin/management');  
                } else{

                return redirect()->to('/login');
                }

            } else {
                var_dump($admin->errors());
            } 
        } elseif($data['account'] == 'Admin'){

            $admin = new AdminModel();

            if($admin->insert($data)){
                $session->set('success','Register Successfully.');

                if($session->get('add') ){
                    return redirect()->to('admin/management');  
                } else{
                
                return redirect()->to('/login');
                }

            } else {
                var_dump($admin->errors());
            } 
        }
    }
}