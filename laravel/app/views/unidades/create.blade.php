@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Adicionar Nova Unidade
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {{ Form::open(array('action' => 'UnidadeController@store')) }}

            <h2>Adicionar Nova Unidade</h2>

            <div class="form-group {{ ($errors->has('nome')) ? 'has-error' : '' }}">
                {{ Form::text('nome', null, array('class' => 'form-control', 'placeholder' => 'Nome')) }}
                {{ $errors->first('nome') }}
            </div>

            <div class="form-group {{ ($errors->has('sigla')) ? 'has-error' : '' }}">
                {{ Form::text('sigla', null, array('class' => 'form-control', 'placeholder' => 'Sigla')) }}
                {{ $errors->first('sigla') }}
            </div>

            <div class="form-group {{ ($errors->has('NIF')) ? 'has-error' : '' }}">
                {{ Form::text('NIF', null, array('class' => 'form-control', 'placeholder' => 'NIF')) }}
                {{ $errors->first('NIF') }}
            </div>

            <div class="form-group {{ ($errors->has('localizacao')) ? 'has-error' : '' }}">
                {{ Form::text('localizacao', null, array('class' => 'form-control', 'placeholder' => 'Localização')) }}
                {{ $errors->first('localizacao') }}
            </div>

            <div class="form-group {{ ($errors->has('coordenadas')) ? 'has-error' : '' }}">
                {{ Form::text('coordenadas', null, array('class' => 'form-control', 'placeholder' => 'Coordenadas')) }}
                {{ $errors->first('localizacao') }}
            </div>

            <div class="form-group {{ ($errors->has('contacto')) ? 'has-error' : '' }}">
                {{ Form::text('contacto', null, array('class' => 'form-control', 'placeholder' => 'Contacto')) }}
                {{ $errors->first('contacto') }}
            </div>
            
            {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
            
        {{ Form::close() }}
    </div>
</div>

@stop