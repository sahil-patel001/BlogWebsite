<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        return view('adminview/post');
    }

    public function management(){
        return view('adminview/manageUser');
    }

    public function contact(){
        return view('adminview/messagesFromUser');
    }
}

?>