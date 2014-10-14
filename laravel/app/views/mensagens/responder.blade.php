@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Mensagens
@stop


{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('MensagensController@index') }}'">Mensagens</a>
        <small> » Responder a Mensagem</small>
    </h1>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {{ Form::open(array('action' => 'MensagensController@store')) }}
 
            <h2>Enviar Nova Mensagem</h2>
 
            <div id="destinatarios">
                <div class="form-group {{ ($errors->has('destinatario')) ? 'has-error' : '' }}">
                    {{ Form::label('destinatario', 'Destinatário') }} 
                     <input class="form-control destinatario" placeholder="Destinatario" name="destinatarios[]" type="text" data-items="8" value="{{$remetente->email}}"/>
                    {{ $errors->first('destinatario') }}
                </div>
            </div>
 
            <div class="form-group {{ ($errors->has('assunto')) ? 'has-error' : '' }}">
                {{ Form::label('assunto', 'Assunto') }}
                {{ Form::text('assunto', 'RE: ' . $mensagem->assunto, array('class' => 'form-control')) }}
                {{ $errors->first('assunto') }}
            </div>
 
            <div class="form-group {{ ($errors->has('mensagem')) ? 'has-error' : '' }}">
                {{ Form::label('mensagem', 'Mensagem') }}
                {{ Form::textarea('mensagem', 'Citação de '. $remetente->email . ': ' .  $mensagem->corpo, array('class' => 'form-control')) }}
                {{ $errors->first('mensagem') }}
            </div>
             
            {{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}
             
        {{ Form::close() }}
    </div>
</div>
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

