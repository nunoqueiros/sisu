@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Adicionar Nova Vista
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {{ Form::open(array('action' => 'VistaController@store')) }}

            <h2>Adicionar Nova Vista</h2>

            <div class="form-group {{ ($errors->has('nome')) ? 'has-error' : '' }}">
                {{ Form::text('nome', null, array('class' => 'form-control', 'placeholder' => 'Nome')) }}
                {{ $errors->first('nome') }}
            </div>
            
            {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
   
        {{ Form::close() }}
    </div>
</div>

@stop