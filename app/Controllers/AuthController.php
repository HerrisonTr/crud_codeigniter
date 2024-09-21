<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper('form');
    }

    /**
     * Exibe a página de login.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Processa o login do usuário.
     */
    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email || !$password) {
            return redirect()->to('/')->with('error', 'Email e senha são obrigatórios.');
        }

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Cria a sessão do usuário
            $this->setUserSession($user);
            return redirect()->to('/dashboard')->with('success', 'Login realizado com sucesso.');
        }

        return redirect()->to('/')->with('error', 'Email ou senha inválidos.');
    }

    /**
     * Define os dados do usuário na sessão.
     */
    private function setUserSession(array $user)
    {
        $sessionData = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'profile' => $user['profile_type'],
            'isLoggedIn' => true,
            'isAdmin' => $user['profile_type'] == 'admin',
        ];

        session()->set($sessionData);
    }

    /**
     * Realiza o logout do usuário.
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/?logout');
    }
}
