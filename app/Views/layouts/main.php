<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> <?= $data['title'] ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="FIOSYS - Controle de usuários">
    <meta name="author" content="Herrison Trugilho">
    <meta name="description" content="O FIOSYS foi desenvolvimento para a participação de um processo seletivo.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->

    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css'); ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?= view('layouts/sidebar', $data); ?>

        <?= view('layouts/navbar', $data); ?>

        <!-- Aqui será carregado o conteúdo dinâmico da página -->
        <main class="content-wrapper p-4">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar alerta">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h5><i class="icon fas fa-check"></i> Sucesso!</h5>

                    <span><?= session('success') ?></span>
                </div>
            <?php endif;
            if (session()->has('errors')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar alerta">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        <?php foreach (session('errors') as $error) : ?>
                            <li> <i class="icon fas fa-ban"></i> <?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
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

            <?= $content; ?>
        </main>

        <!-- Main Footer -->
        <footer class="main-footer d-flex justify-content-between flex-column flex-sm-row">
            <div>
                <strong>Tema por <a href="https://adminlte.io"> AdminLTE.io</a>.</strong>
                &copy; 2014-2021 | Todos os direitos reservados
            </div>
            <div class="d-block d-sm-inline-block ">
                Sistema desenvolvido com <i class="bi bi-heart-fill text-danger"></i> por Herrison Trugilho
            </div>
        </footer>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('/assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('/assets/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/adminlte.min.js'); ?>"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
</body>

</html>