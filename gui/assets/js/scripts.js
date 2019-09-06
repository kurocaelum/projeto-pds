// ------------------ Controle servico ---------------------------


jQuery(document).ready(function($){
    $('#form_servico').submit(function() {
    
        dados = $('#form_servico').serialize();

        $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
                async: true,
                data: dados,
            error: function(enviado) {
                resultFormServico(JSON.stringify(enviado));
             },
            success: function(enviado) {
                resultFormServico(JSON.stringify(enviado));
            }    
        });

        return false;

    });

    function resultFormServico(ret){
        if(ret == "1"){
            alert("Cadastrado com sucesso.");
            $('#form_servico')[0].reset();
            carregarServicos("tabela");
        }else{
            alert("Erro no cadastro.");
        }
    }



});


function carregarServicos(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
            async: true,
            data: {"listaServicos": true},
            error: function(enviado) {
                if(tipo == "tabela"){   
                    resultCarregarServicos(JSON.stringify(enviado));
                }
                if(tipo == "option"){   
                    resultCarregarOptionServicos(JSON.stringify(enviado));
                }
             },
            success: function(enviado) {
                if(tipo == "tabela"){   
                    resultCarregarServicos(JSON.stringify(enviado));
                }
                if(tipo == "option"){   
                    resultCarregarOptionServicos(JSON.stringify(enviado));
                }
            }    
        });
}


function removerServico(id_remover){
    
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
            async: true,
            data: {"excluirServico": id_remover},
        error: function(enviado) {
            resultFormRemoverServico(JSON.stringify(enviado), id_remover);
         },
        success: function(enviado) {
            resultFormRemoverServico(JSON.stringify(enviado), id_remover);
        }    
        });
}
function resultFormRemoverServico(ret, id_remover){
    if(ret == "1"){
        alert("Serviço removido.");
        carregarServicos("tabela");

    }else{
        alert("Erro na remoção.");
    }
}


function resultCarregarOptionServicos(listaServicos){
    jsonLista = JSON.parse(listaServicos);
    var optionServicos = "<option value=''></option> ";
    for(var k in jsonLista) {
        optionServicos = optionServicos+'<option value='+jsonLista[k].id_supervisor+' >'+jsonLista[k].nome+'</option>';
    }

    $(".exibirListaServicosOption").html("");
    $(".exibirListaServicosOption").append(optionServicos);
    
}


function resultCarregarServicos(listaServicos){
    jsonLista = JSON.parse(listaServicos);
    var tabelaServicos = "";
    for(var k in jsonLista) {
        tabelaServicos = tabelaServicos+'<tr id="servico'+jsonLista[k].id_servico+'">';
        tabelaServicos = tabelaServicos+'<th class="id_servico" scope="row">'+jsonLista[k].id_servico+'</th>';

        tabelaServicos = tabelaServicos+'<td class="nome_servico">'+jsonLista[k].nome+'</td>';

        tabelaServicos = tabelaServicos+'<td class="local_servico">'+jsonLista[k].localizacao+'</td>';
        tabelaServicos = tabelaServicos+'<td class="id_tipo_servico">'+jsonLista[k].id_tipo_servico+'</td>';
        tabelaServicos = tabelaServicos+'<td class="quantidade_servico">'+jsonLista[k].quantidade+'</td>';
        tabelaServicos = tabelaServicos+'<td class="status_supervisor">'+jsonLista[k].status+'</td>';
        tabelaServicos = tabelaServicos+'<td>';
        tabelaServicos = tabelaServicos+'       <button type="button" id-editar="'+jsonLista[k].id_servico+'" class="editar_servico btn btn-info">Editar</button>';
        tabelaServicos = tabelaServicos+'       <button type="button" id-remove="'+jsonLista[k].id_servico+'" class="remover_servico btn btn-danger">Excluir</button>';
        tabelaServicos = tabelaServicos+'</td>';
        tabelaServicos = tabelaServicos+'</tr>';
    }


    $(".allServicos").html("");
    $(".allServicos").append(tabelaServicos);
    
    $('.remover_servico').on('click', function() {
        var id_remover = $(this).attr("id-remove");
        removerServico(id_remover);
        carregarServicos("tabela");
    });

    $('.editar_servico').on('click', function() {
        var id_editar = $(this).attr("id-editar");
        $("#form_input_id").val( $("#servico"+id_editar).find(".id_servico").text() );
        $("#form_input_nome").val( $("#servico"+id_editar).find(".nome_servico").text() );
        $("#form_input_local").val( $("#servico"+id_editar).find(".local_servico").text() );
        $("#form_input_data").val( $("#servico"+id_editar).find(".data").text() );
        $("#form_input_status").val( $("#servico"+id_editar).find(".status_supervisor").text() );
        $("#exampleInputQuantidade").val( $("#servico"+id_editar).find(".quantidade_servico").text() );
        $("#listaTiposServicosOption").val( $("#servico"+id_editar).find(".id_tipo_servico").text() );
    });

}


