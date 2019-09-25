// ------------------ Controle Ordem servico ---------------------------


jQuery(document).ready(function($){
    $('#form_ordem_servico').submit(function() {
        var ids_servicos = "";
        $( "#form_input_servicos option:selected" ).each(function(){
            if(ids_servicos != ""){
                ids_servicos = ids_servicos+",";
            }
            if($(this).val() != ""){  
                ids_servicos = ids_servicos + $(this).val(); 
            }
            $("#ids_servicos").val(ids_servicos);
        });

        var ids_funcionarios = "";
        $( "#form_input_funcionarios option:selected" ).each(function(){
            if(ids_funcionarios != ""){
                ids_funcionarios = ids_funcionarios+",";
            }
            if($(this).val() != ""){  
               ids_funcionarios = ids_funcionarios + $(this).val(); 
            }
            $("#ids_funcionarios").val(ids_funcionarios);
        });
    

        dados = $('#form_ordem_servico').serialize();

        $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'http://pds.dev.anaju.me/business/controller/controleCadastroOrdemServico.php',
                async: true,
                data: dados,
            error: function(enviado) {
                resultFormOrdemServico(JSON.stringify(enviado));
             },
            success: function(enviado) {
                resultFormOrdemServico(JSON.stringify(enviado));
            }    
        });

        return false;

    });

    function resultFormOrdemServico(ret){
        if(ret == "1"){
            alert("Cadastrado com sucesso.");
            $('#form_ordem_servico')[0].reset();
            carregarOrdemServicos("tabela");
        }else{
            alert(JSON.parse(ret).responseText);
        }
    }



});


function carregarOrdemServicos(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroOrdemServico.php',
            async: true,
            data: {"listaOrdemServicos": true},
            error: function(enviado) {
                if(tipo == "tabela"){   
                    resultCarregarOrdemServicos(JSON.stringify(enviado));
                }
                if(tipo == "option"){   
                    resultCarregarOptionOrdemServicos(JSON.stringify(enviado));
                }
             },
            success: function(enviado) {
                if(tipo == "tabela"){   
                    resultCarregarOrdemServicos(JSON.stringify(enviado));
                }
                if(tipo == "option"){   
                    resultCarregarOptionOrdemServicos(JSON.stringify(enviado));
                }
            }    
        });
}


function removerOrdemServico(id_remover){
    
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroOrdemServico.php',
            async: true,
            data: {"excluirOrdemServico": id_remover},
        error: function(enviado) {
            resultFormRemoverOrdemServico(JSON.stringify(enviado), id_remover);
         },
        success: function(enviado) {
            resultFormRemoverOrdemServico(JSON.stringify(enviado), id_remover);
        }    
        });
}
function resultFormRemoverOrdemServico(ret, id_remover){
    if(ret == "1"){
        alert("Ordem de serviço removido.");
        carregarOrdemServicos("tabela");

    }else{
        alert(JSON.parse(ret).responseText);
    }
}


function resultCarregarOptionOrdemServicos(listaServicos){
    jsonLista = JSON.parse(listaServicos);
    var optionServicos = "<option value=''></option> ";
    for(var k in jsonLista) {
        optionServicos = optionServicos+'<option value='+jsonLista[k].id_servico+' >'+jsonLista[k].nome+'</option>';
    }

    $(".exibirListaServicosOption").html("");
    $(".exibirListaServicosOption").append(optionServicos);
    
}


