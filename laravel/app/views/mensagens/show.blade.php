@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Mensagem
@stop


{{-- Content --}}
@section('content')
<h4>Mensagem</h4>
<br>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p><strong>Remetente:</strong> {{ $remetente->email }}</p>
        <p><strong>Assunto:</strong> {{ $mensagem->assunto }} </p>
        <p><strong>Mensagem</strong></p>    
        <div class="panel panel-default">
            <div class="panel-body">
                {{$mensagem->corpo}}
            </div>
        </div> 
        <button class="btn btn-primary" onClick="location.href='{{ action('MensagensController@responder', array($mensagem->id)) }}'">Responder</button>  
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

