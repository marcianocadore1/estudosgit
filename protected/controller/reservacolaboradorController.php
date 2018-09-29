<?php

class ReservacolaboradorController {
    private $bd, $model;
    private $veiculoModel;
    
    function __construct() {
        require './protected/model/reservacolaboradorModel.php';
        require './protected/model/veiculoModel.php';
        $this->model = new ReservacolaboradorModel();
        $this->modelVeiculos = new VeiculoModel();
    }
    
    public function novo() {
        $listaVeiculos  = $this->modelVeiculos->buscarTodos();
        $acao = 'painel.php?controle=reservacolaboradorController&acao=inserir';
        require './protected/view/reservacolaborador/formReservacolaborador.php';
    }
    
    public function inserir(array $dados) {
        $r = $this->model->inserir($dados);
        $this->listar();
    }
    
    public function listar() {
        //$listaDados = $this->model->buscarTodos();
        require './protected/view/reservacolaborador/formReservacolaborador.php';
    }
}