<?php
namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController {
    public function __construct(){
        helper('cookie');
        $this->userModel = new UserModel();
        // Autentikasi pengguna berdasarkan cookie "remember_token"
        $rememberToken = get_cookie('remember_token');
        if ($rememberToken){
                $user = $this->userModel->getUserByRememberToken($rememberToken);
                if ($user) {
                    session()->set([
                    'user_id' => $user['id'],
                    'logged_in' => true
                    ]);
                }
        }
    }
   public function index() {
      return view('login');
   }

   public function login() {
      $model = new UserModel();
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');
      $remember = $this->request->getPost('remember');
      $data = $model->where('username', $username)->first();
      if($data) {
         $pass = $data['password'];
         $verify_pass = password_verify($password, $pass);
         if($verify_pass) {
            $ses_data = [
               'user_id' => $data['id'],
               'user_name' => $data['username'],
               'user_email' => $data['email'],
               'logged_in' => TRUE
            ];
            session()->set($ses_data);
            return redirect()->to('/dashboard');
         } else {
            session()->setFlashdata('msg', 'Wrong Password');
            return redirect()->to('/');
         }
      } else {
         session()->setFlashdata('msg', 'Username not Found');
         return redirect()->to('/');
      }
      // Jika checkbox "remember" dicentang, buat cookie "remember_token"
    if ($remember) {
        $length = 32;
        $token = bin2hex(random_bytes($length));
        $this->userModel->updateRememberToken($user['id'], $token);
        set_cookie('remember_token', $token, 3600*24*30); // Cookie akan kadaluarsa setelah 30 hari
    }
   }

   public function logout() {
      session()->destroy();
      return redirect()->to('/');
   }
}
