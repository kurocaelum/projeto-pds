<?php 
	include("header.php");
	include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroTipoServicoPredial.php");

	// $controleCadastroTipoServico = new ControleCadastroTipoServicoPredial();

 ?>
 <div class="container">
 	<form id="form_tipo_servico" action="" method="post">
 		<h3>Cadastro de novo tipo de servico</h3>
 		<input type="hidden" name="addTipoServico">
 		<input type="hidden" name="idTipoServico" id="form_input_id">
		<div class="form-group">
			<label for="form_input_nome">Nome</label>
			<input name="nome" required type="text" class="form-control" id="form_input_nome" placeholder="">
		</div>

		<div class="form-group">
			<label for="form_input_unidade">Unidade de medida</label>
			<input name="unidade" required type="text" class="form-control" id="form_input_unidade" placeholder="">
		</div>

		<div class="form-group">
			<label for="form_input_tempo">Tempo em minutos para cada unidade</label>
			<input name="tempo" required type="text" class="form-control" id="form_input_tempo" placeholder="">
		</div>
		

		<div class="form-group">
			<label for="form_input_tempo">Tempo em minutos para remoção de cada unidade</label>
			<input name="tempo_remocao" required type="text" class="form-control" id="form_input_tempo" placeholder="">
		</div>

		<div class="form-group">
			<label for="form_input_tempo">Porcentagem de tempo reduzida por ajudante</label>
			<input name="porcentagem_ajudante" required type="text" class="form-control" id="form_input_tempo" placeholder="">
		</div>


		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<br><br>
	<h3>Tipos de serviços cadastrados</h3>
	<table class="table">
		<thead>
		    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">Nome</th>
			      <th scope="col">Unidade</th>
			      <th scope="col">Tempo</th>
			      <th scope="col">Tempo para remoção</th>
			      <th scope="col">Porcentagem tempo ajudante</th>
			      <th scope="col">Ações</th> 
		    </tr>
		</thead>
		<tbody class="allTiposServicos">
			
			
		</tbody>
	</table>


 </div>

<script type="text/javascript">
	
	carregarTipoServico("tabela");

</script>


 <?php 
 	include("footer.php");
  ?>