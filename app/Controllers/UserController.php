<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use SebastianBergmann\Template\Template;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Redireciona para a página inicial de usuários com a lista de usuários     
     */
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return $this->template('/users/index', $data);
    }

    /**
     * Redireciona para a página de cadastrar usuário     
     */
    public function create()
    {
        return $this->template('users/create');
    }

    /**
     * Redireciona para a página de editar usuário  
     */
    public function edit(int $id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            return redirect()->to(base_url('/users'))->with('error', 'Usuário não encontrado');
        }

        return $this->template('users/edit', $data);
    }

    /**
     * Cadastra um usuário
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        // Valida os dados do formulário
        if (!$this->validateUserInput()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'profile_type' => $this->request->getPost('profile_type')
        ]);


        return redirect()->to(base_url('users/'))->with('success', 'Usuário cadastrado com sucesso');
    }

    /**
     * Atualiza um usuário
     *
     * @param integer $id -> ID do usuário a ser atualizado
     * @return RedirectResponse
     */
    public function update(int $id): RedirectResponse
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('/users'))->with('error', 'Usuário não encontrado');
        }

        if (!$this->validateUserInput($id)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Atualizando o usuário
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'profile_type' => $this->request->getPost('profile_type')
        ];

        // Se a senha foi enviada, criptografa e atualiza
        if ($this->request->getPost('password')) {
            $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $userData);

        return redirect()->back()->with('success', "O Usuário <b> {$user['name']} </b> foi atualizado.");
    }

    /**
     * Deleta um usuário
     *
     * @param integer $id -> ID do usuário a ser deletado
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('/users'))->with('error', 'Usuário não encontrado');
        }

        if ($id == session('id')) {
            return redirect()->to(base_url('/users'))->with('error', 'Você não pode deletar o seu próprio usuário');
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to(base_url('/users'))->with('success', 'Usuário deletado com sucesso!');
        }

        return redirect()->to(base_url('/users'))->with('error', 'Erro ao deletar o usuário');
    }

    /**
     * Valida os dados de entrada do formulário de usuários.
     *
     * @param integer|null $id
     * @return boolean
     */
    private function validateUserInput(int $id = null): bool
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[40]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'password' => $id ? 'permit_empty' : 'required' . '|max_length[8]|regex_match[/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])/]',
            'confirm_password' => 'permit_empty|matches[password]',
            'profile_type' => 'required|in_list[admin,guest]',
        ];

        $messages = [
            'name' => [
                'required' => 'O campo nome é obrigatório',
                'max_length' => 'O nome deve no máximo 40 caracteres',
            ],
            'email' => [
                'required' => 'O campo email é obrigatório',
                'valid_email' => 'Informe um email válido',
                'is_unique' => 'Esse email já está em uso',
            ],
            'password' => [
                'required' => 'O campo senha é obrigatório',
                'regex_match' => 'A senha deve conter pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 caractere especial',
            ],
            'confirm_password' => [
                'required' => 'Confirme a senha',
                'matches' => 'As senhas não coincidem',
            ],
            'profile_type' => [
                'required' => 'Selecione um perfil',
                'in_list' => 'Perfil inválido',
            ],
        ];

        return $this->validate($rules, $messages);
    }
}
