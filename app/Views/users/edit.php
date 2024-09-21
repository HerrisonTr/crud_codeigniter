<section>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">Editar Usuário</h3>
        </div>
        <div class="card-body">
            <?= form_open("/users/update/{$user['id']}", ['id' => 'formulario-edicao', 'method' => 'post'], ['_method' => 'PUT']) ?>

            <div class="row mb-3">
                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input value="<?= old('name', $user['name']) ?>"
                        type="text"
                        class="form-control"
                        maxlength="40"
                        id="nome"
                        name="name"
                        placeholder="Nome do usuário"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input value="<?= old('email', $user['email']) ?>"
                        type="email"
                        class="form-control"
                        maxlength="40"
                        id="email"
                        name="email"
                        placeholder="E-mail do usuário"
                        required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input value="<?= old('password') ?>"
                            type="password"
                            class="form-control"
                            name="password"
                            id="senha"
                            autocomplete="off"
                            disabled
                            required>
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" aria-label="Clique para editar a senha" id="btn-editar-senha">
                                <i class="bi bi-unlock-fill" aria-hidden="true"></i>
                                Editar senha
                            </button>
                            <button class="btn btn-danger" type="button" aria-label="Clique para editar a senha" id="btn-cancelar-senha" style='display: none;'>
                                <i class="bi bi-lock-fill" aria-hidden="true"></i>
                                Cancelar editar senha
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="confirmacao-senha" class="col-sm-2 col-form-label">Confirme a senha</label>
                <div class="col-sm-10">
                    <input type="password"
                        class="form-control"
                        name="confirm_password"
                        id="confirmacao-senha"
                        autocomplete="off"
                        disabled
                        required>
                    <div class="invalid-feedback" id="erro-senha">As senhas não coincidem.</div>
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0 "> <b> Perfil </b> </legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input"
                            type="radio"
                            name="profile_type"
                            id="perfil-administrador"
                            value="admin"
                            <?= $user['profile_type'] == 'admin' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="perfil-administrador">Administrador</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="profile_type" id="perfil-convidado" value="guest" <?= $user['profile_type'] == 'guest' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="perfil-convidado">Convidado</label>
                    </div>
                </div>
            </fieldset>

            <?= form_close() ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary" form="formulario-edicao">Salvar Alterações</button>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {

        $('#formulario-edicao').on('submit', function(event) {
            let senha = $('#senha').val();
            let confirmaSenha = $('#confirmacao-senha').val();

            removeErroSenha()

            if ($('#senha').is(':disabled')) {
                return;
            }

            if (senha.length > 8) {
                event.preventDefault();
                adicionaErroSenha('A senha deve conter no máximo 8 caracteres.');
                return;
            }

            if (senha !== confirmaSenha) {
                event.preventDefault();
                adicionaErroSenha('As senhas não coincidem.');
                return;
            }

            // pelo menos 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.
            let senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

            if (!senhaForte.test(senha)) {
                event.preventDefault();
                adicionaErroSenha('A senha deve conter pelo menos 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.')
            }
        });

        $('#confirmacao-senha, #senha').on('input', function() {
            removeErroSenha()
        });

        // Evento de clique para alternar entre editar e cancelar senha
        $("#btn-editar-senha, #btn-cancelar-senha").on('click', function() {
            trocaEditarSenha();
        });
    });

    function adicionaErroSenha(erro) {
        $('#confirmacao-senha').addClass('is-invalid');
        $('#senha').addClass('is-invalid');

        $('#erro-senha').html(erro);
        $('#erro-senha').show();
    }

    function removeErroSenha() {
        $('#confirmacao-senha, #senha').removeClass('is-invalid');
        $('#erro-senha').hide();
    }

    function trocaEditarSenha() {
        let botaoEditarSenha = $("#btn-editar-senha");
        let botaoCancelarSenha = $("#btn-cancelar-senha");
        let inputSenha = $("#senha");
        let inputConfirmaSenha = $("#confirmacao-senha");

        if (inputSenha.is(':disabled')) {
            // Se o campo estiver desativado, habilita os campos e ajusta os botões
            botaoEditarSenha.hide();
            botaoCancelarSenha.show();
            inputSenha.prop('disabled', false);
            inputConfirmaSenha.prop('disabled', false);
        } else {
            // Caso contrário, desabilita os campos e ajusta os botões
            botaoCancelarSenha.hide();
            botaoEditarSenha.show();
            inputSenha.prop('disabled', true);
            inputConfirmaSenha.prop('disabled', true);
            inputSenha.val('')
            inputConfirmaSenha.val('')
        }
    }
</script>