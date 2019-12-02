<?php 
    include("header.php");
    include($_SERVER["DOCUMENT_ROOT"]."/business/controller/ControleRelatorioOSManutencao.php");

    $controleRelatorioOS = new ControleRelatorioOSManutencao();
    $controleRelatorioOS->gerarRelatorioOS($_GET['os']);
    $relatorioOS = $controleRelatorioOS->getRelatorioOS();
 ?>
 <div class="container">
    <form id="form_ordem_servico" action="" method="post">
        <h3>Relatório de ordem de serviço</h3>
        <p>Ordem de servico: <?= $relatorioOS->getOrdemServico()[0]->getDescricao() ?></p>
        <br>
        <h4>Serviços</h4>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Local</th>
              <th scope="col">Data</th>
              <th scope="col">Status</th>
              <th scope="col">Tipo serviço</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Tempo estimado</th>
              <th scope="col">Tempo real</th>
              <th scope="col">Porcentagem de tempo gasto</th>
            </tr>
          </thead>
          <tbody>
            
            
                <?php 
                    foreach ($relatorioOS->getOrdemServico()[0]->getListaServicos() as $itemServico) {
                      print_r($itemServico);
                      if($itemServico->getIsTempoExtraFixo() != -1){
                ?>
                <tr>
                    <th scope="row"><?= $itemServico->getIdServico() ?></th>
                    <td><?= $itemServico->getNome() ?></td>
                    <td><?= $itemServico->getLocal() ?></td>
                    <td><?= $itemServico->getDataCadastro() ?></td>
                    <td>
                      <?php if($itemServico->getStatus() == "1"){echo"Concluído";}
                            if($itemServico->getStatus() == "2"){echo"Em execução";}  
                            if($itemServico->getStatus() == "3"){echo"Pendente";}
                            if($itemServico->getStatus() == "4"){echo"Cancelado";}
                      ?>
                    </td>
                    <td><?= $itemServico->getTipoServico()->getNome() ?></td>
                    <td><?= $itemServico->getQuantidade() ?></td>
                    <td><?= $itemServico->getEstimativaTempoTotal() ?></td>
                    <td><?= $itemServico->getTempoExecucao() ?></td>
                    <td><?= $itemServico->getPorcentagemTempo() ?>%</td>
                </tr>
                <?php
                      }
                    }
                ?>
           
            

          </tbody>
        </table>
        <br>
        <h4>Funcionários alocados</h4>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
<!--               <th scope="col">Local</th>
              <th scope="col">Data</th>
              <th scope="col">Status</th>
              <th scope="col">Tipo serviço</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Tempo estimado</th>
              <th scope="col">Tempo real</th> -->
            </tr>
          </thead>
          <tbody>
            
            
                <?php 
                    foreach ($relatorioOS->getOrdemServico()[0]->getListaFuncionarios() as $itemFuncionario) {
                ?>
                <tr>
                    <th scope="row"><?= $itemFuncionario->getIdFuncionario() ?></th>
                    <td><?= $itemFuncionario->getNome() ?></td>
             
                </tr>
                <?php
                    }
                ?>
           
            

          </tbody>
        </table>
      
    </form>

   

 </div>

<script type="text/javascript">
    
   

</script>


 <?php 
    include("footer.php");
  ?>