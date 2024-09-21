<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list"></i></a>
        </li>
        <li class="mt-2">
           Seja bem-vindo(a) <?= session('name') ?>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?= form_open(base_url('logout'), ['method' => 'get']) ?>
            <button class="btn btn-secondary"
                aria-label="Clique para se desconectar do sistema" title="Desconectar"
                role="button">
                <i class="bi bi-box-arrow-left mr-1"></i> Sair
            </button>
            <?= form_close() ?>
        </li>
    </ul>
</nav>