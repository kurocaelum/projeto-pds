<?php 
	include("header.php");
	include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroServicoPredial.php");

	$controleCadastroServico = new ControleCadastroServicoPredial();

 ?>
 <div class="container">
 	<form id="form_servico" action="" method="post">
 		<h3>Cadastro de novo serviço</h3>
 		<input type="hidden" name="addServico">
 		<input type="hidden" name="idServico" id="form_input_id">
		<div class="form-group">
			<div class="form-group">
			    <label for="form_input_nome">Nome</label>
			    <input name="nome" required type="text" class="form-control" id="form_input_nome" placeholder="">
		  	</div>
		  	<div class="form-group">
			    <label for="form_input_local">Local</label>
			    <input name="local" required type="text" class="form-control" id="form_input_local" placeholder="">
		  	</div>
		  	<div class="form-group">
			    <label for="form_input_data">Data</label>
			    <input name="data" required type="date" class="form-control" id="form_input_data" placeholder="">
		  	</div>
		  	
			<label for="form_input_status">Status</label>
			<select name="status" class="form-control" id="form_input_status">

			    <option value="1">Concluído</option>
				<option value="2">Em execução</option>
				<option value="3">Pendente</option>
				<option value="4">Cancelado</option>
			</select>
		  	<br>
		    <label for="listaTiposServicosOption">Tipo de serviço</label>
		    <select class="form-control exibirListaTiposServicosOption" name="tipoServico" id="listaTiposServicosOption">
		    </select>
		   	
		   	<div class="form-group">
			    <label for="exampleInputQuantidade">Quantidade</label>
			    <input name="quantidade" required type="text" class="form-control" id="exampleInputQuantidade" placeholder="">
		  	</div>

		  	<div class="form-group">
			    <label for="form_input_tempo">Tempo para Conclusão (minutos)</label>
			    <input name="tempo" type="text" class="form-control" id="form_input_tempo" placeholder="">
		  	</div>

		  	<div class="form-group">
			    <label for="form_input_tempo">Grau de dificuldade</label>
			    <select name="grau_dificuldade" class="form-control" id="form_input_grau_dificuldade">
				    <option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
		  	</div>

		  	<div class="form-group">
			    <input name="tempo_extra_fixo" type="checkbox" id="form_input_tempo_extra_fixo" placeholder="">
			    <label for="form_input_tempo">Marque caso seja necessário ativar o tempo extra</label>
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
			      <th scope="col">Data</th>
			      <th scope="col">ID Tipo de serviço</th>
			      <th scope="col">Quantidade</th>
			      <th scope="col">Tempo para Conclusão</th>
			      <th scope="col">Status</th>
			      <th scope="col">Grau de dificuldade</th>
			      <th scope="col">Necessário tempo extra</th>
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