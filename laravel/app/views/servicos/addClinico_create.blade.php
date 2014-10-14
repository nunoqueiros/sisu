@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Adicionar Clínico
@stop

{{-- Content --}}
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{$unidade->nome}}</h3>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$servico->nome}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            {{ Form::open(array('action' => array('ServicoController@addClinico_store', $servico->id))) }}
                                
                                <div class="form-group {{ ($errors->has('id_clinico')) ? 'has-error' : '' }}">
                                {{ Form::label('clinico', 'Username do Clínico') }}
                                {{ Form::select('id_clinico', $clinicos, null, array('class'=>'form-control','style'=>'' )) }}
                                {{ $errors->first('id_clinico') }}
                                </div>
                                <div class="form-group {{ ($errors->has('id_especialidade')) ? 'has-error' : '' }}">
                                {{ Form::label('especialidade', 'Especialidade') }}
                                {{ Form::select('id_especialidade', $especialidades, null, array('class'=>'form-control','style'=>'' )) }}
                                {{ $errors->first('id_especialidade') }}
                                </div>
                                <div class="form-group {{ ($errors->has('data_inicio')) ? 'has-error' : '' }}">
                                {{ Form::label('datainicio', 'Data de Início') }}
                                {{ Form::input('date', 'data_inicio', null, array('class' => 'form-control', 'placeholder' => 'Date')) }}
                                {{ $errors->first('data_inicio') }}
                                </div>
                                <div class="form-group {{ ($errors->has('data_fim')) ? 'has-error' : '' }}">
                                {{ Form::label('datafim', 'Data de Fim') }}
                                {{ Form::input('date', 'data_fim', null, array('class' => 'form-control', 'placeholder' => 'Date')) }}
                                {{ $errors->first('data_fim') }}
                                </div>
                                {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
                                
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop