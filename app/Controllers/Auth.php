<?php namespace App\Controllers;
 
use App\Models\Auth_model;
 
class Auth extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        $this->cek_login();
        $this->auth_model = new Auth_model();
	}
    
    public function index()
    {
        if($this->cek_login() == TRUE){
			return redirect()->to(base_url('/dashboard'));
		}
        echo view('auth/login');
    }

    public function login()
    {
        if($this->cek_login() == TRUE){
			return redirect()->to(base_url('/dashboard'));
		}
        echo view('auth/login');
    }

    public function proses_login()
    {
        $validation =  \Config\Services::validation();

        $email  = $this->request->getPost('email');
        $pass   = $this->request->getPost('password');

        $data = [
            'email' => $email,
            'password' => $pass
        ]; 

        if($validation->run($data, 'authlogin') == FALSE){
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/auth/login'));
        } else {

            $cek_login = $this->auth_model->cek_login($email);

            // email didapatkan
            if($cek_login == TRUE){

                // jika email dan password cocok
                if(password_verify($pass, $cek_login['password'])){

                    session()->set('email', $cek_login['email']);
                    session()->set('name', $cek_login['name']);
                    session()->set('level', $cek_login['level']);
                    session()->set('status', $cek_login['status']);
                    
                    return redirect()->to(base_url('dashboard'));          
                // email cocok, tapi password salah
                } else {
                    session()->setFlashdata('errors', ['' => 'Password yang Anda masukan salah']);
                    return redirect()->to(base_url('/auth/login'));
                }
            } else {
                // email tidak cocok / tidak terdaftar
                session()->setFlashdata('errors', ['' => 'Email yang Anda masukan tidak terdaftar']);
                return redirect()->to(base_url('auth/login'));
            }
        }
    }

    public function register()
    {
        if($this->cek_login() == TRUE){
			return redirect()->to(base_url('dashboard'));
		}
        return view('auth/register');
    }

    public function proses_register()
    {
        $validation =  \Config\Services::validation();

        $data = [
            'email'             => $this->request->getPost('email'),
            'name'              => $this->request->getPost('name'),
            'username'          => $this->request->getPost('username'),
            'password'          => $this->request->getPost('password'),
            'confirm_password'  => $this->request->getPost('confirm_password')
        ];

        if($validation->run($data, 'authregister') == FALSE){
            session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('inputs', $this->request->getPost());
            return redirect()->to(base_url('auth/register'));
        } else {

            $datalagi = [
                'email'         => $this->request->getPost('email'),
                'name'          => $this->request->getPost('name'),
                'username'      => $this->request->getPost('username'),
                'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status'        => "Active",
                'level'         => "Admin"
            ];

            $simpan = $this->auth_model->register($datalagi);

            if($simpan){
                session()->setFlashdata('success_register', 'Register Successfully');
                return redirect()->to(base_url('auth/login'));
            }

        }

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }
}