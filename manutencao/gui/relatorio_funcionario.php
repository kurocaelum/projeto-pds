<?php 
    include("header.php");
    include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioFuncionarioPredial.php");

    $controleRelatorioFuncionario = new ControleRelatorioFuncionarioPredial();
    $controleRelatorioFuncionario->gerarRelatorioOS(-1);
    $controleRelatorioFuncionario->carregarFuncionarios();
    $controleRelatorioFuncionario->gerarRelatorioFuncionarios();


    $relatorioFuncionarios = $controleRelatorioFuncionario->getRelatorioFuncionarios();
 ?>
 <div class="container">
    <form id="form_ordem_servico" action="" method="post">
        <h3>Relatório dos funcionários</h3>
        
        <br>
        <h4></h4>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade OS</th> 
              <th scope="col">OS com excesso de tempo gasto</th>
              <!--
              <th scope="col">Tempo estimado</th>
              <th scope="col">Tempo real</th>
              <th scope="col">Porcentagem de tempo  gasto</th>-->
            </tr>
          </thead>
          <tbody>
            

            
                <?php 
                    foreach ($relatorioFuncionarios as $itemReltorio) {
               
                ?>  
                 <tr>
                  <th><?= $itemReltorio->getFuncionario()->getIdFuncionario() ?></th>
                  <td><?= $itemReltorio->getFuncionario()->getNome() ?></td>
                  <td><?= $itemReltorio->getQuantidadeOrdemServicos() ?></td>
                  <td><?php echo intval($itemReltorio->getPorcentagemOrdemServicoExcesso()) ?> %</td>
                 </tr>
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