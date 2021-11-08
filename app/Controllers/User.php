<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\BlogModel;
use App\Models\UserModel;
use App\Models\Image;
use App\Models\LikeModel;
use App\Models\ContactModel;
use App\Models\LoginModel;
use App\Models\ReportModel;
use App\Controllers\Login;

class User extends Controller
{
    public function index()
    { 
        $session = session();
        $getAll = new BlogModel();
        $like = new LikeModel();

        $sql = "SELECT *,blog_post.bid,blog_post.uid,CEILING(COUNT(totallike.likeid) / COUNT(DISTINCT blog_image.img_id)) AS total, IF(COUNT(likebtn.likeid)>0, 'Yes', 'No') AS islike FROM blog_post INNER JOIN blog_image ON blog_post.bid = blog_image.bid INNER JOIN user ON blog_post.uid = user.uid LEFT JOIN blog_likebtn AS totallike ON totallike.bid=blog_post.bid LEFT JOIN blog_likebtn AS likebtn ON likebtn.bid=blog_post.bid AND likebtn.uid=".$session->get('id')." WHERE blog_post.status='approved' GROUP BY totallike.bid,blog_image.bid ORDER BY total DESC";
        
        $data['all_data'] = $getAll->query($sql);
        
        return view('userview/listofpost', $data);
    }

    public function likedpost()
    {
        $session = session();
        $getAll = new BlogModel();
        $like = new LikeModel();

        $sql = "SELECT *, CEILING(COUNT(totallike.likeid) / COUNT(DISTINCT blog_image.img_id)) AS total, IF(COUNT(blog_likebtn.likeid)>0, 'Yes', 'No') AS islike FROM blog_post INNER JOIN blog_image ON blog_image.bid=blog_post.bid INNER JOIN user ON user.uid=blog_post.uid INNER JOIN blog_likebtn AS totallike ON totallike.bid=blog_post.bid INNER JOIN blog_likebtn ON blog_likebtn.uid=".$session->get('id')." AND blog_post.bid=blog_likebtn.bid WHERE blog_post.status='approved' GROUP BY blog_image.bid ORDER BY total DESC";
        
        $data['liked_post'] = $getAll->query($sql);
        
        return view('userview/likedPost', $data);
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

        if(!empty($id)){
            $sql = "select * from blog_post inner join blog_image on blog_post.bid = blog_image.bid where blog_post.uid='".$id."' group by blog_image.bid order by blog_post.created desc";

            $data['post'] = $getImg->query($sql);

            return view('userview/poststatus', $data);
        } else {
            $session->set('error','Something Went Wrong.');
            return view('userview/poststatus', $data);
        }
    }

    // public function upload_image()
    // {
    //     $config = array(
    //         'upload_path' => FCPATH . 'assets/images/',
    //         'allowed_types' => "jpeg|jpg|png",
    //     );

    //     $this->load->library('upload');
    //     $this->upload->initialize($config);
    //     if($this->upload->do_upload('img')) {
    //         $data = $this->upload->data();

    //         $config2 = array(
    //             'image_library' => "gd2",
    //             'source_image' => FCPATH . 'assets/images/'.$data['file_name'],
    //             'width' => 100,
    //             'height' => 100,
    //             'new_image' => FCPATH . 'assets/thumbs/'.'thumb'. $data['file_name'],
    //         );

    //         $this->load->library('image_lib');
    //         $this->image_lib->initialize($config2);
    //         $this->image_lib->resize();
    //         $this->image_lib->clear();

    //         $arr_data['img'] = $data['file_name'];
    //         $result = $this->Image->update_image($arr_data);
    //     }
    // }

    public function save() 
    {
        $session = session();
        helper(['form', 'url']);

        $data = [
            'uid' => $session->get('id'),
            'b_title' => $this->request->getVar('title'),
            'b_description' => $this->request->getVar('description'),
        ];

        $post = new BlogModel();    

        $post->insert($data);

        $id = $post->insertID();

        $addImg = new Image();

        $imgs = $this->request->getFiles();

        if(!empty($imgs)){
            foreach($imgs['img'] as $img){
                // $dataThub = array(
                //     'image_library' => "gd2",
                //     'create_thumb' => TRUE,
                //     'maintain_ratio' => TRUE,
                //     'width' => 100,
                //     'height' => 100,
                //     'img' => $img->move('./thumb',$img->getName()),
                // );
                // $this->load->library('image_lib');
                // $this->image_lib->initialize($config2);
                // $this->image_lib->resize();
                // $this->image_lib->clear();

                //  $image = \Config\Services::image()
                //   ->withFile($img)
                //   ->resize(100, 100, true, 'height')
                //   ->save(FCPATH .'/thumb/'. $img->getRandomName());
                $imgName = $img->getName().date('Y-m-d H:i:s');
                $dataImg = [
                    'img' => $img->move('./upload', $imgName),
                    'img' =>  $img->getName(),
                    'bid' => $id,
                ];
                $addImg->insert($dataImg);
            }     

            if(isset($post))
            {
                return TRUE;
                // echo json_encode(array(
                //     "statusCode"=>200
                // ));
            }
            else
            {
                $session->set('err','Something Went Wrong.');
                return view('userview/addpost');
            }
        } else {
            $session->set('err','Something Went Wrong.');
            return view('userview/addpost');
        }
    }

