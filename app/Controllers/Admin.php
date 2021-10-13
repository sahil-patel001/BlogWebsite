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
        $sql = "SELECT * FROM blog_post INNER JOIN blog_image ON blog_post.bid=blog_image.bid GROUP BY blog_post.bid ORDER BY blog_post.bid DESC";
        $data['pending_post'] = $post->query($sql)->getResultArray();

        return view('adminview/post', $data);
    }

    public function userManagement()
    {
        $user = new UserModel();
        $data['all_user'] = $user->paginate(10);

        $data['pagination_link'] = $user->pager;

        return view('adminview/manageUser', $data);
    }

    public function adminManagement()
    {
        $session = session();
        $aid = $session->get('id');
        $admin = new AdminModel();
        if(!empty($aid)){
            $data['all_admin'] = $admin->where('aid !=',$aid)->paginate(10);

            $data['pagination_link'] = $admin->pager;

            return view('adminview/manageAdmin', $data);
        } else {
            $session->set('error','something went wrong.');
            return view('adminview/manageAdmin');
        }
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
        $session = session();
        $approve = new BlogModel();
        $id = $_GET['id'];

        if(!empty($id)){
            $sql = "update blog_post SET status='approved' where bid='".$id."'";
            $query=$approve->query($sql);

            return redirect()->to("/admin");
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('/admin/');
        }
    }

    public function decline()
    {
        $session = session();
        $decline = new BlogModel();
        $id = $_GET['id'];

        if(!empty($id)){
            $sql = "update blog_post SET status='rejected' where bid='".$id."'";
            $query=$decline->query($sql);

            return redirect()->to("/admin");
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('/admin/');
        }
    }

    public function fetchuser()
    {
        $user = new UserModel();
        $id = $_GET['id'];
        $data['user'] = $user->where('uid', $id)->findAll();

        return view('adminview/editUser', $data);
    }

    public function editUser()
    {
        $session = session();
        $id = $_GET['id'];

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'updated' => date('Y-m-d H:i:s'),
        ];

        $user = new UserModel();

            if(!empty($id)){
            $sql = "update user SET fname='".$data['fname']."', lname='".$data['lname']."', email='".$data['email']."', phone='".$data['phone']."', updated='".$data['updated']."' where uid='".$id."'";
            if($user->query($sql)){
                $session = session();
                $session->set('success','Update Successfully.');

                return redirect()->to('/admin/userManagement');

            } else {
                var_dump($user->errors());
            } 
        } else {
            $session->set('error','something went wrong.');
            return view('adminview/manageUser');
        }  
    }

    public function editAdmin()
    {
        $session = session();
        $id = $_GET['id'];

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'updated' => date('Y-m-d H:i:s'),
        ];

        $admin = new AdminModel();

            if(!empty($id)) {
            $sql = "update admin SET fname='".$data['fname']."', lname='".$data['lname']."', email='".$data['email']."', phone='".$data['phone']."', updated='".$data['updated']."' where aid='".$id."'";
            if($admin->query($sql)){
                $session = session();
                $session->set('success','Update Successfully.');

                return redirect()->to('/admin/adminManagement');

            } else {
                var_dump($admin->errors());
            } 
        } else {
            $session->set('error','something went wrong.');
            return view('adminview/manageAdmin');
        }
    }

    public function deleteuser()
    {
        $id = $_GET['id'];
        $user = new UserModel();

        if(!empty($id)) {
            $sql = "delete from user where uid='".$id."'";
            if($user->query($sql))
            {
                $session = session();
                $session->set('delete','Deleted Successfully.');

                return redirect()->to('/admin/userManagement');
            }
        } else {
            $session->set('error','something went wrong.');
            return view('adminview/manageUser');
        }
    }

    public function fetchadmin()
    {
        $admin = new AdminModel();
        $id = $_GET['id'];
        if(!empty($id)){
            $data['admin'] = $admin->where('aid', $id)->findAll();
            return view('adminview/editAdmin', $data);
        } else {
            $session->set('error','something went wrong.');
            return view('adminview/manageAdmin');
        }
    }

    public function deleteadmin()
    {
        $id = $_GET['id'];
        $admin = new AdminModel();

        if(!empty($id)){
            $sql = "delete from admin where aid='".$id."'";
            if($admin->query($sql))
            {
                $session = session();
                $session->set('delete','Deleted Successfully.');

                return redirect()->to('/admin/adminManagement');
            }
        } else {
            $session->set('error','something went wrong.');
            return view('adminview/manageAdmin');
        }
    }

    public function detail()
    {
        $id = $_GET['id'];
        $detail = new ContactModel();

        $sql = "select * from user_contact where cid='".$id."'";

        $data['detail'] = $detail->query($sql);
        
        return view('adminview/detail', $data);
    }

    public function addUser()
    {
        return view('adminview/addUser');
    }

    public function addAdmin()
    {
        return view('adminview/addAdmin');
    }

    public function detailpost()
    {
        $id = $_GET['id'];

        $detail = new BlogModel();

        $sql = "select * from blog_post inner join blog_image on blog_post.bid = blog_image.bid inner join user on blog_post.uid = user.uid where blog_post.bid='".$id."' order by blog_post.bid";

        $data['detail'] = $detail->query($sql);
  
        return view('adminview/detailpost', $data);
    }
}

?>