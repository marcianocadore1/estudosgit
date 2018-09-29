<?php

class GerenteModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        //Primeiro faz insert na tabela usuario
        $idsetor = $_POST['idsetor'];
        $idcidade = $_POST['idcidade'];
        $datanascimento = $_POST['datanascimento'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        
        //Verifica se CPF já esta cadastrado na base de dados
        $consultacpf = "select count(*) as quantidadecpf from usuario where cpf = '$cpf'";
        $sqlconsultacpf = $this->bd->prepare($consultacpf);
        $sqlconsultacpf->execute();
        
        if ($sqlconsultacpf->rowCount() > 0) {
            foreach ($sqlconsultacpf as $rs) {
                $quantidadecpf = $rs["quantidadecpf"];
            }
        }
        
        //Verifica se E-MAIL já esta cadastrado na base de dados
        $consultaemail = "select count(*) as quantidadeemail from usuario where email = '$email'";
        $sqlconsultaemail = $this->bd->prepare($consultaemail);
        $sqlconsultaemail->execute();
        
        if ($sqlconsultaemail->rowCount() > 0) {
            foreach ($sqlconsultaemail as $rs) {
                $quantidadeemail = $rs["quantidadeemail"];
            }
        }
        
        if($quantidadecpf >= 1){
            echo "<script>alert('Este CPF já encontra-se cadastrado na base de dados! Favor informe outro CPF');</script>";
        }else if($quantidadeemail >= 1){
            echo "<script>alert('Este E-mail já encontra-se cadastrado na base de dados! Favor informe outro E-mail');</script>";
        }else{
            //O CPF e o E-mail não estão cadastrados, então é possível gravar o registro
            $sql = "INSERT INTO usuario(nome, sobrenome, datanascimento, cpf, telefone, celular, cnh, senha, endereco, email, idcidade) "
                    . "          VALUES(:nome, :sobrenome, '$datanascimento', '$cpf', :telefone, :celular, :cnh, :senha, :endereco, '$email', $idcidade)";
            
            unset($dados['id']);
            unset($dados['cpf']);
            unset($dados['email']);
            unset($dados['idsetor']);
            unset($dados['idcidade']);
            unset($dados['datanascimento']);
            $query = $this->bd->prepare($sql);
            $query->execute($dados);

            //Após realizar o insert na tabela usuário devemos fazer insert na tabela gerente, 
            //pegando o ultimo id do usuário que vai relacionado com o gerente
            $usuarioregistro = "select max(id) as idusuario from usuario";
            $sqlusuarioregistro = $this->bd->prepare($usuarioregistro);
            $sqlusuarioregistro->execute();

            if ($sqlusuarioregistro->rowCount() > 0) {
                foreach ($sqlusuarioregistro as $rs) {
                    $idusuarioregistro = $rs["idusuario"];
                }
            }

            if($idusuarioregistro != null){
                $sqlgerente = "INSERT INTO gerente(idsetor, idusuario) "
                        . " VALUES($idsetor, $idusuarioregistro)";
                unset($dados['nome']);
                unset($dados['sobrenome']);
                unset($dados['telefone']);
                unset($dados['celular']);
                unset($dados['cnh']);
                unset($dados['endereco']);
                unset($dados['idcidade']);
                unset($dados['senha']);
                $query = $this->bd->prepare($sqlgerente);
                return $query->execute($dados);
            }
        }
    }

    public function buscarTodos() {
    	$sql = "select u.id,
                        u.nome,
                        u.sobrenome,
                        (u.nome || ' ' || u.sobrenome) as nomegerente,
                        to_char(u.datanascimento, 'dd/MM/yyyy') as datanascimento,
                        u.cpf,
                        u.telefone,
                        u.celular,
                        u.cnh,
                        u.endereco,
                        u.email,
                        (cid.nome || ' - ' || est.uf) as nomecidade,
                        g.id as idgerente
                   from usuario u
                  inner join gerente g
                     on g.idusuario = u.id
                  inner join cidade cid
                     on cid.id = u.idcidade
                  inner join setor s
                     on g.idsetor = s.id 
                  inner join estado est
                     on cid.idestado = est.id
                  order by u.nome asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "select u.id,
                       u.nome,
                       u.sobrenome,
                       to_char(u.datanascimento, 'dd/MM/yyyy') as datanascimento,
                       u.cpf,
                       u.telefone,
                       u.celular,
                       u.cnh,
                       u.senha,
                       u.endereco,
                       u.idcidade,
                       u.email,
                       u.idcidade,
                       g.idsetor
                   from usuario u
                  inner join gerente g
                     on g.idusuario = u.id
                  WHERE u.id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));

        return $query->fetch();
    }

    public function atualizar(array $dados) {
        $id             = $_POST['id'];
        $datanascimento = $_POST['datanascimento'];
        $cpf            = $_POST['cpf'];
        $email          = $_POST['email'];
        $idsetor        = $_POST['idsetor'];
        $idcidade       = $_POST['idcidade'];
        
        $sql = "UPDATE usuario 
                   SET nome           = :nome,
                       sobrenome      = :sobrenome,
                       datanascimento = '$datanascimento',
                       cpf            = '$cpf',
                       telefone       = :telefone,
                       celular        = :celular,
                       cnh            = :cnh,
                       senha          = :senha,
                       endereco       = :endereco,
                       idcidade       = $idcidade,
                       email          = '$email'
                 WHERE id = $id";
        unset($dados['id']);
        unset($dados['idsetor']);
        unset($dados['datanascimento']);
        unset($dados['cpf']);
        unset($dados['idcidade']);
        unset($dados['email']);
        $query = $this->bd->prepare($sql);
        $query->execute($dados);
        
        //Verifica o registro usuario para alterar
        $verificaregistrousuario = "select g.id as idusuario from usuario u inner join gerente g on g.idusuario = u.id where g.idusuario = $id";
        $sqlverificaregistrousuario = $this->bd->prepare($verificaregistrousuario);
        $sqlverificaregistrousuario->execute();
        if ($sqlverificaregistrousuario->rowCount() > 0) {
            foreach ($sqlverificaregistrousuario as $rs) {   
                $verificaidregistrousuario = $rs["idusuario"];
            }
        }
        
        //Atualiza gerente
        if($verificaidregistrousuario != null){
            $sqlGerente = "UPDATE gerente
                              SET idsetor = $idsetor,
                                  idusuario = $id
                            WHERE id = $verificaidregistrousuario";
            
            unset($dados['nome']);
            unset($dados['sobrenome']);
            unset($dados['telefone']);
            unset($dados['celular']);
            unset($dados['cnh']);
            unset($dados['endereco']);
            unset($dados['idcidade']);
            unset($dados['senha']);
            $query = $this->bd->prepare($sqlGerente);
            return $query->execute($dados);
        }
        
    }

    public function excluir($id) {
        $idusuario = $_GET['id'];
        
        $gerente    = "delete from gerente where idusuario = $idusuario";
        $sqlgerente = $this->bd->prepare($gerente);
        $this->bd->prepare($gerente);
        $sqlgerente->execute();
       
        $usuario = "delete from usuario where id = $idusuario";
        $sqlusuario = $this->bd->prepare($usuario);
        return $sqlusuario->execute();
    }
}