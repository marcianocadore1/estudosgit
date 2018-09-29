<?php

class ReservacolaboradorModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        //Pegar data atual
        $placa = $_POST['placa'];
                
        //Buscar o veículo
        $consultareserva = "select v.placa,
                                   r.destino,
                                   r.motivo,
                                   con.descricao,
                                   r.kmfinal
                              from reserva r
                             inner join veiculo v
                                on r.idveiculo = v.id
                             inner join condicaoveiculo con
                                on r.idcondicao = con.id
                             where v.placa = '$placa'";
        
        $sqlconsultareserva = $this->bd->prepare($consultareserva);
        $sqlconsultareserva->execute();

        if ($sqlconsultareserva->rowCount() > 0) {
            foreach ($sqlconsultareserva as $rs){
                $placa = $rs["placa"];
                $destino = $rs["destino"];
                $motivo = $rs["motivo"];
                $descricao = $rs["descricao"];
                $kmfinal = $rs["kmfinal"];
            }
            echo 'Placa: '; echo $placa; echo '<br>';
            echo 'Destino: '; echo $destino; echo '<br>';
            echo 'Motivo: '; echo $motivo; echo '<br>';
            
        }
        //Retornar as informações para a tela anterior
        
    }
}