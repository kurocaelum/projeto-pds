

// ------------------ Controle Supervisor ---------------------------


jQuery(document).ready(function($){
    $('#form_supervisor').submit(function() {
        var idsAdministrados = "";
        $( "#listaFuncionariosAdministrados option:selected" ).each(function(){
            if($(this).val() != ""){  
                idsAdministrados = idsAdministrados+","+$(this).val(); 
            }
            $("#form_input_id_administrados").val(idsAdministrados);
        });

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


function carregarSupervisores(){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroSupervisor.php',
            async: true,
            data: {"listaSupervisores": true},
            error: function(enviado) {
                    resultCarregarSupervisores(JSON.stringify(enviado));
             },
            success: function(enviado) {
                    resultCarregarSupervisores(JSON.stringify(enviado));
            }    
        });
}


function removerSupervisor(id_remover){
    alert(id_remover);
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroSupervisor.php',
            async: true,
            data: {"excluirSupervisor": id_remover},
        error: function(enviado) {
            resultFormRemoverSupervisor(JSON.stringify(enviado), id_remover);
         },
        success: function(enviado) {
            resultFormRemoverSupervisor(JSON.stringify(enviado), id_remover);
        }    
        });
}
function resultFormRemoverSupervisor(ret, id_remover){
    if(ret == "1"){
        carregarSupervisores();
    }else{
        alert("Erro na remoção.");
    }
}



function resultCarregarSupervisores(listaSupervisores){
    jsonLista = JSON.parse(listaSupervisores);
    var tabelaSupervisores = "";
    for(var k in jsonLista) {
        tabelaSupervisores = tabelaSupervisores+'<tr id="supervisor'+jsonLista[k].id_supervisor+'">';

        tabelaSupervisores = tabelaSupervisores+'<th class="id_supervisor" scope="row">'+jsonLista[k].id_supervisor+'</th>';
        tabelaSupervisores = tabelaSupervisores+'<th class="id_funcionario" scope="row">'+jsonLista[k].id_funcionario+'</th>';
        tabelaSupervisores = tabelaSupervisores+'<th class="id_funcionario_administrados" scope="row">'+jsonLista[k].id_funcionario+'</th>';

        tabelaSupervisores = tabelaSupervisores+'<td class="nome_supervisor">'+jsonLista[k].nome+'</td>';
        tabelaSupervisores = tabelaSupervisores+'<td class="setor_supervisor">'+jsonLista[k].setor+'</td>';
        tabelaSupervisores = tabelaSupervisores+'<td class="email_supervisor">'+jsonLista[k].email+'</td>';
        tabelaSupervisores = tabelaSupervisores+'<td class="telefone_supervisor">'+jsonLista[k].telefone+'</td>';
        tabelaSupervisores = tabelaSupervisores+'<td>';
        tabelaSupervisores = tabelaSupervisores+'       <button type="button" id-editar="'+jsonLista[k].id_supervisor+'" class="editar_supervisor btn btn-info">Editar</button>';
        tabelaSupervisores = tabelaSupervisores+'       <button type="button" id-remove="'+jsonLista[k].id_supervisor+'" class="remover_supervisor btn btn-danger">Excluir</button>';
        tabelaSupervisores = tabelaSupervisores+'</td>';
        tabelaSupervisores = tabelaSupervisores+'</tr>';
    }


    $(".allSupervisores").html("");
    $(".allSupervisores").append(tabelaSupervisores);
    
    $('.remover_supervisor').on('click', function() {
        var id_remover = $(this).attr("id-remove");
        removerSupervisor(id_remover);
    });

    $('.editar_supervisor').on('click', function() {
        var id_editar = $(this).attr("id-editar");
        $("#form_input_id").val( $("#supervisor"+id_editar).find(".id_supervisor").text() );
        $("#form_input_setor").val( $("#supervisor"+id_editar).find(".setor_supervisor").text() );
        $("#listaFuncionariosOption").val( $("#supervisor"+id_editar).find(".id_funcionario").text() );
        
    });

}


// ------------------ FIm Controle Supervisor ---------------------------



// ------------------ Controle Funcionário ---------------------------


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
    var optionFuncionarios = "<option value=''></option> ";
    for(var k in jsonLista) {
        optionFuncionarios = optionFuncionarios+'<option value='+jsonLista[k].id_funcionario+' >'+jsonLista[k].nome+'</option>';
    }

    $(".exibirListaFuncionariosOption").html("");
    $(".exibirListaFuncionariosOption").append(optionFuncionarios);
    
}

// ------------------ FIM Controle Funcionário ---------------------------




// ------------------ Controle Tipo de serviço ---------------------------


