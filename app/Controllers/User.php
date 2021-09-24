<?php

namespace App\Controllers;
session_start();
use CodeIgniter\Controller;
use App\Models\BlogModel;
use App\Controllers\Login;


class User extends Controller
{
    public function index()
    {
        return view('userview/listofpost');
    }

    public function addpost()
    {
        return view('userview/addpost');
    }

    public function poststatus()
    {
        return view('userview/poststatus');
    }

    public function save() 
    {
        helper(['form', 'url']);

        $img = $this->request->getFile('img');
        // $img->move(WRITEPATH . 'uploads');
        // if(isset($_SESSION['id'])){
        //     $id = $_SESSION['id'];
        // }
            //TODO: use session for get the user id and pass it into data
        $data = [
            'uid' => $this->session->userdata('uid'),
            'b_title' => $this->request->getVar('title'),
            'b_image' =>  $img->getName(),
            'b_description' => $this->request->getVar('description')
        ];

        print_r($data);
        die();

        $post = new BlogModel();

        if($post->insert($data))
        {
            $_SESSION['post'] = 'Post Created Successfully.';
            return view('userview/listofpost');
        } 
        else
        {
            $_SESSION['err'] = 'Something Went Wrong.';
            return view('userview/listofpost');
        }
    }
}

?>