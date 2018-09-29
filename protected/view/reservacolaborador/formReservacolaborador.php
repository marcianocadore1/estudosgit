<?php include("config/confloginrel.php"); ?>
<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Consulta Reserva Colaborador</div>
        <div class="panel-body">
            <!--painel.php?controle=reservacolaboradorController&acao=novo-->
            <form action="<?php echo $acao?>" name="formReservacolaborador" id="formReservacolaborador" method="POST" class="form" role="form" onchange="return checarDatas()">
                <div class="row">
                    <div class="col-md-1">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly="true" 
                               value="<?php if (isset($reservacolaborador)) echo $reservacolaborador['id']; ?>">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label for="placa">Placa</label>
                            <input type="text" class="form-control" id="placa" name="placa">
                    </div>
                    <div style="padding-top: 23px;">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
            <?php
                /*
                $placa = isset($_POST['placa']);
                  $result = pg_query("select v.placa,
                                             r.destino,
                                             r.motivo,
                                             con.descricao,
                                             r.kmfinal
                                        from reserva r
                                       inner join veiculo v
                                          on r.idveiculo = v.id
                                       inner join condicaoveiculo con
                                          on r.idcondicao = con.id
                                       where v.placa = '$placa'");
                  if (pg_num_rows($result) > 0) {
                          $_SESSION['cpf'] = $cpf;
                          $_SESSION['senha'] = $senha;
                          header('location:../painel.php');

                  }
    
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
                }*/
            ?>
        </div>
    </div>
</div>


<div class="col-md-12 col-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro Reserva Colaborador</div>
        <div class="panel-body">
            <form action="<?php echo $acao; ?>" name="formReservacolaborador" id="formReservacolaborador" method="POST" class="form" role="form" onchange="return checarDatas()">
                <div class="row">
                    <div class="col-md-2">
                        <label for="idveiculo">Placa</label>
                            <input type="text" class="form-control" id="idveiculo" name="placa" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="destino">Destino</label>
                            <input type="text" class="form-control" id="destino" name="destino">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="motivo">Motivo</label>
                            <input type="text" class="form-control" id="motivo" name="motivo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="condicao">Condição</label>
                            <input type="text" class="form-control" id="condicao" name="condicao">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label for="kmfinal">Km Atual - Final</label>
                        <input type="text" class="form-control" id="kmfinal" readonly="true" name="kmfinal">
                    </div>
                </div>
                <div style="padding-top: 23px;">
                    <button type="submit" class="btn btn-success">Confirmar</button>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script src="includes/js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.min.js" type="text/javascript"></script>

<script>
    $("#formReserva").validate({
        rules: {
            idveiculo: {
                required: true
            },
            datasaidaprev: {
                required: true
            },
            horasaidaprev: {
                required: true
            },
            dataretprev: {
                required: true
            },
            horaretprev: {
                required: true
            },
            motivo: {
                required: true
            },
            destino: {
                required: true
            }
        },
        messages: {
            idveiculo: {
                required: "Por favor, Selecione um Veículo"
            },
            datasaidaprev: {
                required: "Por favor, Informe a Data Previsão da Saída"
            },
            horasaidaprev: {
                required: "Por favor, Informe a Hora Previsão de Saída"
            },
            dataretprev: {
                required: "Por favor, Informe a Data Previsão de Retorno"
            },
            horaretprev: {
                required: "Por favor, Informe a Hora Previsão de Retorno"
            },
            motivo: {
                required: "Por favor, Informe o Motivo"
            },
            destino: {
                required: "Por favor, Informe o Destino"
            }
        }
    });
</script>
