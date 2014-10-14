@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Dados Clínicos
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('DadosClinicosController@index') }}'">Dados Clínicos</a></h1>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">

        {{ Form::open(array('action' => 'DadosClinicosController@store')) }}

        <!-- Dados clínicos e respetivo tipo -->

        <div class="panel panel-default">
            <div class="panel-body">

                <div id="select_dados" class="form-group {{ ($errors->has('dadosclinicos')) ? 'has-error' : '' }}">
                    {{ Form::label('dadosclinicos', 'Dados Clínicos') }}
                    {{ Form::select('dadosclinicos', array('0'=>'Escolha uma opção') + $dados, null, array('class'=>'form-control')) }}
                    {{ $errors->first('dadosclinicos') }}
                </div>

                <div id="select_tipo" class="form-group {{ ($errors->has('estrutura')) ? 'has-error' : '' }}">
                </div>  

            </div>
        </div>

        <!-- Botão para mostrar quadro de associação -->
        <button id="button_associar_especialidades_vistas" type="button" class="btn btn-link">Associar Especialidades & Vistas</button>

        <!-- Especialidades e Vistas associadas -->

        <div id="especialidades_vistas" class="panel panel-default">
            <div class="panel-body">

                <div id="select_especialidade" class="form-group {{ ($errors->has('especialidades')) ? 'has-error' : '' }}">
                    {{ Form::label('especialidades', 'Especialidade') }}
                    {{ Form::select('especialidades', array('0'=>'Escolha uma opção') + $especialidades, null, array('class'=>'form-control' )) }}
                    {{ $errors->first('especialidades') }}
                </div>

                <div id="select_vistas" class="form-group {{ ($errors->has('estrutura')) ? 'has-error' : '' }}">
                </div>

        {{ Form::submit('Associar', array('class' => 'btn btn-primary')) }}

            </div>
        </div>

        {{ Form::close() }}

    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

    $("#button_associar_especialidades_vistas").hide();
    $("#especialidades_vistas").hide();

    // escolher o Dado Clínico (template) e obter os respetivos Tipos
    $('#select_dados').change(function(){

        var dado_clinico = $("#dadosclinicos").val();

        if(dado_clinico!=0) {

            $.ajax({
                method: 'get',
                url: "/laravel/index.php/tipos_dadosclinicos/" + dado_clinico,
                error: function(e){
                    console.log(e);
                },
                success: function(data){ 
                	console.log(data);

                    if(dado_clinico == 5 || dado_clinico == 6) {
                        var str='';
                        var i=0;
                        while(i<data.length) {
                            str = str + '<option value="' + data[i]["id"] + '">' + data[i]["nome"] + '</option>'; 
                            ++i;
                        }
                        $("#select_tipo").html("");
                        $("#select_tipo").append('<label for="estrutura">Tipo</label><select disabled class="form-control" style="" id="tipo_dadoclinico" name="tipo_dadoclinico">' + str + '</select>');
                        $("#button_associar_especialidades_vistas").show();
                    }
                    else {
                        var i=0;
                        var str='<option value="0">Escolha uma opção</option>';
                        while(i<data.length) {
                            str = str + '<option value="' + data[i]["id"] + '">' + data[i]["nome"] + '</option>'; 
                            ++i;
                        }

                        $("#select_tipo").html("");
                        $("#select_tipo").append('<label for="estrutura">Tipo</label><select class="form-control" style="" id="tipo_dadoclinico" name="tipo_dadoclinico">' + str + '</select>');
                    }  
                }
            });
        }
        else {
            $("#select_tipo").html("");
            $("#button_associar_especialidades_vistas").hide();

        }
    });


    // Escolher o tipo do dado clínico
    $('#select_tipo').change(function(){
        var  tipo_dadoclinico = $("#tipo_dadoclinico").val();
        if(tipo_dadoclinico!=0) {
            $("#button_associar_especialidades_vistas").show();
        }
        else $("#button_associar_especialidades_vistas").hide();
    });


    // Clicar para associar especialidades e vistas
    $("#button_associar_especialidades_vistas").click(function() {
        $("#especialidades_vistas").show();
    });
    
        
    // Escolher a especialidade e as vistas associadas
    $('#select_especialidade').change(function(){

        var tipo_dadoclinico = $("#tipo_dadoclinico").val();
        var especialidade = $("#especialidades").val();

        if(especialidade!=0) {

            $.ajax({
                method: 'get',
                url: "/laravel/index.php/vistas_respetivas/" + tipo_dadoclinico + "/" + especialidade,
                error: function(e){
                    console.log(e);
                },
                success: function(data){ 
                    console.log(data);
                
                    var i=0;
                    var str='';
                    if(data.length > 0){

                       while(i<data.length) {

                            if(data[i]["associada"] == "sim") {
                                str = str + '<li class="list-group-item"><input checked="checked" name="vistas[]" type="checkbox" value="' + data[i]["id"] + '">'+ data[i]["nome"] + '</li>'; 
                            }
                            else {
                                str = str + '<li class="list-group-item"><input name="vistas[]" type="checkbox" value="' + data[i]["id"] + '">'+ data[i]["nome"] + '</li>'; 
                            }
                            ++i;
                        }                        
                    }
                    else {
                        str = '<li class="list-group-item">Sem Vistas Associadas</li>'; 
                    }

                    $("#select_vistas").html("");
                    $("#select_vistas").append('<label for="vistas">Vistas Associadas</label>');
                    $("#select_vistas").append('<ul class="list-group">' + str + '</ul>');
                }
            });
        }
        else {
            $("#select_vistas").html("");
 
        }
    });

    $( "#add_vista_button" ).click(function() {

        $("#associar_button").show();   

        var tipo_dadoclinico = $("#tipo_dadoclinico").val();
        var especialidade = $("#especialidades").val();

        if(especialidade!=0) {

            $.ajax({
                method: 'get',
                url: "/laravel/index.php/vistas_desassociadas/" + tipo_dadoclinico + "/" + especialidade,
                error: function(e){
                    console.log(e);
                },
                success: function(data){ 
                    console.log(data);
                    var i=0;
                    var str='<option value="0">Escolha uma opção</option>';
                    while(i<data.length) {
                        str = str + '<option value="' + data[i]["id"] + '">' + data[i]["nome"] + '</option>'; 
                        ++i;
                    }

                    $("#add_vista").html("");
                    $("#add_vista").append('<label for="estrutura">Vistas</label><select class="form-control" style="" id="vistas" name="vistas">' + str + '</select>');
                    //$("#select_tipo").append('<button id="adicionar_tipo" type="button" class="btn btn-link" style="float: right;">Adicionar novo tipo</button><br>');
                    //$("#add_tipo_button").show();
                    //$("#add_vista").hide();  
                    $("#add_vista_button").show();
                    //$("#add_vista").hide();
                    $("#associar_button").show();  
                }
            });
        }
        else {
            $("#add_vista").html("");
            $("#add_vista_button").hide();
            //$("#add_vista").hide(); 
            $("#associar_button").hide();   
        }
        //$("#add_vista").show(); 

    });   
});
</script>
@stop