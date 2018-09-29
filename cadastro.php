<?php include("config/confloginrel.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Excluir Registro - Mensagem-->
        <script src="includes/js/jquery-1.11.3.js"></script>
        <script src="includes/js/jquery-ui.js"></script>
        <link rel="shortcut icon" type="image/png" href="includes/imagens/veiculo.png"/>
        <link rel="stylesheet" href="includes/css/jquery-ui.css" type="text/css" />

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Locadora Veículos</title>
        <link href="includes/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="includes/css/datatables.min.css">
        <link rel="stylesheet" href="includes/css/redmond/jquery-ui-1.10.1.custom.css">
        <script src="includes/js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="includes/js/jquery-ui.js" type="text/javascript"></script>
        <script src="includes/js/jquery.maskMoney.js" type="text/javascript"></script>
        <script src="includes/js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="includes/js/validarcampos.js" type="text/javascript"></script>
        

        <!-- Excluir Registro - Mensagem-->
        <script src="includes/js/jquery-1.11.3.js"></script>
        <script src="includes/js/jquery-ui.js"></script>
        <link rel="stylesheet" href="includes/css/jquery-ui.css" type="text/css" />

        <script src="includes/js/jquery.easy-confirm-dialog.js"></script>
        <style type="text/css">
            .error{
                color: red;
                font-size: 12px;
            }
            hr {
                color: blue;
                background-color: blue;
                height: 1px;
            }
            .navbar-default 
            .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{background-color: #FFB5C5}
            #menutitle{
                color: white;
            }
            .ui-datepicker .ui-datepicker-header {
                position: relative;
                padding: .2em 0;
                background-color: #3D5B99;
            }
            body {
                padding-top: 85px;
                width: 60%;
                margin-left: 18%;
                margin-right: 20%;
            }

            /*AtlantaJeans theme added*/
            .panel-primary>.panel-heading {
              color: #fff;
              background-color: #3D5B99;
              border-color: #3D5B99;
            }
            .panel-primary{
              border-color: #3D5B99;
              margin-left: 2%;
              margin-right: 2%;
            }
            a {
                color: #3D5B99;
                text-decoration: none;
            }
            .btn-primary {
                color: #fff;
                background-color: #5b2436;
                border-color: #f0dbe1;
            }
            hr {
                color: #f0dbe1;
                background-color: #f0dbe1;
                height: 1px;
            }
            #box{
                    width: 100px; 
                    height: 35px;
                    border-radius: 10px;
            }
            #imagesituationcerto{
                background-image: url(includes/imagens/certo.png);
                display: none;
                background-repeat: no-repeat;
            }
            #imagesituationerro{
                background-image: url(includes/imagens/erro.png);
                display: none;
                background-repeat: no-repeat;
            }
            #mensagemlabelerro{
                display: none;
                color: red;
            }
            #mensagemredirecionamento{
                color: #A44160;
                display: none;
            }
        </style>
    </head>
