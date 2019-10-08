<?php
    include("header.php");
    include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroImprevisto.php");

    $controleCadastroImprevisto = new ControleCadastroImprevisto();
?>

<div class="container">
    <form id="form_imprevisto" action="" method="post">
        <h3>Cadastro de novo imprevisto</h3>
        <input type="hidden" name="addImprevisto">
        <input type="hidden" name="idImprevisto" id="form_input_id">

        <div class="form-group">
            <div class="form-group">
                <label for="listaServicosOption">Serviço</label>
                <select class="form-control exibirListaServicosOption" name="servicoImprevisto" id="listaServicoOption">
                </select>
            </div>
            
            <div class="form-group">
                <label for="form_input_descricao">Descrição</label>
                <input name="descricao" type="text" class="form-control" id="form_input_descricao" placeholder="Descrição">
            </div>

            <div class="form-group">
                <label for="form_input_quantidade">Quantidade</label>
                <input name="quantidade" type="text" class="form-control" id="form_input_quantidade" placeholder="Quantidade">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <br><br>
    <h3>Imprevistos cadastrados</h3>
    <table class="table">
		<thead>
		    <tr>
                  <th scope="col">ID imprevisto</th>
                  <th scope="col">ID Serviço</th>
			      <th scope="col">Descrição</th>
			      <th scope="col">Quantidade</th>
		    </tr>
		</thead>
		<tbody class="allImprevistos">
			
		</tbody>
	</table>
</div>

<!-- TODO carregar imprevistos na tabela -->
<script type="text/javascript">
    carregarServicos("option");
    carregarImprevistos("tabela");
</script>

<?php 
    include("footer.php");
?>