<?php 
	include("header.php");
	include($_SERVER["DOCUMENT_ROOT"]."/business/controller/controleCadastroSupervisor.php");

	$controleCadastroSupervisor = new ControleCadastroSupervisor();

 ?>
 <div class="container">
 	<form id="form_supervisor" action="" method="post">
 		<h3>Cadastro de supervisor</h3>
 		<input type="hidden" name="addSupervisor">
 		<input type="hidden" name="idSupervisor" id="form_input_id">
 		<input type="hidden" name="idAdministrados" id="form_input_id_administrados">

		<div class="form-group">
			<div class="form-group">
			    <label for="form_input_setor">Setor</label>
			    <input name="setor" type="text" class="form-control" id="form_input_setor" placeholder="Setor">
		  	</div>
		    <label for="listaFuncionariosOption">Funcionário supervisor</label>
		    <select class="form-control exibirListaFuncionariosOption" name="funcionarioSupervisor" id="listaFuncionariosOption">
		    </select>
		 </div>
		<!-- <div class="form-group">
		    <label for="listaFuncionariosAdministrados">Funcionários administrados</label>
		    <select multiple name="funcionarioAdministrados" class="exibirListaFuncionariosOption form-control" id="listaFuncionariosAdministrados">
		    </select>
		</div> -->


		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<br><br>
	<h3>Supervisores cadastrados</h3>
	<table class="table">
		<thead>
		    <tr>
			      <th scope="col">ID supervisor</th>
			      <th scope="col">ID funcionário</th>
			      <!-- <th scope="col">ID funcionário administrados</th> -->
			      <th scope="col">Nome</th>
			      <th scope="col">Setor</th>
			      <th scope="col">Email</th>
			      <th scope="col">Telefone</th>
			      <th scope="col">Ações</th>
		    </tr>
		</thead>
		<tbody class="allSupervisores">
			
			
		</tbody>
	</table>


 </div>

<script type="text/javascript">
	
	carregarFuncionarios("option");
	carregarSupervisores("tabela");


</script>


 <?php 
 	include("footer.php");
  ?>