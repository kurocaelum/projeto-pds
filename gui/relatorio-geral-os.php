<?php 
    include("header.php");
    include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioOSPredial.php");

    $controleRelatorioOS = new ControleRelatorioOSPredial();
    $controleRelatorioOS->gerarRelatorioOS(-1);
    $relatorioOS = $controleRelatorioOS->getRelatorioOS();

 ?>
 <div class="container">
    <form id="form_ordem_servico" action="" method="post">
        <h3>Relatório geral de ordem de serviço</h3>
        
        <br>
        <h4></h4>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Descrição</th>
              <th scope="col">Tempo estimado para conclusão</th> 
              <th scope="col">Tempo real gasto</th>
              <th scope="col">Porcentagem do tempo disponível utilizado</th>
              <th scope="col">Status de conclusão dos serviços</th>
              <!--
              <th scope="col">Tempo estimado</th>
              <th scope="col">Tempo real</th>
              <th scope="col">Porcentagem de tempo  gasto</th>-->
            </tr>
          </thead>
          <tbody>
            
            
                <?php 
                    foreach ($relatorioOS->getOrdemServico() as $itemReltorioOS) {
                      
                ?>

                <tr>
                    <th scope="row"><?= $itemReltorioOS->getIdOrdemServico() ?></th>
                    <td><?= $itemReltorioOS->getDescricao() ?></td>
                    <td><?= $itemReltorioOS->getTempoEstimadoTotal() ?></td>
                    <td><?= $itemReltorioOS->getTempoExecucaoTotal() ?></td>
                    <td><?= intval($itemReltorioOS->getPocentagemTempoUtilizado()); ?> %</td>
                    <td><?= intval($itemReltorioOS->getStatus()); ?> % concluído</td>
                <tr>     

                <?php
                           
                    }
                ?>
           
            

          </tbody>
        </table>
        <br>
       
      
    </form>

   

 </div>

<script type="text/javascript">
    
   

</script>


 <?php 
    include("footer.php");
  ?>