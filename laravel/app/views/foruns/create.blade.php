@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Criar novo sub-fórum
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('ForumController@index') }}'">Fórum</a>
        <small> » <a onClick="location.href='{{ action('ForumController@show', array($forum_pai->id)) }}'">{{$forum_pai->nome}}</a><small> » Criar novo tópico</small> </small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
         {{ Form::open(array('action' => array('ForumController@store_subforum', $forum_pai->id))) }}
 
            <div class="form-group {{ ($errors->has('titulo')) ? 'has-error' : '' }}">
                {{ Form::label('titulo', 'Titulo') }}
                {{ Form::text('titulo', null, array('class' => 'form-control', 'placeholder' => 'Titulo')) }}
                {{ $errors->first('titulo') }}
            </div>
             
            {{ Form::submit('Criar', array('class' => 'btn btn-primary')) }}
             
        {{ Form::close() }}
    </div>
</div>
@stop

