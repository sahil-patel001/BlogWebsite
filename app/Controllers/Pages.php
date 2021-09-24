<?php

namespace App\Controllers;

session_start();

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
        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        unset($_SESSION['success']);

        return view('pages/login');
    }

    // public function showme ($page = 'signup') 
    // {
    //     helper('form');

    //     if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php')) {
    //         // Whoops, we don't have a page for that!
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    //     }

    //     return view('pages/'.$page);
    // }
    
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

                return redirect()->to('/login');

            } else {
                var_dump($admin->errors());
            } 
        } elseif($data['account'] == 'Admin'){

            $admin = new AdminModel();

            if($admin->insert($data)){
                $_SESSION['success'] = "Register Successfully.";

                return redirect()->to('/login');

            } else {
                var_dump($admin->errors());
            } 
        }
    }
}