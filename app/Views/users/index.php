<section>
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="bi bi-people-fill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Usuários cadastrados</span>
                    <span class="info-box-number"> <?= count($users) ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="bi bi-person-fill-gear"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Administradores</span>
                    <span class="info-box-number"> <?= array_count_values(array_column($users, 'profile_type'))['admin'] ?? 0 ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="bi bi-person-fill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Convidados</span>
                    <span class="info-box-number"><?= array_count_values(array_column($users, 'profile_type'))['guest'] ?? 0 ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-itens-center">
                <h3 class="card-title"> Usuários cadastrados </h3>
                <div class="d-flex justify-content-start justify-content-sm-end">
                    <?php if (session('isAdmin')) : ?>
                        <a href="<?= base_url('/users/create') ?>" class="btn btn-primary float-right" aria-label="Cadastrar usuário">
                            <i class="bi bi-person-fill-add" aria-hidden="true"></i> Cadastrar usuário
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="datatable">
                    <caption>Lista de usuários cadastrados</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="w-auto">Nome</th>
                            <th scope="col" class="w-auto">E-mail</th>
                            <th scope="col" class="w-auto">Perfil</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td> <?= $user['name'] ?> </td>
                                <td> <?= $user['email'] ?> </td>
                                <td> <?= $user['profile_type'] == 'admin' ? 'Administrador' : 'Convidado' ?> </td>
                                <td class="d-flex justify-content-center">
                                    <?php if (session('isAdmin')) : ?>

                                        <a class="btn btn-sm btn-warning mr-2"
                                            href="<?= base_url("users/edit/{$user['id']}") ?>"
                                            aria-label="Editar usuário <?= $user['name'] ?>">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>

                                        <?= form_open(
                                            "users/delete/{$user['id']}",
                                            [
                                                'method' => 'post',
                                                'class' => 'form-deletar-usuario d-inline'
                                            ],
                                            ['_method' => 'DELETE']
                                        ) ?>

                                        <?php if (session('id') != $user['id']) : ?>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-deletar-usuario"
                                                data-id="<?= $user['id'] ?>"
                                                data-nome="<?= $user['name'] ?>"
                                                aria-label="Deletar usuário <?= $user['name'] ?>">
                                                <i class="bi bi-trash-fill"></i>
                                                Deletar
                                            </button>
                                        <?php endif ?>
                                        <?= form_close() ?>
                                    <?php endif ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {

        $("#datatable").dataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
            },
            columnDefs: [{
                    orderable: false,
                    targets: 3
                } // Desativa a ordenação para a coluna "Ações"
            ]
        });

        const swalConfirmaDeletarUsuario = Swal.mixin({
            customClass: {
                actions: 'd-flex justify-content-between w-100 py-2 px-5',
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        $(".btn-deletar-usuario").click(function() {
            let nomeUsuario = $(this).data('nome');

            let formulario = $(this).closest("form");

            swalConfirmaDeletarUsuario.fire({
                title: "Deseja realmente deletar o usuário " + nomeUsuario + "?",
                text: "Essa ação não pode ser desfeita",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, tenho certeza!",
                cancelButtonText: "Não, quero cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    formulario.submit();
                }
            });
        });
    })
</script>