</head>
<body style="padding-top: 55px;">
    
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #3D5B99">
        <div class="container" style="padding-left: 0px">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style=" padding-left: 25px;"  id="menutitle">Locadora Veículos</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php"  id="menutitle">Home</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <?php
        date_default_timezone_set('America/Sao_Paulo');
        $dataCadastro = date('d/m/Y');
    ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Usuário</div>
        <div class="panel-body">
            <form action="cadastro.php" name="formUsuario" id="formUsuario" method="POST" class="form" role="form">
                <input type="hidden" name="datacadastrohidden" value="<?php echo $dataCadastro; ?>">
                <div class="row" id="mensagemredirecionamento">
                        <div class="col-md-10">
                            <label style="color: #3D5B99">Parabéns seu cadastrado foi realizado com sucesso! <br/>
                                                          Aguarde um momento para seu usuário ser liberado e poder acessar a aplicação <br/>
                                                          Estamos redirecionando você para o Login<br/>
                            </label>
                            <img src="includes/imagens/loading.gif" style="width: 50px;">

                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-10">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Digite o Login" required minlength="6">
                    </div>
                </div>
                <script>
                    function verificarSenhas(){
                    if (document.formUsuario.senha.value == document.formUsuario.confirmasenha.value){
                        $('#imagesituationerro').hide();
                        $('#mensagemlabelerro').hide();
                        $('#imagesituationcerto').show();
                        $('#definasenha').fadeOut(1000);
                    }else{
                        document.formUsuario.confirmasenha.focus();
                        $('#imagesituationcerto').hide();
                        $('#imagesituationerro').show();
                        $('#mensagemlabelerro').show();
                        $('#definasenha').fadeIn(1000);
                        }
                    };

                    function redirecionarLogin(){
                    if((document.formUsuario.nome.value != "") && 
                       (document.formUsuario.login.value != "") && 
                       (document.formUsuario.senha.value != "") && 
                       (document.formUsuario.confirmasenha.value != "")){
                        $("#mensagemredirecionamento").show();
                        setTimeout(
                            function(){ 
                                var formulario = document.getElementById('formUsuario');
                                formulario.submit();
                                    
                                }, 5000);
                        }
                    }
                </script>
                <div class="row">
                    <div class="col-md-6">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a Senha" 
                               required minlength="6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="confirmasenha">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmasenha" name="confirmasenha" placeholder="Digite novamente a Senha" 
                               required minlength="6" onchange="verificarSenhas()">
                    </div>
                    <div class="col-md-2">
                        <div id="imagesituationcerto" class="col-md-1" style="height: 30px;"></div>
                        <div id="imagesituationerro" class="col-md-1" style="height: 30px;"></div>
                    </div>
                </div>
                <div id="mensagemlabelerro">
                        <label style="font-size: 12px; color: red">As senhas não conferem :( Por favor informe as  senhas novamente!</label>
                    </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="data">Data</label>
                        <input type="text" class="form-control" id="data" name="data"
                               value="<?php echo $dataCadastro ?>" disabled>
                    </div>
                </div>
                <br/>
                <button type="button" id="btn" class="btn btn-success" onclick="redirecionarLogin()" value="Validate">Gravar</button>
                <button type="reset" class="btn btn-primary">Limpar</button>
            </form>
        </div>
    </div>
    <script src="includes/js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="includes/js/jquery.validate.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $("#formUsuario").validate({
                rules: {
                    nome: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    login: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },

                    senha: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    confirmasenha: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },
                messages: {
                    nome: {
                        required: "Por favor, informe o Nome",
                        minlength: "O Nome deve ter pelo menos 3 caracteres",
                        maxlength: "O Nome Senha deve ter no máximo 50 caracteres"
                    },
                    login: {
                        required: "Por favor, informe o Login",
                        minlength: "O Login deve ter pelo menos 6 caracteres",
                        maxlength: "O Login deve ter no máximo 20 caracteres"
                    },
                    senha: {
                        required: "Por favor, informe a Nova Senha",
                        minlength: "A Nova Senha deve ter pelo menos 6 caracteres",
                        maxlength: "A Nova Senha deve ter no máximo 20 caracteres"
                    },
                    confirmasenha: {
                        required: "Por favor, informe o campo Confirma Nova Senha",
                        minlength: "O Campo Confirma Nova Senha deve ter pelo menos 6 caracteres",
                        maxlength: "O Campo Confirma Nova Senha deve ter no máximo 20 caracteres"
                    }
                }
            })
        $('#btn').click(function() {
            $("#formUsuario").valid();
        });
    });
    </script>
</body>
<?php
    if(isset($_POST['login'])){
        $datacadastrohidden = $_POST['datacadastrohidden'];
        $nome = $_POST['nome'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $queryinsereusuario = "INSERT INTO usuario(nome, login, senha, datacadastro, ativo, quantidadeacesso) 
                                            VALUES('$nome', '$login', '$senha', '$datacadastrohidden', 'I', 1)";
        $result = pg_query($queryinsereusuario);
        if($result != null){ ?>
            <!--Redireciona para página de Login-->
            <script type="text/javascript">
                window.location="index.php";
            </script>
        <?php }
    
    }else{
    }
?>
</html>