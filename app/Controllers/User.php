<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\BlogModel;
use App\Models\Image;
use App\Controllers\Login;


class User extends Controller
{
    public $CI = NULL;

    public function index()
    {   
        $getAll = new BlogModel();

        $data['all_data'] = $getAll->paginate(10);

        $data['pagination_link'] = $getAll->pager;

        return view('userview/listofpost', $data);
    }

    public function addpost()
    {
        return view('userview/addpost');
    }

    public function poststatus()
    {
        $session = session();

        $id = $session->get('id');
        $getPost = new BlogModel();

        $data['post_data'] = $getPost->where('uid', $id)->orderBy('bid')->paginate(2);

        $data['pagination_link'] = $getPost->pager;

        return view('userview/poststatus', $data);
    }

    public function save() 
    {
        $session = session();
        helper(['form', 'url']);

        $img = $this->request->getFile('img');

        $data = [
            'uid' => $session->get('id'),
            'b_title' => $this->request->getVar('title'),
            //TODO: make this image comented while using for multiple image and also chnage the type multiple and name in addpost.php
            'b_image' =>  $img->getName(),
            'b_description' => $this->request->getVar('description'),
            'addedBy' => $session->get('user')
        ];

        $post = new BlogModel();
        

        //TODO: find out the query for getting last inserted blog's id
        // $post->insert($data);

        // $id = $post->insertID();

        // $addImg = new Image();

        // $imgs = $this->request->getFiles();
        
        // foreach($imgs['img'] as $img){
        //     $dataImg = [
        //         'img' => $img->move('./upload', $img->getName()),
        //         'bid' => $id,
        //     ];
        //     print_r($dataImg);
        // }
        
        // die();

        if($post->insert($data))
        {
            $session->set('post','Post Created Successfully.');
            return redirect()->to('user/poststatus');
        }
        else
        {
            $session->set('err','Something Went Wrong.');
            return view('userview/addpost');
        }
    }

    public function detail()
    {
        $id = $_GET['id'];

        $detail = new BlogModel();

        $detail->select('*');
        $detail->where('bid',$id);
        $data['detail'] = $detail->get();
  
        return view('userview/detailpost', $data);
    }
}

?>