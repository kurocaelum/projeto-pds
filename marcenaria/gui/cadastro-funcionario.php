<?php 
	include("header.php");
	include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroFuncionario.php");

	$controleCadastrofuncionario = new ControleCadastrofuncionario();

 ?>
 <div class="container">
 	<form id="form_funcionario" action="" method="post">
 		<h3>Cadastro de novo funcionário</h3>
 		<input type="hidden" name="addFuncionario">
 		<input type="hidden" name="idFuncionario" id="form_input_id">
		<div class="form-group">
			<label for="form_input_nome">Nome</label>
			<input name="nome" required type="text" class="form-control" id="form_input_nome" placeholder="Nome">
		</div>

		<div class="form-group">
			<label for="form_input_email">Email</label>
			<input name="email" required type="email" class="form-control" id="form_input_email" placeholder="Email">
		</div>

		<div class="form-group">
			<label for="form_input_telefone">Telefone</label>
			<input name="telefone" required type="text" class="form-control" id="form_input_telefone" placeholder="Telefone">
		</div>
		<div class="form-group">
			<label for="form_input_id_supervisor_chefe">Supervisor chefe</label>
		    <select class="form-control exibirListaSupervisoresOption" name="supervisor_chefe" id="form_input_id_supervisor_chefe">
		    </select>
		</div>


		  <button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<br><br>
	<h3>Funcionários cadastrados</h3>
	<table class="table">
		<thead>
		    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">ID supervisor chefe</th>
			      <th scope="col">Nome</th>
			      <th scope="col">Telefone</th>
			      <th scope="col">Email</th>
			      <th scope="col">Ações</th>
		    </tr>
		</thead>
		<tbody class="allFuncionarios">
			
			
		</tbody>
	</table>


 </div>

<script type="text/javascript">
	
	carregarFuncionarios("tabela");
	carregarSupervisores("option");

</script>


 <?php 
 	include("footer.php");
  ?>