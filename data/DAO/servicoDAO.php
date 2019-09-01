<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/data/conexao.php");

class ServicoDAO{
    public $arrayServicos;
    public $conexao;

    public function __construct(){
        $this->arrayServicos = [];
        $this->conexao = (new Conexao())->getConexao();
    }
    
    public function insert($servico){
        
        $sql = "INSERT INTO servico (id_tipo_servico, nome, localizacao, quantidade, data_cadastro, status) VALUES (".$servico->getTipoServico().", '".$servico->getNome()."', '".$servico->getLocal()."', ".$servico->getQuantidade().", '".$servico->getDataCadastro()."', '".$servico->getStatus()."')";

        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
    public function update($servico){
         $sql = "UPDATE servico SET id_tipo_servico = ".$servico->getTipoServico().", nome = '".$servico->getNome()."', localizacao = '".$servico->getLocal()."', quantidade = ".$servico->getQuantidade().", data_cadastro= '".$servico->getDataCadastro()."', status= '".$servico->getStatus()."'   WHERE  id_servico = ".$servico->getIdServico();
    
        //echo $sql;
        if(mysqli_query($this->conexao, $sql)){
            return 1;
        }
        return 0;
    }
     
    public function delete($servico){
        if($servico->getIdServico() != ""){
            $sql = "DELETE FROM servico WHERE id_servico=".$servico->getIdServico();
            if(mysqli_query($this->conexao, $sql)){
                return 1;
            }
        }
        return 0;
    }

    //retorna array de objetos de tipo_servicos
    public function getServicos(){
        $sql = "SELECT * FROM servico";
        $result = mysqli_query($this->conexao, $sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $this->arrayServicos[count($this->arrayServicos) + 1] = $row;
                }
                return $this->arrayServicos;
            }   
        return 0;
    }

}

?>