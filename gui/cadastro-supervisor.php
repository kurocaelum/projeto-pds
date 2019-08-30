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
		<div class="form-group">
			<div class="form-group">
			    <label for="exampleInputEmail1">Descrição</label>
			    <input name="setor" type="text" class="form-control" id="exampleInputEmail1" placeholder="Setor">
		  	</div>
		    <label for="listaFuncionariosOption">Funcionário supervisor</label>
		    <select class="form-control" name="funcionarioSupervisor" id="listaFuncionariosOption">
		    </select>
		 </div>
		<div class="form-group">
		    <label for="exampleFormControlSelect2">Funcionários administrados</label>
		    <select multiple name="funcionarioAdministrados" class="form-control" id="exampleFormControlSelect2">
		    	<option>1</option>
		    	<option>2</option>
		    	<option>3</option>
		    	<option>4</option>
		    	<option>5</option>
		    </select>
		</div>


		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

	<br><br>
	<h3>Supervisores cadastrados</h3>
	<table class="table">
		<thead>
		    <tr>
			      <th scope="col">ID supervisor</th>
			      <th scope="col">ID funcionário</th>
			      <th scope="col">Nome</th>
			      <th scope="col">Setor</th>
			      <th scope="col">Email</th>
			      <th scope="col">Telefone</th>
			      <th scope="col">Ações</th>
		    </tr>
		</thead>
		<tbody class="allFuncionarios">
			
			
		</tbody>
	</table>


 </div>

<script type="text/javascript">
	
	carregarFuncionarios("option");


</script>


 <?php 
 	include("footer.php");
  ?>