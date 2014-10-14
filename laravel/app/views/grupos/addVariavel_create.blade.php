@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Adicionar Grupo de Variáveis
@stop

{{-- Content --}}
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{$grupo->nome}}</h3>
        </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            {{ Form::open(array('action' => array('GrupoController@addVariavel_store', $grupo->id))) }}
                                
                                <div id="box" class="form-group {{ ($errors->has('id_variavel')) ? 'has-error' : '' }}">
                                {{ Form::label('variavel', 'Variavel') }}
                                {{ Form::select('id_variavel', $variaveis, null, array('class'=>'form-control','style'=>'' )) }}
                                {{ $errors->first('id_variavel') }}
                                </div>

                                {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}
                                
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
    </div>
@stop