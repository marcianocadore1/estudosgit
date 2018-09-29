<?php

class UsuarioModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
    	$nome = $_POST['nome'];
    	$login = $_POST['login'];
    	$senha = $_POST['senha'];
    	
    	//Função para capturar a data
        date_default_timezone_set('America/Sao_Paulo');
        $dataCadastro = date('d/m/Y');

        $sql = "INSERT INTO usuario(nome, login, senha, datacadastro, ativo, quantidadeacesso) VALUES('$nome', '$login', '$senha', '$dataCadastro', 'A', 0)";
        unset($dados['id']);
        unset($dados['nome']);
        unset($dados['ativo']);
        unset($dados['login']);
        unset($dados['senha']);
        unset($dados['datacadastro']);
        $query = $this->bd->prepare($sql);
        return $query->execute($dados);
    }

    public function buscarTodos() {
    	//Verifica se é usuário administrador
    	$loginusuario = $_SESSION['login'];
    	$loginusuario = "select id as idusuario, administrador from usuario where login = '$loginusuario'";
	    $sqllogin = $this->bd->prepare($loginusuario);
	    $sqllogin->execute();
	    if ($sqllogin->rowCount() > 0) {
	        foreach ($sqllogin as $rs) {
	        	$idusuario        = $rs["idusuario"];
	            $administrador    = $rs["administrador"];
	        }
	    }
	    if($administrador == 'S'){
	    	$ativo = " 'A' ";
	    	$pesquisa = 'where ativo = ' . $ativo;
	    }else if($administrador != 'S'){
	    	$pesquisa = 'where id = ' . $idusuario;
	    }
        $sql = "select id,
                       nome as nomeusuario,
                       login,
                       to_char(datacadastro, 'dd/MM/yyyy') as datacadastro
                  from usuario
                      $pesquisa
                  order by nome asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "SELECT id, nome, login, to_char(datacadastro, 'dd/MM/yyyy') as datacadastro, senha FROM usuario WHERE id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));

        return $query->fetch();
    }

    public function atualizar(array $dados) {
        //Função para capturar a data
        date_default_timezone_set('America/Sao_Paulo');
        $dataCadastro = date('d/m/Y');

        //Verifica a quantidade de acesso
        $registroquantidadeacesso = "select quantidadeacesso from usuario";
        $sqlquantidadeacesso = $this->bd->prepare($registroquantidadeacesso);
        $sqlquantidadeacesso->execute();
        foreach ($sqlquantidadeacesso as $rs) {
            $quantidadeacesso = $rs["quantidadeacesso"];
        }

        $novaquantidadeacesso = $quantidadeacesso + 1;

        $sql = "UPDATE usuario 
                   SET nome = :nome,
                       login = :login,
                       datacadastro = '$dataCadastro',
                       quantidadeacesso = $novaquantidadeacesso,
                       senha = :senha
                 WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute($dados);
    }

    public function excluir($id) {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute(array('id' => $id));
    }
}