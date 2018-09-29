<div id="fundo">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Relação de Usuários</div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Data Cadastro</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaDados as $item) {
                            echo '<tr>';
                            echo '<td>' . $item['nomeusuario'];
                            echo '<td>' . $item['login'];
                            echo '<td>' . $item['datacadastro'];
                            $id = $item['id'];

                            echo "<td> <a href='index.php?controle=usuarioController&acao=buscar&id=$id'>"
                            . " <span class='glyphicon glyphicon-pencil' title='Alterar Informação'> </span>"
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