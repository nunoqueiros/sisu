@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Criar novo trigger
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('TriggersController@index') }}'">Triggers</a>
        <small> » Criar Novo Trigger</small>
    </h1>
</div>
<div class="row">
	{{ Form::open(array('action' => 'TriggersController@store')) }}

    <div class="col-md-4 col-md-offset-2">

            <div id="select_variavel_origem" class="form-group {{ ($errors->has('variavel_origem')) ? 'has-error' : '' }}">
                {{ Form::label('variavel_origem', 'Variável de Origem') }}
                {{ Form::select('variavel_origem', array('0'=>'Escolha uma opção') + $variaveis, null, array('class'=>'form-control' )) }}
                {{ $errors->first('variavel_origem') }}
            </div>
            <div id="select_acao" class="form-group {{ ($errors->has('acao')) ? 'has-error' : '' }}">
            </div>

            <div id="valores_acao" class="form-group {{ ($errors->has('campos')) ? 'has-error' : '' }}">
            </div>

            {{ Form::submit('Adicionar Trigger', array('class' => 'btn btn-primary')) }}
    </div>
    <div class="col-md-4">

            <div id="select_variavel_destino" class="form-group {{ ($errors->has('variavel_destino')) ? 'has-error' : '' }}">
                {{ Form::label('variavel_destino', 'Variável de Destino') }}
                {{ Form::select('variavel_destino', array('0'=>'Escolha uma opção') + $variaveis, null, array('class'=>'form-control' )) }}
                {{ $errors->first('variavel_destino') }}
            </div>
            <div id="select_reacao" class="form-group {{ ($errors->has('reacao')) ? 'has-error' : '' }}">
            </div>

            <div id="campos" class="form-group {{ ($errors->has('campos')) ? 'has-error' : '' }}">
            </div>

    		{{ Form::close() }}
    </div>

    <input type="hidden" id="tipo_variavel" name="tipo_variavel">
    <input type="hidden" id="estrutura_variavel" name="estrutura_variavel">

</div>

<script type="text/javascript">
$(document).ready(function() {

    // mostra acoes válidas para a variavell selecionada
    $('#select_variavel_origem').change(function(){

        var variavel_origem = $("#variavel_origem").val();

        if(variavel_origem!=0) {

            $.ajax({
                method: 'get',
                url: "/laravel/index.php/get_acoesValidas/" + variavel_origem,
                error: function(e){
                    console.log(e);
                },
                success: function(data){ 

                    if(data.length>0) {

                        // guarda o tipo e estrutura da variável
                        $('#tipo_variavel').val(data[0]["id_tipovariavel"]);
                        $('#estrutura_variavel').val(data[0]["id_estruturavariavel"]);

                        var i=0;
                        var str='<option value="0">Escolha uma opção</option>';
                        while(i<data.length) {
                            str = str + '<option value="' + data[i]["id_acao"] + '">' + data[i]["nome"] + '</option>'; 
                            ++i;
                        }

                        $("#select_acao").html("");
                        $("#valores_acao").html("");
                        $("#select_acao").append('<label for="acao">Ação</label><select class="form-control" id="acao" name="acao">' + str + '</select>');
                    }
                    else {
                        $("#select_acao").html("");
                        $("#valores_acao").html("");
                    }
                                     
                }
            });
        }
        else {
            $("#select_acao").html("");
            $("#valores_acao").html("");
        }
    });

	
	// mostra campos a preencher para a acao selecionada
    $('#select_acao').change(function(){
        
        var tipo_variavel = $("#tipo_variavel").val();
        var estrutura_variavel = $("#estrutura_variavel").val();

        var variavel_origem = $("#variavel_origem").val();
        var acao = $("#acao").val();

        if(variavel_origem!=0 && acao!=0) {
            
            // se estrutura=lista ou estrutura=intervalo vai buscar restriçõs os campos
            if(estrutura_variavel==1 || estrutura_variavel==2) {
                $.ajax({
                    method: 'get',
                    url: "/laravel/index.php/get_configVariavel/" + variavel_origem,
                    error: function(e){
                        console.log(e);
                    },
                    success: function(data){ 

                        console.log(data);

                        if(data.length>0) {
                            
                            // se estrutura=lista
                            if(estrutura_variavel==1) {

                                var i=0;
                                var str='';
                                while(i<data.length) {
                                    str = str + '<option value="' + data[i]["valor"] + '">' + data[i]["valor"] + '</option>'; 
                                    ++i;
                                }

                            $("#valores_acao").html("");
                            $("#valores_acao").append('<label for="valor">Valor</label><select class="form-control" id="valor" name="valor">' + str + '</select>');

                            }
                            // se estrutura=intervalo
                            else if(estrutura_variavel==2) {

                                
                                var min=0;
                                var max=0;
                                var i=0;
                                while(i<data.length) {
                                    if(data[i]["nome"]=="Mínimo") {
                                        min=data[i]["valor"];
                                    }
                                    else if(data[i]["nome"]=="Máximo") {
                                        max=data[i]["valor"];
                                    }
                                    ++i;
                                }

                                // se tipo=inteiro
                                if(tipo_variavel==1) {
                                    str = '<input class="form-control" type="number" name="valor" value="' + min + '" min="' + min + '" max="' + max + '">';
                                }
                                // se tipo=decimal
                                else if(tipo_variavel==4) {
                                    str = '<input class="form-control" type="number" name="valor" step="0.01" value="' + min + '" min="' + min + '" max="' + max + '">';
                                }
                                // se tipo=data
                                else if(tipo_variavel==5) {
                                    str = '<input class="form-control" type="date" name="valor" value="' + min + '" min="' + min + '" max="' + max + '">';
                                }
                                // se tipo=hora
                                else if(tipo_variavel==6) {
                                    str = '<input class="form-control" type="time" name="valor" value="' + min + '" min="' + min + '" max="' + max + '">';
                                }

                                $("#valores_acao").html("");
                                $("#valores_acao").append('<label for="valor">Valor</label>' + str);
                            }

                        }
                        else {
                            $("#valores_acao").html("");
                        }
                    }
                });
            }
            else {

                var str='';

                // se tipo=inteiro
                if(tipo_variavel==1) {
                    str = '<input class="form-control" type="number" name="valor" value="0">';
                }
                // se tipo=decimal
                else if(tipo_variavel==4) {
                    str = '<input class="form-control" type="number" step="0.01" name="valor" value="0.00">';
                }
                // se tipo=data (nao compativel com firefox)
                else if(tipo_variavel==5) {
                    str = '<input class="form-control" type="date" name="valor">';
                }
                // se tipo=hora (nao compativel com firefox)
                else if(tipo_variavel==6) {
                    str = '<input class="form-control" type="time" name="valor">';
                }

                $("#valores_acao").html("");
                $("#valores_acao").append('<label for="valor">Valor</label>' + str);
            }          
        }
        else {
            $("#valores_acao").html("");
        }
    });

});
</script>
@stop