<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\BlogModel;
use App\Models\Image;
use App\Models\ContactModel;
use App\Controllers\Login;


class User extends Controller
{
    public $CI = NULL;

    public function index()
    {   
        $getAll = new BlogModel();

        $sql = "select * from blog inner join image on blog.bid = image.bid where blog.status=1 group by image.bid order by blog.bid";
        // $data['all_data'] = $getAll->where('status', 1)->paginate(10);
        $data['all_data'] = $getAll->query($sql);
        
        // $data['pagination_link'] = $getAll->pager;

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
        $getImg = new Image();

        $sql = "select * from blog inner join image on blog.bid = image.bid where blog.uid='".$id."' group by image.bid order by blog.bid";

        $data['post'] = $getImg->query($sql);
        
        // $data['pagination_link'] = $getPost->pager;

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
            'b_description' => $this->request->getVar('description'),
            'addedBy' => $session->get('user')
        ];

        $post = new BlogModel();

        $post->insert($data);

        $id = $post->insertID();

        $addImg = new Image();

        $imgs = $this->request->getFiles();
        
        foreach($imgs['img'] as $img){
            $dataImg = [
                'img' => $img->move('./upload', $img->getName()),
                'img' =>  $img->getName(),
                'bid' => $id,
            ];
            $addImg->insert($dataImg);
        }     

        if(isset($post))
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

        $sql = "select * from blog inner join image on blog.bid = image.bid where blog.bid='".$id."' order by blog.bid";

        $data['detail'] = $detail->query($sql);
  
        return view('userview/detailpost', $data);
    }

    public function contactview()
    {
        return view('userview/contact');
    }

    public function contact()
    {
        $session = session();
        $name = $session->get('user');
        
        $contact = new ContactModel();

        $data = [
            "subject" => $this->request->getVar('subject'),
            "message" => $this->request->getVar('message'),
            "sendBy" => $name,
        ];

        if($contact->insert($data))
        {
            $session->set('send', 'Message Send Successfully.');
            return view("userview/contact");
        } else 
        {
            $session->set('unsend', 'Something Went Wrong.');
            return view("userview/contact");
        }
    }
}

?>