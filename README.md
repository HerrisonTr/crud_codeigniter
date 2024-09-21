# FIOSYS Gerenciamento de usuários - CodeIgniter 4

Este projeto é um sistema de gerenciamento de usuários desenvolvido como parte de um processo seletivo. Ele foi implementado utilizando o framework **CodeIgniter 4** e **PHP 8.2**. O sistema oferece funcionalidades de CRUD (Criar, Ler, Atualizar e Deletar) de usuários, com autenticação básica e um layout integrado utilizando o template **AdminLTE v3**.

## Tecnologias Utilizadas

- **PHP** 8.2
- **CodeIgniter 4**
- **MySQL** (ou qualquer outro banco de dados compatível com CodeIgniter)
- **HTML/CSS** com templates para o front-end
- **Migrations e Seeders** para gerenciar a base de dados

## Funcionalidades

- **Listar Usuários**: Exibe uma lista de usuários cadastrados.
- **Cadastrar Usuário**: Permite o cadastro de novos usuários.
- **Editar Usuário**: Possibilita a edição dos dados de usuários existentes.
- **Deletar Usuário**: Remove usuários do sistema.
- **Autenticação Básica**: Apenas usuários autenticados podem acessar as rotas protegidas.
- **Tipos de Perfil de Usuário**: O sistema permite definir perfis de usuário como `admin` ou `guest`. Usuários com perfil `guest` podem apenas visualizar a lista de usuários.
- **Layout Dinâmico**: Foi criado um template no `BaseController` para facilitar a integração de layout em todas as páginas e evitar repetição de código.

## Requisitos

- **PHP 8.2** ou superior
- **Composer**
- **Banco de Dados** MySQL ou outro compatível

## Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/seu-usuario/nome-do-repositorio.git
   ```

2. **Instale as dependências com o Composer:**
   ```bash
   composer install
   ```

3. **Configure o banco de dados:**

    - Copie o arquivo 'env' para '.env':
    ```bash
    cp .env.example .env
    ```

    - No arquivo .env, configure os detalhes de conexão do banco de dados
    ```bash
    database.default.hostname = localhost
    database.default.database = nome_do_banco
    database.default.username = seu_usuario
    database.default.password = sua_senha
    database.default.DBDriver = MySQLi
    ```
    
4. **Configure a URL do sistema em `app/config/app.php` na variável `$baseURL`:**
    ```bash
    public string $baseURL = 'http://localhost:8080/';
    ```
    
    
5. **Execute as migrations e seeders:**
    
    - Para criar as tabelas necessárias:
    ``` bash
    php spark migrate
    ```
    - Para popular a tabela de usuários com usuários chaves:
    ``` bash
    # ADMINISTRADOR
    # Login: admin@admin.com 
    # Senha: admin
    
    # CONVIDADO
    # Login: guest
    # Senha: guest
    
    php spark db:seed UsersSeeder
    ``` 

6. **Inicie o servidor de desenvolvimento:**
      ```bash
       php spark serve
      ```
    
## Layout
O layout do sistema foi construído utilizando o template AdminLTE v3. O AdminLTE é um painel de administração totalmente responsivo e gratuito, desenvolvido em Bootstrap 4. Para mais informações, acesse: [AdminLTE v3](https://adminlte.io/)

## Usuários criados
Após rodar as seeders, um usuário administrador será criado automaticamente. Use as seguintes credenciais para acessar o sistema:

- **Usuário administrador**
    - Usuário: admin@admin.com
    - Senha: admin

- **Usuário convidado**
    - Usuário: guest@guest.com
    - Senha: guest
