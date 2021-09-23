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
                $_SESSION['user'] = $user['fname'];
                $username = $_SESSION['user'];
                return view('profiles/userprofile');
            
            }else{
                $_SESSION['msg'] = 'Password is incorrect.';
                return redirect()->to('/login');
            }

        }elseif(!empty($admin)){
            $pass = $admin['password'];

            $authenticatePassword = ($password == $pass ? true : false);

            if($authenticatePassword){
                $_SESSION['admin'] = $admin['fname'];
                $adminname = $_SESSION['admin'];
                return redirect()->to('profiles/adminprofile');
            
            }else{
               
                return redirect()->to('/login');
            }

        }else{
            // $session->setFlashdata('msg', 'Email does not exist.');
            $_SESSION['msg'] = 'Email does not exits.';
            return redirect()->to('/login');
        }
    }
}