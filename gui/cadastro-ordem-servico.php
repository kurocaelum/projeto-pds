<?php 
	include("header.php");
	include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroOrdemServico.php");

	$controleCadastroOrdemServico = new ControleCadastroOrdemServico();

 ?>
 <div class="container">
 	<form id="form_ordem_servico" action="" method="post">
 		<h3>Cadastro de nova ordem de serviço</h3>
 		<input type="hidden" name="addOrdemServico">
 		<input type="hidden" name="idOrdemServico" id="form_input_id">
 		<input type="hidden" id="ids_servicos" name="ids_servicos">
 		<input type="hidden" id="ids_funcionarios" name="ids_funcionarios">

		<div class="form-group">
			<label for="form_input_descricao">Descrição</label>
			<input name="descricao" required type="text" class="form-control" id="form_input_descricao" placeholder="Descrição">
		</div>

	<!-- 	<div class="form-group">
			<label for="form_input_id_supervisor_chefe">Supervisor chefe</label>
		    <select class="form-control exibirListaSupervisoresOption" name="supervisor_chefe" id="form_input_id_supervisor_chefe">
		    </select>
		</div> -->

		<div class="form-group">
			<label for="form_input_servicos">Serviços</label><br>
			<select name="servicos" id="form_input_servicos" class="custom-select exibirListaServicosOption" multiple>
			</select>
		</div>


		<div class="form-group">
			<label for="form_input_funcionarios">Funcionários alocados</label><br>
			<select name="funcionarios" id="form_input_funcionarios" class="custom-select exibirListaFuncionariosOption" multiple>
			</select>
		</div>



		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<br><br>
	<h3>Ordem de serviço cadastradas</h3>
	<table class="table">
		<thead>
		    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">Descrição</th>
			      <th scope="col">Funcionários</th>
			      <th scope="col">Serviços</th>
			      <th scope="col">Ações</th>
		    </tr>
		</thead>
		<tbody class="allOrdemServicos">
			
			
		</tbody>
	</table>


 </div>

<script type="text/javascript">
	
	carregarFuncionarios("option");
	carregarServicos("option");
	carregarOrdemServicos("tabela");

</script>


 <?php 
 	include("footer.php");
  ?>