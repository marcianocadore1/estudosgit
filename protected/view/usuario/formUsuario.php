<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Usuário</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formUsuario" id="formUsuario" method="POST" class="form" role="form">
                <div class="row">
                    <div class="col-md-8">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" 
                               value="<?php if (isset($usuario)) echo $usuario['nome']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Digite o Login" 
                               value="<?php if (isset($usuario)) echo $usuario['login']; ?>" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a Senha" 
                               value="<?php if (isset($usuario)) echo $usuario['senha']; ?>" required minlength="6">
                    </div>
                </div>
                <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataCadastro = date('d/m/Y');
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="data">Data</label>
                        <input type="text" class="form-control" id="data" name="data"
                               value="<?php echo $dataCadastro ?>" disabled>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-success">Gravar</button>
                <button type="reset" class="btn btn-primary">Limpar</button>
            </form>
        </div>
    </div>
</div>
<script src="includes/js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.min.js" type="text/javascript"></script>

<script>
    $("#formUsuario").validate({
        rules: {
            nome: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            login: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            senha: {
                required: true,
                minlength: 6,
                maxlength: 20
            }
        },
        messages: {
            nome: {
                required: "Por favor, informe o Nome do Usuário",
                minlength: "O Nome deve ter pelo menos 3 caracteres",
                maxlength: "O Nome deve ter no máximo 50 caracteres"
            },
            login: {
                required: "Por favor, informe o Login",
                minlength: "O Login deve ter pelo menos 3 caracteres",
                maxlength: "O Login deve ter no máximo 20 caracteres"
            },
            senha: {
                required: "Por favor, informe a Senha",
                minlength: "A Senha deve ter pelo menos 6 caracteres",
                maxlength: "A Senha deve ter no máximo 20 caracteres"
            }
        }
    });
</script>