function resultCarregarOrdemServicos(listaOrdemServicos){
    jsonLista = JSON.parse(listaOrdemServicos);
    var tabelaServicos = "";
    var idsListaServicos = "";
    var idsListaFuncionarios = "";
    for(var k in jsonLista) {
        idsListaServicos = "";
        idsListaFuncionarios = "";

        if(jsonLista[k].listaServicos != null){        
            for(var i in jsonLista[k].listaServicos){
                if(idsListaServicos != ""){
                    idsListaServicos = idsListaServicos+", ";
                }    
                idsListaServicos = idsListaServicos +jsonLista[k].listaServicos[i];
            };
        }

        if(jsonLista[k].listaFuncionarios != null){ 
              for(var i in jsonLista[k].listaFuncionarios){
                if(idsListaFuncionarios != ""){
                    idsListaFuncionarios = idsListaFuncionarios+", ";
                } 
                idsListaFuncionarios = idsListaFuncionarios +jsonLista[k].listaFuncionarios[i];
            };  
        }

        tabelaServicos = tabelaServicos+'<tr id="ordem_servico'+jsonLista[k].idOrdemServico+'">';
        tabelaServicos = tabelaServicos+'<th class="id_ordem_servico" scope="row">'+jsonLista[k].idOrdemServico+'</th>';

        tabelaServicos = tabelaServicos+'<td class="descricao_ordem_servico">'+jsonLista[k].descricao+'</td>';

        tabelaServicos = tabelaServicos+'<td attr_id="'+idsListaFuncionarios+'" class="funcionarios_ordem_servico">'+idsListaFuncionarios+'</td>';
        tabelaServicos = tabelaServicos+'<td attr_id="'+idsListaServicos+'" class="servicos_ordem_servico">'+idsListaServicos+'</td>';
        tabelaServicos = tabelaServicos+'<td>';
        tabelaServicos = tabelaServicos+'       <a href="http://pds.dev.anaju.me/gui/relatorio_os.php/?os='+jsonLista[k].idOrdemServico+'"><button type="button" class="editar_servico btn btn-info">Ver relatório</button></a>';
        tabelaServicos = tabelaServicos+'       <button type="button" id-editar="'+jsonLista[k].idOrdemServico+'" class="editar_ordem_servico btn btn-info">Editar</button>';
        tabelaServicos = tabelaServicos+'       <button type="button" id-remove="'+jsonLista[k].idOrdemServico+'" class="remover_ordem_servico btn btn-danger">Excluir</button>';
        tabelaServicos = tabelaServicos+'</td>';
        tabelaServicos = tabelaServicos+'</tr>';
    }


    $(".allOrdemServicos").html("");
    $(".allOrdemServicos").append(tabelaServicos);
    
    $('.remover_ordem_servico').on('click', function() {
        var id_remover = $(this).attr("id-remove");
        removerOrdemServico(id_remover);
        carregarOrdemServicos("tabela");
    });

    $('.editar_ordem_servico').on('click', function() {
        var id_editar = $(this).attr("id-editar");
        $("#form_input_id").val( $("#ordem_servico"+id_editar).find(".id_ordem_servico").text() );
        $("#form_input_descricao").val( $("#ordem_servico"+id_editar).find(".descricao_ordem_servico").text() );
        
        var ordem_servico_array_servicos = ($("#ordem_servico"+id_editar).find(".servicos_ordem_servico").attr("attr_id")).split(",");
        var ordem_servico_array_tratado_servicos = [];

        var ordem_servico_array_funcionarios = ($("#ordem_servico"+id_editar).find(".funcionarios_ordem_servico").attr("attr_id")).split(",");
        var ordem_servico_array_tratado_funcionarios = [];

        for (var i = 0; i < ordem_servico_array_funcionarios.length; i++) {
            ordem_servico_array_tratado_funcionarios.push(ordem_servico_array_funcionarios[i].replace(" ",""));
        };
        for (var i = 0; i < ordem_servico_array_servicos.length; i++) {
            ordem_servico_array_tratado_servicos.push(ordem_servico_array_servicos[i].replace(" ",""));
        };

        $("#form_input_funcionarios").val(ordem_servico_array_tratado_funcionarios);
        $("#form_input_servicos").val(ordem_servico_array_tratado_servicos);
        // $("#form_input_servicos").val( ["+$("#ordem_servico"+id_editar).find(".servicos_ordem_servico").attr("attr_id") + "]);
    });

}


// ------------------ FIm Controle Ordem servico ---------------------------  



// ------------------ Controle servico ---------------------------


jQuery(document).ready(function($){
    $('#form_servico').submit(function() {
    
        dados = $('#form_servico').serialize();

        $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'http://pds.dev.anaju.me/business/controller/controleCadastroServico.php',
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
            alert(JSON.parse(ret).responseText);
        }
    }



});


