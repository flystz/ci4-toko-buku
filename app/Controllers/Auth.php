<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountModel;
use PDO;

class Auth extends BaseController
{
    protected $accountModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }
    public function login()
    {
        $data = [
            'title' => 'Login'
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('auth/register', $data);
    }

    public function createAccount()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[master_account.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'valid_email' => 'data yang diinput bukan email'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'confirm_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        if ($this->request->getVar('password') == $this->request->getVar('confirm_password')) {

            $passwordHash = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
            $this->accountModel->save([
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $passwordHash,
                'role' => 'admin',
            ]);
            session()->setFlashdata('alert', 'Akun berhasil dibuat, silahkan login');

            $data = [
                'title' => 'Login'
            ];

            return redirect()->to(base_url('/'));
        } else {
            session()->setFlashdata('alert-regist', 'password dan confirm password tidak sama');
            return redirect()->to(base_url('/auth/register'))->withInput();
        }
    }

    public function user()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/'))->withInput();
        }
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $record = $this->accountModel->getUsername($username);


        if (!$record == false) {
            if (password_verify($password, $record['password'])) {

                session()->set('account', $record);
                return redirect()->to(base_url('/dashboard'));
            } else {
                session()->setFlashdata('alert-login', 'password atau Username salah');
                return redirect()->to(base_url('/'))->withInput();
            }
        } else {
            session()->setFlashdata('alert-login', 'password atau Username salah');
            return redirect()->to(base_url('/'))->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
