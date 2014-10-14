@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Enviar Nova Mensagem
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('MensagensController@index') }}'">Mensagens</a>
        <small> » Enviar Nova Mensagem</small>
    </h1>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {{ Form::open(array('action' => 'MensagensController@store')) }}
 
            <div id="destinatarios">
                <div class="form-group {{ ($errors->has('destinatarios')) ? 'has-error' : '' }}">
                    {{ Form::label('destinatarios', 'Destinatários') }} 
                    {{ Form::text('destinatarios', null, array('class' => 'form-control', 'placeholder' => 'Destinatários', 'autocomplete' => 'off', 'id' => 'destinatario')) }}
                    <!--<input class="form-control" placeholder="Destinatario" name="destinatarios[]" type="text" id="destinatario" autocomplete="off"/>-->
                    {{ $errors->first('destinatarios') }}
                </div>
            </div>
            <!--<button type="button" class="btn btn-link add-more" style="float: right;">Adicionar outro destinatário</button><br>-->
 
            <div class="form-group {{ ($errors->has('assunto')) ? 'has-error' : '' }}">
                {{ Form::label('assunto', 'Assunto') }}
                {{ Form::text('assunto', null, array('class' => 'form-control', 'placeholder' => 'Assunto')) }}
                {{ $errors->first('assunto') }}
            </div>
 
            <div class="form-group {{ ($errors->has('mensagem')) ? 'has-error' : '' }}">
                {{ Form::label('mensagem', 'Mensagem') }}
                {{ Form::textarea('mensagem', null, array('class' => 'form-control', 'placeholder' => 'Mensagem')) }}
                {{ $errors->first('Mensagem') }}
            </div>
             
            {{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}
             
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){

    $('#destinatario').on('tokenfield:createtoken', function (event) {
        var existingTokens = $(this).tokenfield('getTokens');
        $.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });

    $.ajax({
        method: 'get',
        url: "/laravel/index.php/emails",
        error: function(e){
            console.log(e);
        },
        success: function(data){ 
            dados=data;
            $( "#destinatario" ).tokenfield({     
                autocomplete: {source: dados}
            })
        }
    });

   
});
/*
jQuery(document).ready(function(){

    var dados='chamada ajax falhou';
    var nr_dest=1;

    $.ajax({
        method: 'get',
        url: "/laravel/index.php/emails",
        error: function(e){
            console.log(e);
        },
        success: function(data){ 
            dados=data;
            $( ".destinatario" ).autocomplete({
                source:dados
            })
        }
    });

    $(".add-more").click(function(e){
        nr_dest = nr_dest + 1;
        var label_dest='';
        var input_dest='';

        label_dest = label_dest + '<label for="destinatario' + nr_dest + '">Destinatario ' + nr_dest +  '</label>';
        input_dest = input_dest + '<input class="form-control destinatario" placeholder="Destinatario" name="destinatarios[]" type="text" /><br>'

        $("#destinatarios").append(label_dest + input_dest);
        $( ".destinatario" ).autocomplete({
                source:dados
        });
    });
});
*/
</script>

@stop

<!--
<div id="destinatarios">
    <div class="form-group {{ ($errors->has('destinatario')) ? 'has-error' : '' }}">
        {{ Form::label('destinatario', 'Destinatario') }}
        {{ Form::text('destinatario', null, array('class' => 'form-control', 'placeholder' => 'Destinatario')) }}
        {{ $errors->first('destinatario') }}
    </div>
</div>
-->

