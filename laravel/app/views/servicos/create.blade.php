@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Adicionar Novo Serviço
@stop

{{-- Content --}}
@section('content')
<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $unidade->nome }} </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    {{ Form::open(array('action' => array('ServicoController@store', $unidade->id))) }}

                        <h2>Adicionar Novo Serviço</h2>

                        <div class="form-group {{ ($errors->has('nome')) ? 'has-error' : '' }}">
                            {{ Form::text('nome', null, array('class' => 'form-control', 'placeholder' => 'Nome')) }}
                            {{ $errors->first('nome') }}
                        </div>

                        <div class="form-group {{ ($errors->has('sigla')) ? 'has-error' : '' }}">
                            {{ Form::text('sigla', null, array('class' => 'form-control', 'placeholder' => 'Sigla')) }}
                            {{ $errors->first('sigla') }}
                        </div>
                        
                        {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop