<?php

class VeiculoModel extends Conexao {

    function __construct() {
        parent::__construct();
    }

    public function inserir(array $dados) {
        $arquivofoto = $_FILES['arquivo']['name'];
        $nomefotoaleatorio = $arquivofoto;
        //str_shuffle gera um nome aleatório
        $nomealeatorio = str_shuffle($nomefotoaleatorio);
        //se houver algum ponto ou virgula remover por nada
        $nomefoto = str_replace("." , "" , $nomealeatorio); // Primeiro tira os pontos
        $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
        
        //Pega extensão da imagem
        $extensaoimagem = substr($arquivofoto, -4);
        
        $destino = 'C:/xampp/htdocs/locadoraveiculos/protected/imagens/uploads/' . $nomefoto . $extensaoimagem;
        
        //alterar extensão de imagem para minúscula
        $res = strtolower($extensaoimagem);
        
        if($res != ''){
            if($res == '.jpg' || $res == '.png'){
                //$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
                move_uploaded_file($arquivo_tmp, $destino);
                //Gravar essas informações no banco, vai ter o caminho e o nome da foto.
                $caminhofoto = "locadoraveiculos/protected/imagens/uploads/";
                
                $nomefotoaleatorio = $nomealeatorio;
                $nomefotoaleatoriosemponto = str_replace("." , "" , $nomefotoaleatorio);
                $nomefoto = $nomefotoaleatoriosemponto . $res;
            }else{
                echo '<div style="color: red;">A imagem não pode ser gravada, pois sua extensão não é válida. Extensões válidas (<b>.jpg, .png</b>)</div></br>';
                $caminhofoto = '';
                $nomefoto = '';
            }
        }
        
        $kminicial = $_POST['kminicial'];
        $kmfinal = $_POST['kmfinal'];
        
        $anomodelo = $_POST['anomodelo'];
        $anofabricacao = $_POST['anofabricacao'];
        
        $intervalo = ($anomodelo - $anofabricacao);
        
        if(($intervalo < -1) || ($intervalo > 1)){
            echo "<script>alert('O Intervalo entre o Ano de Fabricação e Ano do Modelo não pode ser maior que 1!');</script>"; 
        }else{
            if($kminicial > $kmfinal){
                echo "<script>alert('O Km Inicial não pode ser maior que o Km Final. Por favor informe a Km correta!');</script>"; 
             }else{
                 $sql = "INSERT INTO veiculo(modelo, placa, chassi, versao, anomodelo, anofabricacao, kminicial, kmfinal, caminhofoto, nomefoto) 
                                 VALUES(:modelo, :placa, :chassi, :versao, $anomodelo, $anofabricacao, $kminicial, $kmfinal, '$caminhofoto', '$nomefoto')";
                 
                 unset($dados['id']);
                 unset($dados['kminicial']);
                 unset($dados['kmfinal']);
                 unset($dados['caminhofoto']);
                 unset($dados['nomefoto']);
                 unset($dados['anomodelo']);
                 unset($dados['anofabricacao']);
                 $query = $this->bd->prepare($sql);
                 return $query->execute($dados);
             }
        }
        echo 'nao passou no insert'; exit;
    }

    public function buscarTodos() {
    	$sql = "select id,
                   UPPER(modelo) as modelo,
                   UPPER(placa) as placa, 
                   UPPER(chassi) as chassi,
                   UPPER(versao) as versao,
                        anomodelo,
                        anofabricacao,
                        kminicial,
                        kmfinal,
                        nomefoto,
                        ('http://localhost/' || '' || caminhofoto || '' || nomefoto) as caminhonomefoto
                   from veiculo
                   order by modelo asc;";
        $query = $this->bd->query($sql);
        return $query->fetchAll();
    }

    public function buscar($id) {
        $sql = "SELECT id,
                  UPPER(modelo) as modelo,
                  UPPER(placa) as placa, 
                  UPPER(chassi) as chassi,
                  UPPER(versao) as versao,
                       anomodelo,
                       anofabricacao,
                       kminicial,
                       kmfinal,
                       nomefoto,
                       ('http://localhost/' || '' || caminhofoto || '' || nomefoto) as caminhonomefoto
                  FROM veiculo
                 WHERE id = :id";
        $query = $this->bd->prepare($sql);
        $query->execute(array('id' => $id));

        return $query->fetch();
    }

    public function atualizar(array $dados) {
        //Consulta se nome da imagem ja existe e exclui a imagem do diretóio se o usuário alterar um registro 
        //que ja possui o mesmo nome da imagem
        $consultaimagem = "select nomefoto from veiculo where id = " . $_POST['id'];
        $sqlconsultaimagem = $this->bd->prepare($consultaimagem);
        $sqlconsultaimagem->execute();
        
        if ($sqlconsultaimagem->rowCount() > 0) {
            foreach ($sqlconsultaimagem as $rs){
                $nomeimagemveiculo = $rs["nomefoto"];
                if($nomeimagemveiculo != null){
                    //Pega o caminho da imagem
                    $apagararquivo = 'C:/xampp/htdocs/locadoraveiculos/protected/imagens/uploads/' . $nomeimagemveiculo;

                    //Remover arquivo de imagem
                    if(!unlink($apagararquivo)){
                      echo ("<div style='color:red'><b>Não foi possível alterar a imagem! </b></div>");
                    }else{
                      echo ("<div style='color:green'><b>Imagem alterada com sucesso!</b></div>");
                    }
                }
            }
        }
        
        $arquivofoto = $_FILES['arquivo']['name'];
        $nomefotoaleatorio = $arquivofoto;
        $nomealeatorio = str_shuffle($nomefotoaleatorio);
        
        //se houver algum ponto ou virgula remover por nada
        $nomefoto = str_replace("." , "" , $nomealeatorio);
        $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
        
        $extensaoimagem = substr($arquivofoto, -4);
        
        //alterar extensão de imagem para minúscula
        $destino = 'C:/xampp/htdocs/locadoraveiculos/protected/imagens/uploads/' . $nomefoto . $extensaoimagem;
        
        //Converter a extensão para letra minúscula
        $res = strtolower($extensaoimagem);
        
        //Verificar se a imagem esta indo vazia
        if($res != ''){
            if($res == '.jpg' || $res == '.png'){
            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            move_uploaded_file($arquivo_tmp, $destino);

            //Gravar essas informações no banco, vai ter o caminho e o nome da foto.
            $caminhofoto = "locadoraveiculos/protected/imagens/uploads/";
            $nomefotoaleatorio = $nomealeatorio;
            $nomefotoaleatoriosemponto = str_replace("." , "" , $nomefotoaleatorio);
            $nomefoto = $nomefotoaleatoriosemponto . $extensaoimagem;
            
            }else{
                echo '<div style="color: red;">A imagem não pode ser gravada, pois sua extensão não é válida. Extensões válidas (<b>.jpg, .png</b>)</div></br>';
                $caminhofoto = '';
                $nomefoto = '';
            }
        }
        
        $anomodelo = $_POST['anomodelo'];
        $anofabricacao = $_POST['anofabricacao'];
        $kminicial = $_POST['kminicial'];
        $kmfinal = $_POST['kmfinal'];
        
        $intervalo = ($anomodelo - $anofabricacao);
        
        if(($intervalo < -1) || ($intervalo > 1)){
            echo "<script>alert('O Intervalo entre o Ano de Fabricação e Ano do Modelo não pode ser maior que 1!');</script>"; 
        }else{
            if($kminicial > $kmfinal){
                echo "<script>alert('O Km Inicial não pode ser maior que o Km Final. Por favor informe a Km correta!');</script>"; 
             }else{
                $sql = "UPDATE veiculo 
                           SET modelo = :modelo,
                               placa  = :placa,
                               chassi = :chassi,
                               versao  = :versao,
                               anomodelo  = $anomodelo,
                               anofabricacao  = $anofabricacao,
                               kminicial  = $kminicial,
                               kmfinal  = $kmfinal,
                               caminhofoto  = '$caminhofoto',
                               nomefoto  = '$nomefoto'
                         WHERE id = :id";
                unset($dados['nomefoto']);
                unset($dados['caminhofoto']);
                unset($dados['kminicial']);
                unset($dados['kmfinal']);
                unset($dados['anomodelo']);
                unset($dados['anofabricacao']);
                 
                $query = $this->bd->prepare($sql);
                return $query->execute($dados);
             }
        }
    }

    public function excluir($id) {
        //Verifica qual é o nome da imagem se existir na base de dados para realizar a exclusão do arquivo
        $consultaimagem = "select nomefoto from veiculo where id = " . $_GET['id'];
        $sqlconsultaimagem = $this->bd->prepare($consultaimagem);
        $sqlconsultaimagem->execute();
        
        //Exclusão de foto
        if ($sqlconsultaimagem->rowCount() > 0) {
            foreach ($sqlconsultaimagem as $rs){
                $nomeimagemveiculo = $rs["nomefoto"];
                //Pega o caminho da imagem
                $apagararquivo = 'C:/xampp/htdocs/locadoraveiculos/protected/imagens/uploads/' . $nomeimagemveiculo;
                
                //Remover arquivo de imagem
                if(!unlink($apagararquivo)){
                  echo ("<div style='color:red'><b>Não foi possível deletar a imagem! </b></div>");
                }else{
                  echo ("<div style='color:green'><b>Imagem deletada com sucesso!</b></div>");
                }
            }
        }
        //Exclusão do registro
        $sql = "DELETE FROM veiculo WHERE id = :id";
        $query = $this->bd->prepare($sql);
        return $query->execute(array('id' => $id));
    }
}