// ------------------ FIm Controle servico ---------------------------




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
                url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
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
            carregarSupervisores("tabela");
        }else{
            alert("Erro no cadastro.");
        }
    }



});


function carregarSupervisores(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
            async: true,
            data: {"listaSupervisores": true},
            error: function(enviado) {
                if(tipo == "tabela"){   
                    resultCarregarSupervisores(JSON.stringify(enviado));
                }
                if(tipo == "option"){   
                    resultCarregarOptionSupervisores(JSON.stringify(enviado));
                }
             },
            success: function(enviado) {
                if(tipo == "tabela"){   
                    resultCarregarSupervisores(JSON.stringify(enviado));
                }
                if(tipo == "option"){   
                    resultCarregarOptionSupervisores(JSON.stringify(enviado));
                }
            }    
        });
}


function removerSupervisor(id_remover){
    alert(id_remover);
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
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
        carregarSupervisores("tabela");

    }else{
        alert("Erro na remoção.");
    }
}


function resultCarregarOptionSupervisores(listaSupervisores){
    jsonLista = JSON.parse(listaSupervisores);
    var optionSupervisores = "<option value=''></option> ";
    for(var k in jsonLista) {
        optionSupervisores = optionSupervisores+'<option value='+jsonLista[k].id_supervisor+' >'+jsonLista[k].nome+'</option>';
    }

    $(".exibirListaSupervisoresOption").html("");
    $(".exibirListaSupervisoresOption").append(optionSupervisores);
    
}


function resultCarregarSupervisores(listaSupervisores){
    jsonLista = JSON.parse(listaSupervisores);
    var tabelaSupervisores = "";
    for(var k in jsonLista) {
        tabelaSupervisores = tabelaSupervisores+'<tr id="supervisor'+jsonLista[k].id_supervisor+'">';

        tabelaSupervisores = tabelaSupervisores+'<th class="id_supervisor" scope="row">'+jsonLista[k].id_supervisor+'</th>';
        tabelaSupervisores = tabelaSupervisores+'<th class="id_funcionario" scope="row">'+jsonLista[k].id_funcionario+'</th>';

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
        carregarSupervisores("tabela");
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
        tabelaFuncionarios = tabelaFuncionarios+'<th class="id_supervisor_chefe" scope="row">'+jsonLista[k].id_supervisor_chefe+'</th>';

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
        $("#form_input_id_supervisor_chefe").val( $("#funcionario"+id_editar).find(".id_supervisor_chefe").text() );
        
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
                    url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
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
                carregarTipoServico("tabela");
            }else{
                alert("Erro no cadastro.");
            }
        }



    


});




function carregarTipoServico(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
            async: true,
            data: {"listaTipoServicos": true}, // listaFuncionarios?
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
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/services/ajaxGeral.php',
            async: true,
            data: {"excluirTipoServico": id_remover},
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
        carregarTipoServico("tabela");
    }else{
        alert("Erro na remoção.");
    }
}



function resultCarregarTipoServico(listaTiposServicos){
    jsonLista = JSON.parse(listaTiposServicos);
    var tabelaTiposServicos = "";
    for(var k in jsonLista) {
        tabelaTiposServicos = tabelaTiposServicos+'<tr id="tipo_servico'+jsonLista[k].id_tipo_servico+'">';

        tabelaTiposServicos = tabelaTiposServicos+'<th class="id_tipo_servico" scope="row">'+jsonLista[k].id_tipo_servico+'</th>';
        tabelaTiposServicos = tabelaTiposServicos+'<td class="nome_tipo_servico">'+jsonLista[k].nome+'</td>';
        tabelaTiposServicos = tabelaTiposServicos+'<td class="unidade_tipo_servico">'+jsonLista[k].unidade_medida+'</td>';
        tabelaTiposServicos = tabelaTiposServicos+'<td class="tempo_tipo_servico">'+jsonLista[k].tempo+'</td>';
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
        $("#form_input_tempo").val( $("#tipo_servico"+id_editar).find(".tempo_tipo_servico").text() );
    });

}




function resultCarregarOptionTiposServicos(listaTiposServicos){
    jsonLista = JSON.parse(listaTiposServicos);
    var optionTiposServicos = "<option value=''></option> ";
    for(var k in jsonLista) {
        optionTiposServicos = optionTiposServicos+'<option value='+jsonLista[k].id_tipo_servico+' >'+jsonLista[k].nome+'</option>';
    }

    $(".exibirListaTiposServicosOption").html("");
    $(".exibirListaTiposServicosOption").append(optionTiposServicos);
    
   

}

// ------------------ FIM Controle Tipo Serviço ---------------------------
