
jQuery(document).ready(function($){

	$('#form_funcionario').submit(function() {
        dados = $('#form_funcionario').serialize();
            $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'http://pds.dev.anaju.me/business/controller/controleCadastroFuncionario.php',
                    async: true,
                    data: dados,
                error: function(enviado) {
                	resultFormFoncionario(JSON.stringify(enviado));
                 },
                success: function(enviado) {
                	resultFormFoncionario(JSON.stringify(enviado));
                }    
       	 	});
            return false;
        });
    	function resultFormFoncionario(ret){
         	if(ret == "1"){
                alert("Cadastrado com sucesso.");
                $('#form_funcionario')[0].reset();
                carregarFuncionarios("tabela");
            }else{
                alert("Erro no cadastro.");
            }
    	}

    $('#form_supervisor').submit(function() {
        dados = $('#form_supervisor').serialize();
            $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'http://pds.dev.anaju.me/business/controller/controleCadastroSupervisor.php',
                    async: true,
                    data: dados,
                error: function(enviado) {
                    resultFormSupervisor(JSON.stringify(enviado));
                 },
                success: function(enviado) {
                    resultFormSupervisor(JSON.stringify(enviado));
                }    
            });
            return false;
        });
        function resultFormSupervisor(ret){
            if(ret == "1"){
                alert("Cadastrado com sucesso.");
                $('#form_supervisor')[0].reset();
                // carregarFuncionarios();
            }else{
                alert("Erro no cadastro.");
            }
        }

    


});




function carregarFuncionarios(tipo){
	$.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroFuncionario.php',
            async: true,
            data: {"listaFuncionarios": true},
        error: function(enviado) {
            if(tipo == "tabela"){
                resultCarregarFuncionarios(JSON.stringify(enviado));
            }else{
                resultCarregarOptionFuncionarios(JSON.stringify(enviado));
            }
         },
        success: function(enviado) {
        	if(tipo == "tabela"){
                resultCarregarFuncionarios(JSON.stringify(enviado));
            }else{
                resultCarregarOptionFuncionarios(JSON.stringify(enviado));
            }
        }    
	 	});
}


function removerFuncionario(id_remover){
	alert(id_remover);
	$.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroFuncionario.php',
            async: true,
            data: {"excluirFuncionario": id_remover},
        error: function(enviado) {
        	resultFormRemoverFuncionario(JSON.stringify(enviado), id_remover);
         },
        success: function(enviado) {
        	resultFormRemoverFuncionario(JSON.stringify(enviado), id_remover);
        }    
	 	});
}
function resultFormRemoverFuncionario(ret, id_remover){
 	if(ret == "1"){
 		carregarFuncionarios("tabela");
    }else{
        alert("Erro na remoção.");
    }
}



function resultCarregarFuncionarios(listaFuncionarios){
	jsonLista = JSON.parse(listaFuncionarios);
	var tabelaFuncionarios = "";
	for(var k in jsonLista) {
	    tabelaFuncionarios = tabelaFuncionarios+'<tr id="funcionario'+jsonLista[k].id_funcionario+'">';

		tabelaFuncionarios = tabelaFuncionarios+'<th class="id_funcionario" scope="row">'+jsonLista[k].id_funcionario+'</th>';
		tabelaFuncionarios = tabelaFuncionarios+'<td class="nome_funcionario">'+jsonLista[k].nome+'</td>';
		tabelaFuncionarios = tabelaFuncionarios+'<td class="telefone_funcionario">'+jsonLista[k].telefone+'</td>';
		tabelaFuncionarios = tabelaFuncionarios+'<td class="email_funcionario">'+jsonLista[k].email+'</td>';
		tabelaFuncionarios = tabelaFuncionarios+'<td>';
		tabelaFuncionarios = tabelaFuncionarios+'		<button type="button" id-editar="'+jsonLista[k].id_funcionario+'" class="editar_funcionario btn btn-info">Editar</button>';
		tabelaFuncionarios = tabelaFuncionarios+'		<button type="button" id-remove="'+jsonLista[k].id_funcionario+'" class="remover_funcionario btn btn-danger">Excluir</button>';
		tabelaFuncionarios = tabelaFuncionarios+'</td>';
    	tabelaFuncionarios = tabelaFuncionarios+'</tr>';
	}

	$(".allFuncionarios").html("");
	$(".allFuncionarios").append(tabelaFuncionarios);
	
	$('.remover_funcionario').on('click', function() {
		var id_remover = $(this).attr("id-remove");
		removerFuncionario(id_remover);
	});

	$('.editar_funcionario').on('click', function() {
		var id_editar = $(this).attr("id-editar");
		$("#form_input_id").val( $("#funcionario"+id_editar).find(".id_funcionario").text() );
		$("#form_input_nome").val( $("#funcionario"+id_editar).find(".nome_funcionario").text() );
		$("#form_input_email").val( $("#funcionario"+id_editar).find(".email_funcionario").text() );
		$("#form_input_telefone").val( $("#funcionario"+id_editar).find(".telefone_funcionario").text() );
	});

}




function resultCarregarOptionFuncionarios(listaFuncionarios){
    jsonLista = JSON.parse(listaFuncionarios);
    var optionFuncionarios = "";
    for(var k in jsonLista) {
        optionFuncionarios = optionFuncionarios+'<option value='+jsonLista[k].id_funcionario+' >'+jsonLista[k].nome+'</option>';
    }

    $("#listaFuncionariosOption").html("");
    $("#listaFuncionariosOption").append(optionFuncionarios);
    
   

}