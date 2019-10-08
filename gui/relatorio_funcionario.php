<?php 
    include("header.php");
    include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleRelatorioFuncionario.php");

    $controleRelatorioFuncionario = new ControleRelatorioFuncionario();
    $controleRelatorioFuncionario->gerarRelatorioOS(-1);
    $controleRelatorioFuncionario->carregarFuncionarios();
    $controleRelatorioFuncionario->gerarRelatorioFuncionarios();


    $relatorioFuncionarios = $controleRelatorioFuncionario->getRelatorioFuncionarios();
    print_r($relatorioFuncionarios);
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
                    // foreach ($relatorioOS->getOrdemServico() as $itemReltorioOS) {
               
                ?>


                <?php
                           
                    // }
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