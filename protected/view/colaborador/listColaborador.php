<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Listagem de Colaboradores</div>
            <div class="panel-body">
                <a href="painel.php?controle=colaboradorController&acao=novo">
                    <span class='glyphicon glyphicon-plus'> Adicionar</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table" id="example1" style="width: 1500px;">
                    <thead>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>CNH</th>
                        <th>Endereço</th>
                        <th>Cidade</th>
                        <th>Setor</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td>' . $item['nomecolaborador'];
                            echo '<td>' . $item['datanascimento'];
                            echo '<td>' . $item['cpf'];
                            echo '<td>' . $item['telefone'];
                            echo '<td>' . $item['email'];
                            echo '<td>' . $item['cnh'];
                            echo '<td>' . $item['endereco'];
                            echo '<td>' . $item['cidadeestado'];
                            echo '<td>' . $item['nomesetor'];
                            $id = $item['idcolaborador'];
                            
                             echo "<td> <a href='painel.php?controle=colaboradorController&acao=buscar&id=$id'>"
                            . " <span class='glyphicon glyphicon-pencil'> </span>"
                            . "</a> </td>";
                            echo "<td> <a onclick='excluir(\"excluir\",\"colaboradorController\",$id)' href='#'>"
                            . " <span class='glyphicon glyphicon-trash customDialog'> </span>"
                            . "</a> </td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>