function carregarServicos(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroServico.php',
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
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroServico.php',
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
        alert(JSON.parse(ret).responseText);
    }
}


function resultCarregarOptionServicos(listaServicos){
    jsonLista = JSON.parse(listaServicos);
    var optionServicos = "<option value=''></option> ";
    for(var k in jsonLista) {
        optionServicos = optionServicos+'<option value='+jsonLista[k].id_servico+' >'+jsonLista[k].nome+'</option>';
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
        tabelaServicos = tabelaServicos+'<td class="data_servico">'+jsonLista[k].data_cadastro+'</td>';
        tabelaServicos = tabelaServicos+'<td class="id_tipo_servico">'+jsonLista[k].id_tipo_servico+'</td>';
        tabelaServicos = tabelaServicos+'<td class="quantidade_servico">'+jsonLista[k].quantidade+'</td>';
        tabelaServicos = tabelaServicos+'<td class="tempo_conclusao">'+jsonLista[k].tempo_conclusao+'</td>';
        switch(jsonLista[k].status){
            case "1": tabelaServicos = tabelaServicos+'<td attr-cod= '+jsonLista[k].status+' class="status_servico">'+'Concluído'+'</td>'; break;
            case "2": tabelaServicos = tabelaServicos+'<td attr-cod= '+jsonLista[k].status+' class="status_servico">'+'Em Execução'+'</td>'; break;
            case "3": tabelaServicos = tabelaServicos+'<td attr-cod= '+jsonLista[k].status+' class="status_servico">'+'Pendente'+'</td>'; break;
            case "4": tabelaServicos = tabelaServicos+'<td attr-cod= '+jsonLista[k].status+' class="status_servico">'+'Cancelado'+'</td>'; break;
        }
        tabelaServicos = tabelaServicos+'<td>';
        tabelaServicos = tabelaServicos+'       <a href=""><button type="button" class="editar_servico btn btn-info">Ver relatório</button></a>';
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
        $("#form_input_data").val( $("#servico"+id_editar).find(".data_servico").text() );
        $("#form_input_status").val( $("#servico"+id_editar).find(".status_servico").attr("attr-cod") );
        $("#exampleInputQuantidade").val( $("#servico"+id_editar).find(".quantidade_servico").text() );
        $("#listaTiposServicosOption").val( $("#servico"+id_editar).find(".id_tipo_servico").text() );
        $("#form_input_tempo").val( $("#servico"+id_editar).find(".tempo_conclusao").text() );
    });

}


// ------------------ FIm Controle servico ---------------------------  




// ------------------ Controle Supervisor ---------------------------


jQuery(document).ready(function($){
    $('#form_supervisor').submit(function() {
        var idsAdministrados = "";
        // $( "#listaFuncionariosAdministrados option:selected" ).each(function(){
        //     if($(this).val() != ""){  
        //         idsAdministrados = idsAdministrados+","+$(this).val(); 
        //     }
        //     $("#form_input_id_administrados").val(idsAdministrados);
        // });

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
            carregarSupervisores("tabela");
        }else{
            alert(JSON.parse(ret).responseText);
        }

    }



});


function carregarSupervisores(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroSupervisor.php',
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
        alert("Supervisor removido");
        carregarSupervisores("tabela");

    }else{
        alert(JSON.parse(ret).responseText);
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
                alert(JSON.parse(ret).responseText);
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
        alert("Funcionário excluído");
 		carregarFuncionarios("tabela");
    }else{
        alert(JSON.parse(ret).responseText);  
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
                carregarTipoServico("tabela");
            }else{
                alert(JSON.parse(ret).responseText);
            }
        }



    


});




function carregarTipoServico(tipo){
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroTipoServico.php',
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
            url: 'http://pds.dev.anaju.me/business/controller/controleCadastroTipoServico.php',
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
        alert("Tipo de serviço removido!")
        carregarTipoServico("tabela");
    }else{
        alert(JSON.parse(ret).responseText);
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
