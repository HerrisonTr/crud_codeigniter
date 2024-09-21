<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> FIOSYS - Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="FIOSYS - Controle de usuários">
    <meta name="author" content="Herrison Trugilho">
    <meta name="description" content="O FIOSYS foi desenvolvimento para a participação de um processo seletivo.">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css'); ?>">
</head>

<body class="login-page" cz-shortcut-listen="true" style="min-height: 466px;">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1 class="h1"><b>FIOSYS</b></h1>
                <span class="text-muted"> Seu sistema de cadastro de usuários </span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Faça login para continuar</p>
                <?= form_open('/login', ['method' => 'POST']) ?>

                <?php if (isset($_GET['logout'])) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar alerta">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <span><i class="icon fas fa-check"></i> Você foi desconectado com sucesso</span>
                    </div>
                <?php endif;

                if (session()->has('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar alerta">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <span> <i class="icon fas fa-ban"></i> <?= session('error') ?></span>
                    </div>
                <?php endif ?>

                <div class="input-group mb-3">
                    <input type="email" value="<?= old('email') ?>" name="email" class="form-control" placeholder="Email" aria-placeholder="Digite seu email para fazer login no sistema">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" value="<?= old('password') ?>" name="password" class="form-control" placeholder="Senha" aria-placeholder="Digite sua senha para fazer login no sistema">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block"> Acessar </button>
                <?= form_close() ?>
            </div>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script>

</body>

</html>