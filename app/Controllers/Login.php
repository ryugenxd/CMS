<?php
namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController {
   public function index() {
      return view('login');
   }

   public function login() {
      $model = new UserModel();
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');
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
   }

   public function logout() {
      session()->destroy();
      return redirect()->to('/');
   }
}
