<section>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center"> Cadastro de usuários </h3>
        </div>
        <div class="card-body">
            <?= form_open(base_url('/users/store'), ['id' => 'formulario-cadastro', 'method' => 'post']) ?>
            <div class="row mb-3">
                <label for="nome" class="col-sm-2 col-form-label"> Nome </label>
                <div class="col-sm-10">
                    <input value="<?= old('name') ?>" type="text" class="form-control" maxlength="40" id="nome" name="name" placeholder="Nome do usuário a ser cadastrado" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input value="<?= old('email') ?>" type="email" class="form-control" maxlength="40" id="email" name="email" placeholder="E-mail do usuário a ser cadastrado" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="senha" class="col-sm-2 col-form-label"> Senha </label>
                <div class="col-sm-10">
                    <input value="<?= old('password') ?>" type="password" class="form-control" name="password" id="senha" placeholder="Senha para acessar o sistema" autocomplete="off" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="confirmacao-senha" class="col-sm-2 col-form-label"> Confirme a senha </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="confirm_password" id="confirmacao-senha" placeholder="Confirme a senha" autocomplete="off" required>
                    <div class="invalid-feedback" id="erro-senha">
                        As senhas não coincidem.
                    </div>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"> <b> Perfil </b> </legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="profile_type" id="perfil-administrador" value="admin" checked>
                        <label class="form-check-label" for="perfil-administrador">
                            Administrador
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="profile_type" id="perfil-convidado" value="guest">
                        <label class="form-check-label" for="perfil-convidado">
                            Convidado
                        </label>
                    </div>
                </div>
            </fieldset>

            <?= form_close() ?>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary"> Cancelar </a>
                <button type="submit" class="btn btn-primary" form="formulario-cadastro"> Cadastrar </button>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        $('#formulario-cadastro').on('submit', function(event) {
            let senha = $('#senha').val();
            let confirmaSenha = $('#confirmacao-senha').val();

            removeErroSenha()

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

            // Regex para verificar a complexidade da senha
            // Verifica se a senha contém pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial
            let senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]/;

            if (!senhaForte.test(senha)) {
                event.preventDefault();
                adicionaErroSenha('A senha deve conter pelo menos 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caractere especial.')
            }
        });

        // Ocultar erro quando o usuário começar a digitar na confirmação da senha
        $('#confirmacao-senha, #senha').on('input', function() {
            removeErroSenha()
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
</script>