<?php

namespace App\Controllers;
use App\Models\BlogModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\ContactModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        $post = new BlogModel();
        $data['pending_post'] = $post->where('status',0)->orderBy('bid')->paginate(5);

        $data['pagination_link'] = $post->pager;

        return view('adminview/post', $data);
    }

    public function management()
    {
        $user = new UserModel();
        $data['all_user'] = $user->paginate(10);

        $data['pagination_link'] = $user->pager;

        return view('adminview/manageUser', $data);
    }

    public function contact()
    {
        $contact = new ContactModel();

        $data['receive_msg'] = $contact->paginate(10);
        $data['pagination_link'] = $contact->pager;

        return view('adminview/messagesFromUser', $data);
    }

    public function approve()
    {
        $approve = new BlogModel();
        $id = $_GET['id'];

        $sql = "update blog SET status='1' where bid='".$id."'";
        $query=$approve->query($sql);

        return redirect()->to("/admin");
    }

    public function decline()
    {

    }

    public function fetch()
    {
        $user = new UserModel();
        $id = $_GET['id'];
        $data['user'] = $user->where('uid', $id)->findAll();

        return view('adminview/editUser', $data);
    }

    public function edit()
    {
        $id = $_GET['id'];

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'account' => $this->request->getVar('account'),
            'phone' => $this->request->getVar('phone'),
        ];

        if($data['account'] == 'User'){
            $user = new UserModel();

            $sql = "update signup_user SET fname='".$data['fname']."', lname='".$data['lname']."', email='".$data['email']."', phone='".$data['phone']."' where uid='".$id."'";
            if($user->query($sql)){
                $session = session();
                $session->set('success','Update Successfully.');

                return redirect()->to('/admin/management');

            } else {
                var_dump($user->errors());
            } 
        } elseif($data['account'] == 'Admin'){

            $admin = new AdminModel();

            if($admin->insert($data)){
                $session = session();
                $session->set('success','Update Successfully.');
                //TODO: ask that what should do with user if it will become admin
                return redirect()->to('/admin/management');

            } else {
                var_dump($admin->errors());
            } 
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $user = new UserModel();

        $sql = "delete from signup_user where uid='".$id."'";
        if($user->query($sql))
        {
            $session = session();
            $session->set('delete','Deleted Successfully.');

            return redirect()->to('/admin/management');
        }
    }

    public function detail()
    {
        $id = $_GET['id'];
        $detail = new ContactModel();

        $sql = "select * from contact where cid='".$id."'";

        $data['detail'] = $detail->query($sql);
        
        return view('adminview/detail', $data);
    }
}

?>