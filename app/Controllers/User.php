<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\BlogModel;
use App\Models\UserModel;
use App\Models\Image;
use App\Models\LikeModel;
use App\Models\ContactModel;
use App\Models\LoginModel;
use App\Controllers\Login;


class User extends Controller
{
    public function index()
    { 
        $session = session();
        $getAll = new BlogModel();
        $like = new LikeModel();

        $sql = "SELECT *,blog_post.bid,blog_post.uid,COUNT(totallike.likeid) AS total, IF(COUNT(likebtn.likeid)>0, 'Yes', 'No') AS islike FROM blog_post INNER JOIN blog_image ON blog_post.bid = blog_image.bid INNER JOIN user ON blog_post.uid = user.uid LEFT JOIN blog_likebtn AS totallike ON totallike.bid=blog_post.bid LEFT JOIN blog_likebtn AS likebtn ON likebtn.bid=blog_post.bid AND likebtn.uid=".$session->get('id')." WHERE blog_post.status='approved' GROUP BY totallike.bid,blog_image.bid ORDER BY blog_post.created DESC";
        // $sql = "select *,blog_post.bid,blog_post.uid,count(blog_likebtn.likeid) as total,IF(count(blog_likebtn.likeid)>0, 'Yes' ,'No') as islike from blog_post inner join blog_image on blog_post.bid = blog_image.bid inner join user on blog_post.uid = user.uid left join blog_likebtn on blog_post.bid=blog_likebtn.bid and blog_post.bid = blog_image.bid and blog_likebtn.uid='".$session->get('id')."' where blog_post.status='approved' group by blog_image.bid,blog_likebtn.bid order by blog_post.created desc";
        print_r($sql);
        die();
        $data['all_data'] = $getAll->query($sql);

        // print_r($data['all_data']);
        // die();
        
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

        $sql = "select * from blog_post inner join blog_image on blog_post.bid = blog_image.bid where blog_post.uid='".$id."' group by blog_image.bid order by blog_post.created desc";

        $data['post'] = $getImg->query($sql);

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
            'created' => date('Y-m-d H:i:s'),
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
                'created' => date('Y-m-d H:i:s'),
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

        $sql = "select * from blog_post inner join blog_image on blog_post.bid = blog_image.bid inner join user on blog_post.uid = user.uid where blog_post.bid='".$id."' order by blog_post.bid";

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
            'created' => date('Y-m-d H:i:s'),
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

    public function edit()
    {
        $id = $_GET['id'];
        $blog = new BlogModel();
        $img = new Image();

        $data['post'] = $blog->where('bid', $id)->findAll();
        $data['img'] = $img->where('bid', $id)->findAll();

        return view('userview/editblog', $data);
    }

    public function editpost()
    {
        $id = $_GET['id'];
        $blog = new BlogModel();
        $addI = new Image();

        $data = [
            'b_title' => $this->request->getvar('title'),
            'b_description' => $this->request->getvar('description'),
            'updated' => date('Y-m-d H:i:s'),
        ];

        $sql = "update blog_post SET b_title='".$data['b_title']."', b_description='".$data['b_description']."', updated='".$data['updated']."' where bid='".$id."'";

        $blog->query($sql);

        $imgs = $this->request->getFiles();
        foreach($imgs['img'] as $img){
            if(!empty($img)){
                $dataImg = [
                    'img' => $img->move('./upload', $img->getName()),
                    'img' =>  $img->getName(),
                    'updated' => date('Y-m-d H:i:s'),
                ];
                $sql1 = "update blog_image SET img = '".$dataImg['img']."', updated='".$dataImg['updated']."' where bid='".$id."'";
                $addI->query($sql1);
            }
        }  
        $session = session();
        $session->set('update','Post Edited Successfully.');
        //insert the data into db and show it on post status
        return redirect()->to('user/poststatus');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $img = new Image();
        $blog = new BlogModel();

        $sql = "delete from blog_post where bid='".$id."'";
        $sql1 = "delete from blog_image where bid='".$id."'";
        if($img->query($sql1) && $blog->query($sql)) {
            $session = session();
            $session->set('delete', 'Post Deleted Successfully.');
            //make the query for delete and redirect to the post status view.
            return redirect()->to('user/poststatus');
        }
    }

    public function like()
    {
        $like = new LikeModel();
        $session = session();
        $bid = $_GET['id'];
        $uid = $session->get('id');
        
        $sql = "select action from blog_likebtn where uid='".$uid."' and bid='".$bid."'";
        if(empty($like->query($sql)->getRow())){
            $sql1 = "insert into blog_likebtn(uid, bid) values('".$uid."', '".$bid."')"; 
            $like->query($sql1);
        } else {
            $like->where('bid',$bid)->where('uid',$uid)->delete();
        }
        return redirect()->to('user');
        die();
    }

    public function profile()
    {
        $session = session();
        $id = $session->get('id');
        $user = new UserModel();
        $data['user'] = $user->where('uid',$id)->get();
        return view('userview/profile', $data);
    }

     public function update()
    {
        $id = $_GET['id'];

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'password' => $this->request->getVar('password'),
            'phone' => $this->request->getVar('phone'),
        ];

        $user = new UserModel();

        $sql = "update user SET fname='".$data['fname']."', lname='".$data['lname']."', password='".$data['password']."', phone='".$data['phone']."' where uid='".$id."'";
        if($user->query($sql)){
            $session = session();
            $session->set('update','Update Successfully.');

            return redirect()->to('/User/profile');

        } else {
            var_dump($user->errors());
        }
    
    }

    public function addedBy()
    {
        $uid = $_GET['id'];
        $user = new UserModel();
    }

    public function password()
    {
        return view('userview/password');
    }

    public function changePassword()
    {
        $id = $_GET['id'];
        $user = new UserModel();

        $data = [
            'current' => md5($this->request->getVar('current')),
            'new' => $this->request->getVar('new'),
            'confirm' => $this->request->getVar('confirm'),
        ];

        $sql = "select password from user where uid = '".$id."'";

        $old = $user->query($sql)->getRow();
        $session = session();

        if($old->password == $data['current']){
            if($data['new'] == $data['confirm']) {
                $password = md5($data['new']);
                $sql = "update user SET password='".$password."' updated='".date('Y-m-d H:i:s')."' where uid='".$id."'";
                $user->query($sql);
                $session->set('change', 'Your password is changed successfully.');
                return redirect()->to('user/profile');
            } else {
                $session->set('new', 'confirm password didn\'t match');
                return redirect()->to('user/password');
            }
        } else {
            $session->set('match', 'current password is wrong');
            return redirect()->to('user/password');
        }
    }
}

?>