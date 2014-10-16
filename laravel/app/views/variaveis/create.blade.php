@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Adicionar Nova Variável
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('VariavelController@index') }}'">Variáveis</a>
        <small> » Adicionar Nova Variável</small>
    </h1>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {{ Form::open(array('action' => 'VariavelController@store')) }}

            <div class="form-group {{ ($errors->has('nome')) ? 'has-error' : '' }}">
                {{ Form::text('nome', null, array('class' => 'form-control', 'placeholder' => 'Nome da variável')) }}
                {{ $errors->first('nome') }}
            </div>
            <div id="select_tipo" class="form-group {{ ($errors->has('tipo')) ? 'has-error' : '' }}">
                {{ Form::label('tipo', 'Tipo de Variável') }}
                {{ Form::select('tipo', array('0'=>'Escolha uma opção') + $tipos, null, array('class'=>'form-control' )) }}
                {{ $errors->first('tipo') }}
            </div>
            <div id="select_estrutura" class="form-group {{ ($errors->has('estrutura')) ? 'has-error' : '' }}">
            </div>

            <div id="campos" class="form-group {{ ($errors->has('campos')) ? 'has-error' : '' }}">
            </div>
            
            {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
   
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    // mostra estruturas válidas para o tipo selecionado
    $('#select_tipo').change(function(){

        var tipo = $("#tipo").val();

        if(tipo!=0) {

            $.ajax({
                method: 'get',
                url: "/laravel/index.php/get_estruturasValidas/" + tipo,
                error: function(e){
                    console.log(e);
                },
                success: function(data){ 

                    if(data.length>0) {

                        var i=0;
                        var str='<option value="0">Escolha uma opção</option>';
                        while(i<data.length) {
                            str = str + '<option value="' + data[i]["id_estrutura"] + '">' + data[i]["nome"] + '</option>'; 
                            ++i;
                        }

                        $("#select_estrutura").html("");
                        $("#campos").html("");
                        $("#select_estrutura").append('<label for="estrutura">Estrutura da Variável</label><select class="form-control" id="estrutura" name="estrutura">' + str + '</select>');
                    }
                    else {
                        $("#select_estrutura").html("");
                        $("#campos").html("");
                    }
                }
            });
        }
        else {
            $("#select_estrutura").html("");
            $("#campos").html("");
        }
    });

    // mostra campos a preencher para a estrutura selecionada
    $('#select_estrutura').change(function(){
        
        var tipo = $("#tipo").val();
        var estrutura = $("#estrutura").val();

        if(tipo!=0 && estrutura!=0) {
            
            $.ajax({
                method: 'get',
                url: "/laravel/index.php/get_campos/" + estrutura,
                error: function(e){
                    console.log(e);
                },
                success: function(data){ 

                    if(data.length>0) {
                        var i=0;
                        var str='';
                        while(i<data.length){

                            //se tipo=inteiro
                            if(tipo==1){
                                str = str + '<label for="' + data[i]["nome"] + '">' + data[i]["nome"] + '</label><input class="form-control" type="number" placeholder="0" name="' + data[i]["nome"] + '[]">';
                            }
                            // se tipo=decimal
                            else if(tipo==4) {
                                str = str + '<label for="' + data[i]["nome"] + '">' + data[i]["nome"] + '</label><input class="form-control" type="number" step="0.01" placeholder="0.0" name="' + data[i]["nome"] + '[]">';
                            }
                            // se tipo=texto
                            else if(tipo==2) {
                                str = str + '<label for="' + data[i]["nome"] + '">' + data[i]["nome"] + '</label><input class="form-control" type="text" placeholder="' + data[i]["nome"] + '" name="' + data[i]["nome"] + '[]">';
                            }
                            // se tipo=data (nao suportado por firefox)
                            else if(tipo==5) {
                                str = str + '<label for="' + data[i]["nome"] + '">' + data[i]["nome"] + '</label><input class="form-control" type="date" name="' + data[i]["nome"] + '[]">';
                            }
                            // se tipo=hora (nao suportado por firefox)
                            else if(tipo==6) {
                                str = str + '<label for="' + data[i]["nome"] + '">' + data[i]["nome"] + '</label><input class="form-control" type="time" name="' + data[i]["nome"] + '[]">';
                            }

                            ++i;
                        }

                        $("#campos").html("");
                        if(estrutura==1) {
                            $("#campos").append(str + '<button type="button" class="btn btn-link button_novo_valor" style="float:right">Novo Valor</button>');
                        }
                        else {
                            $("#campos").append(str);
                        }
                    }
                    else {
                        $("#campos").html("");
                    }
                }
            });            
        }
        else {
            $("#campos").html("");
        }
    });

    $('#campos').on('click', '.button_novo_valor', function() {
    
        var tipo = $("#tipo").val();

        var str='';

        // se tipo=inteiro
        if(tipo==1) {
            str = '<label for="Valor">Valor</label><input class="form-control" type="number" placeholder="0" name="Valor[]">';
        }
        // se tipo=decimal
        else if(tipo==4) {
            str = '<label for="Valor">Valor</label><input class="form-control" type="number" step="0.01" placeholder="0.0" name="Valor[]">';
        }
        // se tipo=texto
        else if(tipo==2) {
            str = '<label for="Valor">Valor</label><input class="form-control" type="text" placeholder="Valor" name="Valor[]">';            
        }

        $(str).insertBefore(".button_novo_valor");
        
    });

});
</script>
@stop