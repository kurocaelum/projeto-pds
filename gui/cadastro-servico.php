<?php 
	include("header.php");
	include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroServico.php");

	$controleCadastroServico = new ControleCadastroServico();

 ?>
 <div class="container">
 	<form id="form_servico" action="" method="post">
 		<h3>Cadastro de novo serviço</h3>
 		<input type="hidden" name="addServico">
 		<input type="hidden" name="idServico" id="form_input_id">
		<div class="form-group">
			<div class="form-group">
			    <label for="form_input_nome">Nome</label>
			    <input name="nome" type="text" class="form-control" id="form_input_nome" placeholder="">
		  	</div>
		  	<div class="form-group">
			    <label for="form_input_local">Local</label>
			    <input name="local" type="text" class="form-control" id="form_input_local" placeholder="">
		  	</div>
		  	<div class="form-group">
			    <label for="form_input_data">Data</label>
			    <input name="data" type="date" class="form-control" id="form_input_data" placeholder="">
		  	</div>
		  	<div class="form-group">
			    <label for="form_input_status">Status</label>
			    <input name="status" type="text" class="form-control" id="form_input_status" placeholder="">
		  	</div>
		    <label for="listaTiposServicosOption">Tipo de serviço</label>
		    <select class="form-control exibirListaTiposServicosOption" name="tipoServico" id="listaTiposServicosOption">
		    </select>
		   	
		   	<div class="form-group">
			    <label for="exampleInputQuantidade">Quantidade</label>
			    <input name="quantidade" type="text" class="form-control" id="exampleInputQuantidade" placeholder="">
		  	</div>
		

		 </div>
		

		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<br><br>
	<h3>Serviços cadastrados</h3>
	<table class="table">
		<thead>
		    <tr>
			      <th scope="col">ID serviço</th>
			      <th scope="col">Nome</th>
			      <th scope="col">Local</th>
			      <th scope="col">Tipo de serviço</th>
			      <th scope="col">Quantidade</th>
			      <th scope="col">Status</th>
			      <th scope="col">Ações</th>
		    </tr>
		</thead>
		<tbody class="allServicos">
			
			
		</tbody>
	</table>


 </div>

<script type="text/javascript">
	
 carregarServicos("tabela");
 carregarTipoServico("option");

</script>


 <?php 
 	include("footer.php");
  ?>