jQuery(document).ready(function($){
  


    $('#form_tipo_servico').submit(function() {
        dados = $('#form_tipo_servico').serialize();
            $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'http://pds.dev.anaju.me/business/controller/controleCadastroTipoServico.php',
                    async: true,
                    data: dados,
                error: function(enviado) {
                    resultFormTipoServico(JSON.stringify(enviado));
                 },
                success: function(enviado) {
                    resultFormTipoServico(JSON.stringify(enviado));
                }    
            });
            return false;
        });
        function resultFormTipoServico(ret){
            if(ret == "1"){
                alert("Cadastrado com sucesso.");
                $('#form_tipo_servico')[0].reset();
                carregarTiposServicos("tabela");
            }else{
                alert("Erro no cadastro.");
            }
        }



    


});




function carregarTiposServicos(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroTipoServico.php',
            async: true,
            data: {"listaFuncionarios": true},
        error: function(enviado) {
            if(tipo == "tabela"){
                resultCarregarTipoServico(JSON.stringify(enviado));
            }else{
                resultCarregarOptionTiposServicos(JSON.stringify(enviado));
            }
         },
        success: function(enviado) {
            if(tipo == "tabela"){
                resultCarregarTipoServico(JSON.stringify(enviado));
            }else{
                resultCarregarOptionTiposServicos(JSON.stringify(enviado));
            }
        }    
        });
}


function removerTipoServico(id_remover){
    alert(id_remover);
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroTipoServico.php',
            async: true,
            data: {"excluirFuncionario": id_remover},
        error: function(enviado) {
            resultFormRemoverTipoServico(JSON.stringify(enviado), id_remover);
         },
        success: function(enviado) {
            resultFormRemoverTipoServico(JSON.stringify(enviado), id_remover);
        }    
        });
}
function resultFormRemoverTipoServico(ret, id_remover){
    if(ret == "1"){
        carregarTiposServicos("tabela");
    }else{
        alert("Erro na remoção.");
    }
}



function resultCarregarTiposServicos(listaTiposServicos){
    jsonLista = JSON.parse(listaFuncionarios);
    var tabelaTiposServicos = "";
    for(var k in jsonLista) {
        tabelaTiposServicos = tabelaTiposServicos+'<tr id="tipo_servico'+jsonLista[k].id_tipo_servico+'">';

        tabelaTiposServicos = tabelaTiposServicos+'<th class="id_tipo_servico" scope="row">'+jsonLista[k].id_tipo_servico+'</th>';
        tabelaTiposServicos = tabelaTiposServicos+'<td class="nome_tipo_servico">'+jsonLista[k].nome+'</td>';
        tabelaTiposServicos = tabelaTiposServicos+'<td class="unidade_tipo_servico">'+jsonLista[k].unidade+'</td>';
        tabelaTiposServicos = tabelaTiposServicos+'<td class="form_input_tempo">'+jsonLista[k].tempo+'</td>';
        tabelaTiposServicos = tabelaTiposServicos+'<td>';
        tabelaTiposServicos = tabelaTiposServicos+'       <button type="button" id-editar="'+jsonLista[k].id_tipo_servico+'" class="editar_tipo_servico btn btn-info">Editar</button>';
        tabelaTiposServicos = tabelaTiposServicos+'       <button type="button" id-remove="'+jsonLista[k].id_tipo_servico+'" class="remover_tipo_servico btn btn-danger">Excluir</button>';
        tabelaTiposServicos = tabelaTiposServicos+'</td>';
        tabelaTiposServicos = tabelaTiposServicos+'</tr>';
    }

    $(".allTiposServicos").html("");
    $(".allTiposServicos").append(tabelaTiposServicos);
    
    $('.remover_tipo_servico').on('click', function() {
        var id_remover = $(this).attr("id-remove");
        removerTipoServico(id_remover);
    });

    $('.editar_tipo_servico').on('click', function() {
        var id_editar = $(this).attr("id-editar");
        $("#form_input_id").val( $("#tipo_servico"+id_editar).find(".id_tipo_servico").text() );
        $("#form_input_nome").val( $("#tipo_servico"+id_editar).find(".nome_tipo_servico").text() );
        $("#form_input_unidade").val( $("#tipo_servico"+id_editar).find(".unidade_tipo_servico").text() );
        $("#form_input_tempo").val( $("#tipo_servico"+id_editar).find(".telefone_tipo_servico").text() );
    });

}




function resultCarregarOptionTiposServicos(listaTiposServicos){
    jsonLista = JSON.parse(listaFuncionarios);
    var optionFuncionarios = "";
    for(var k in jsonLista) {
        optionFuncionarios = optionFuncionarios+'<option value='+jsonLista[k].id_funcionario+' >'+jsonLista[k].nome+'</option>';
    }

    $(".exibirListaFuncionariosOption").html("");
    $(".exibirListaFuncionariosOption").append(optionFuncionarios);
    
   

}

// ------------------ FIM Controle Tipo Serviço ---------------------------