    // public function tp()
    // {
    //     return view('info');
    // }

    public function detail()
    {
        $session = session();
        $id = $_GET['id'];

        $detail = new BlogModel();

        if(!empty($id)){
            $sql = "select * from blog_post inner join blog_image on blog_post.bid = blog_image.bid inner join user on blog_post.uid = user.uid where blog_post.bid='".$id."' order by blog_post.bid";

            $data['detail'] = $detail->query($sql);
    
            return view('userview/detailpost', $data);
        } else {
            $session->set('err','something went wrong.');
            return redirect()->to('user/poststatus');
        }
    }

    public function contactview()
    {
        return view('userview/contact');
    }

    public function sendMessage()
    {
        $contact = new ContactModel();
        $session = session();
        $uid = $session->get('id');

        $data = [
            "subject" => $this->request->getPost('subject'),
            "message" => $this->request->getPost('message'),
            'uid' => $uid,
        ];

        if(empty($data['subject']) || empty($data['message']))
        {
            return false;
        } else {
            if($contact->insert($data))
            {
                echo json_encode(array(
                    "statusCode"=>200
                ));
            }
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $blog = new BlogModel();
        $img = new Image();

        if(!empty($id)){
            $sql = "SELECT * FROM blog_post WHERE bid='".$id."'";
            $data['post'] = $blog->query($sql)->getResultArray();

            $sql = "SELECT * FROM blog_image WHERE bid='".$id."'";
            $data['img'] = $img->query($sql)->getResultArray();
            
            return view('userview/editblog', $data);
        } else {
            $session->set('err','something went wrong.');
            return redirect()->to('user/poststatus');
        }
    }

    // public function update($any)
    // {
        
    //     $modal = new Student();
	// 	$data['user_data'] = $modal->where('id',$any)->first();
    //     //get the file name
    //     $file = $this->request->getFile('profile_pic');
    //     $name="";
    //     if(isset($file) && !empty($file))
    //     {
    //         $name = $file->getRandomName();
    //         // $file->move('uploads', $name);
            
    //     }

    //     $data = [
    //         'name'	=>	$this->request->getVar('name'),
    //         'surname'	=>	$this->request->getVar('surname'),
    //         'age'=>	$this->request->getVar('age'),
    //     ];
    //     if(isset($name) && !empty($name))
    //     {
    //         $data['profile_pic']= $name;
    //     }
    //     $modal->update($any,$data);
    //     $session = session();
    //     $session->setFlashdata("success", "Data has been updated successfully ...!!");
    //     return $this->response->redirect('/index');
    // }

    public function editpost()
    {
        $id = $_GET['id'];
        $blog = new BlogModel();
        $addImg = new Image();

        $data = [
            'b_title' => $this->request->getvar('title'),
            'b_description' => $this->request->getvar('description'),
            // 'updated' => date('Y-m-d H:i:s'),
        ];

        if(!empty($id)){
            $sql = "UPDATE blog_post SET b_title='".$data['b_title']."', b_description='".$data['b_description']."' where bid='".$id."'";

            $blog->query($sql);

            $imgs = $this->request->getFiles("img");

            if(!empty($imgs)){
                foreach($imgs['img'] as $img){
                    $imgName = $img->getName().date('Y-m-d H:i:s');
                    $dataImg = [
                        'bid' => $id,
                        'img' => $img->move('./upload', $imgName),
                        'img' =>  $img->getName(),
                        'updated' => date('Y-m-d H:i:s'),
                    ];
                    $addImg->insert($dataImg);     
                } 
            } else {
                $sql1 = "UPDATE blog_image SET updated='".$dataImg['updated']."' where bid='".$id."'";
                $addImg->query($sql1);
            }
            $session = session();
            $session->set('update','Post Edited Successfully.');
            //insert the data into db and show it on post status
            return redirect()->to('user/poststatus');
        } else {
            $session->set('err','something went wrong.');
            return redirect()->to('user/poststatus');
        }
    }

    public function deleteImage()
    {
        $session = session();
        $img_id = $_GET['id'];
        $bid = $_GET['bid'];
        $img = new Image();

        // for delete image from local folder
        if(!empty($img_id)){
            $dataFetch = "SELECT img FROM blog_image WHERE img_id=".$img_id."";
            
            $data = $img->query($dataFetch)->getResultArray();
            foreach($data as $file)
            {
                $imageFile = $file['img'];
                if(!empty($imageFile)){
                    if(file_exists("./upload/".$imageFile)){
                        unlink("./upload/".$imageFile);
                    }
                    else{
                        break;
                    }
                } else {
                    $session->set('error','something went wrong.');
                    return redirect()->to('user/edit?id='.$bid);
                }
            }
        

            if($img->delete(['img_id',$img_id]))
            {
                $session->set('deleteImg','Image Removed.');
                return redirect()->to('user/edit?id='.$bid);
            }
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('user/edit?id='.$bid);
        }
    }

    public function delete()
    {
        $session = session();
        $id = $_GET['id'];
        $blog = new BlogModel();
        $img = new Image();

        if(!empty($id)){
            $sql_blog = "DELETE FROM blog_post WHERE bid=".$id."";
            $sql_image = "DELETE FROM blog_image WHERE bid=".$id."";

            if($img->query($sql_image) && $blog->query($sql_blog))
            {
                $sql = "SELECT img FROM blog_image WHERE bid=".$id."";
                $data = $img->query($sql)->getResultArray();
                foreach($data as $img)
                {
                    $imageFile = $img['img'];
                    if(!empty($imageFile)){
                        if(file_exists("./upload/".$imageFile)){
                            unlink("./upload/".$imageFile);
                        }
                        else{
                            break;
                        }
                    } else {
                        $session->set('error','something went wrong.');
                        return redirect()->to('user/poststatus');
                    }
                }
                $session->set('delete','Blog Deleted Successfully.');
                return redirect()->to('user/poststatus');
            }
        }
    }

    public function like()
    {
        $like = new LikeModel();
        $session = session();
        $bid = $_GET['id'];
        $uid = $session->get('id');
        
        if(!empty($bid) && !empty($uid)){
            $sql = "select action from blog_likebtn where uid='".$uid."' and bid='".$bid."'";
            if(empty($like->query($sql)->getRow())){
                $sql1 = "insert into blog_likebtn(uid, bid) values('".$uid."', '".$bid."')"; 
                $like->query($sql1);
            } else {
                $like->where('bid',$bid)->where('uid',$uid)->delete();
            }
            return redirect()->to('user');
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('user');
        }
    }

    public function reportpost()
    {
        $session = session();
        $report = new ReportModel();

        $data = [
            'uid' => $session->get('id'),
            'reason' => $this->request->getPost('reason'),
            // 'created' => date('Y-m-d H:i:s'),
        ];

        if(!empty($data['uid']) && !empty($data['reason'])){
            $report->save($data);
            $message = ['status'=>'Post Reported Successfully.'];
            return $this->response->setJSON($message);
        } else {
            http_response_code(404);
            die();
        }
    }

    public function profile()
    {
        $session = session();
        $id = $session->get('id');
        $user = new UserModel();
        if(!empty($id)){
            $data['user'] = $user->where('uid',$id)->get();
            return view('userview/profile', $data);
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('user');
        }
    }

     public function update()
    {
        $id = $_GET['id'];

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'phone' => $this->request->getVar('phone'),
        ];

        $user = new UserModel();

        if(!empty($id)){
            $sql = "update user SET fname='".$data['fname']."', lname='".$data['lname']."', phone='".$data['phone']."' where uid='".$id."'";
            if($user->query($sql)){
                $session = session();
                $session->set('update','Update Successfully.');

                return redirect()->to('/User/profile');

            } else {
                var_dump($user->errors());
            }
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('/User/profile');
        }
    
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

        if(!empty($id)){
            $sql = "select password from user where uid = '".$id."'";

            $old = $user->query($sql)->getRow();
            $session = session();

            if(!empty($data['current'])){
                if($old->password == $data['current']){
                    if(!empty($data['new']) && !empty($data['confirm'])){
                        if($data['new'] == $data['confirm']) {
                            $password = md5($data['new']);
                            $sql = "update user SET password='".$password."',updated='".date('Y-m-d H:i:s')."' where uid='".$id."'";
                            $user->query($sql);
                            // $message = ['status'=>'Your password is changed successfully.'];
                            // return $this->response->setJSON($message);
                            $session->set('change', 'Your password is changed successfully.');
                            return redirect()->to('user/profile');
                        } else {
                            $session->set('new', 'confirm password didn\'t match');
                            return redirect()->to('user/password');
                        }
                    } else {
                        $session->set('empty', 'Please enter new and confirm password.');
                        return redirect()->to('user/password');
                    }
                } else {
                    $session->set('match', 'current password is wrong');
                    return redirect()->to('user/password');
                } 
            } else {
                $session->set('current','Please enter current password.');
                return redirect()->to('/User/password');
            }
        } else {
            $session->set('error','something went wrong.');
            return redirect()->to('/User/password');
        }
    }
}

?>