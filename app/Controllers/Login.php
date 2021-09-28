<?php 

namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdminModel;



class Login extends Controller
{
    public function loginAuth(){
        $session = session();

        $userModel = new UserModel();
        $adminModel = new AdminModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');   
        
        $user = $userModel->where('email', $email)->first();
        $admin = $adminModel->where('email', $email)->first();
        
        if(!empty($user)){
            $pass = $user['password'];
           
            $authenticatePassword = ($password == $pass ? true : false);

            if($authenticatePassword){

                $session->set('id',$user['uid']);
                $session->set('user',$user['fname']);
                return redirect()->to('user');
            
            }else{
                $session->set('msg','Password is incorrect.');

                return redirect()->to('/login');
            }

        }elseif(!empty($admin)){
            $pass = $admin['password'];

            $authenticatePassword = ($password == $pass ? true : false);

            if($authenticatePassword){
                
                $session->set('id',$admin['aid']);
                $session->set('admin',$admin['fname']);
                return redirect()->to('admin');
            
            }else{
                $session->set('msg','Password is incorrect.');

                return redirect()->to('/login');
            }

        }else{
            $session->set('msg','Email does not exits.');
            
            return redirect()->to('/login');
        }
    }
}