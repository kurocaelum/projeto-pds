<?php 
    include("header.php");
    include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOS.php");

    $controleRelatorioOS = new ControleRelatorioOS();
    $controleRelatorioOS->gerarRelatorioOS($_GET['os']);
    $relatorioOS = $controleRelatorioOS->getRelatorioOS();

 ?>
 <div class="container">
    <form id="form_ordem_servico" action="" method="post">
        <h3>Relatório de ordem de serviço</h3>
        <p>Ordem de servico: <?= $relatorioOS->getOrdemServico()->getDescricao() ?></p>
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
            </tr>
          </thead>
          <tbody>
            
            
                <?php 
                    foreach ($relatorioOS->getOrdemServico()->getListaServicos() as $itemServico) {
                ?>
                <tr>
                    <th scope="row"><?= $itemServico->getIdServico() ?></th>
                    <td><?= $itemServico->getNome() ?></td>
                    <td><?= $itemServico->getLocal() ?></td>
                    <td><?= $itemServico->getDataCadastro() ?></td>
                    <td><?= $itemServico->getStatus() ?></td>
                    <td><?= $itemServico->getTipoServico()->getNome() ?></td>
                    <td><?= $itemServico->getQuantidade() ?></td>
                    <td><?= $itemServico->getEstimativaTempoTotal() ?></td>
                    <td><?= $itemServico->getPorcentagemTempo() ?></td>
                </tr>
                <?php
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
              <th scope="col">Local</th>
              <th scope="col">Data</th>
              <th scope="col">Status</th>
              <th scope="col">Tipo serviço</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Tempo estimado</th>
              <th scope="col">Tempo real</th>
            </tr>
          </thead>
          <tbody>
            
            
                <?php 
                    foreach ($relatorioOS->getOrdemServico()->getListaServicos() as $itemServico) {
                ?>
                <tr>
                    <th scope="row"><?= $itemServico->getIdServico() ?></th>
                    <td><?= $itemServico->getNome() ?></td>
                    <td><?= $itemServico->getLocal() ?></td>
                    <td><?= $itemServico->getDataCadastro() ?></td>
                    <td><?= $itemServico->getStatus() ?></td>
                    <td><?= $itemServico->getTipoServico()->getNome() ?></td>
                    <td><?= $itemServico->getQuantidade() ?></td>
                    <td><?= $itemServico->getEstimativaTempoTotal() ?></td>
                    <td><?= $itemServico->getPorcentagemTempo() ?></td>
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