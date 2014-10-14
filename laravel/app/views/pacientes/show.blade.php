@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Variável
@stop

{{-- Content --}}
@section('content')

  	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">{{ $paciente->nome }} </h3>
	    </div>
	    <div class="panel-body">
		    <p><strong>Nome:</strong> {{ $paciente->nome }} </p>
		    <p><strong>CC:</strong> {{ $paciente->cc }} </p>
		    <p><strong>Data de Nascimento:</strong> {{ $paciente->data_nasc }} </p>
		    <p><strong>Nacionalidade:</strong> {{ $paciente->nacionalidade }} </p>
		    <p><strong>Contacto:</strong> {{ $paciente->contacto }} </p>

			<!-- Nav tabs -->
			<ul id="vistas_tab" class="nav nav-tabs">
			@foreach($vistas as $vista)
				<li id="{{$vista->id_vista}}"><a data-toggle="tab">{{$vista->nome}}</a></li>
			@endforeach
			</ul>

			<div id="formulario">
			</div>

		</div>
	</div>
<script type="text/javascript">
 $('#vistas_tab li').click(function() {

 	var id_vista = $(this).attr('id');

 	$.ajax({
            method: 'get',
            url: "/laravel/index.php/grupo_da_vista/" + id_vista,
            error: function(e){
                console.log("ERRO:" + e);
            },
            success: function(data){

            	$("#formulario").html("");
            	$("#formulario").html("<br>");

                var id_grupo=0;
                var nome_grupo='';
               	for(var i=0; i<data.length; i++){

                	id_grupo=data[i]["id_grupo"];
                	nome_grupo=data[i]["nome"];

                	//console.log("Iteração número:" + i);

					$('#formulario').append('<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">' + nome_grupo + '</h3></div><div class="panel-body"><div id="'+id_grupo+'"></div></div>');

					(function(index) {
						$.ajax({
				            method: 'get',
				            url: "/laravel/index.php/variaveis_do_grupo/" + index,
				            error: function(e){
				                console.log("ERRO:" + e);
				            },
	            			success: function(data_){ 

	            				//console.log("Iteração número:" + i);
	            				//$("#formulario").html("");
	            				if(data_.length!=0) {
	            					var j=0;
	            					while(j<data_.length) {
		            						$('#formulario #'+index).append("<p><strong>" + data_[j]["nome"] + ": <input>");
		            						++j;
	            					}
	            				}	            				
	           				}
	   					});
	   				})(id_grupo);
				}
            }
    });
 	//alert(id_vista);
});
</script>

@stop