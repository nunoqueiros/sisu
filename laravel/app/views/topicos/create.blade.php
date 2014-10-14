@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Criar novo tópico
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('ForumController@index') }}'">Fórum</a>
        <small> » <a onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">{{$forum->nome}}</a><small> » Criar novo tópico</small> </small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
         {{ Form::open(array('action' => array('TopicoController@store_topico', $forum->id))) }}
 
            <div class="form-group {{ ($errors->has('titulo')) ? 'has-error' : '' }}">
                {{ Form::label('titulo', 'Titulo') }}
                {{ Form::text('titulo', null, array('class' => 'form-control', 'placeholder' => 'Titulo')) }}
                {{ $errors->first('titulo') }}
            </div>
 
            <div class="form-group {{ ($errors->has('texto')) ? 'has-error' : '' }}">
                {{ Form::label('texto', 'Texto') }}
                {{ Form::textarea('texto', null, array('class' => 'form-control', 'placeholder' => 'Texto', 'id' => 'editor')) }}
                {{ $errors->first('texto') }}
            </div>
             
            {{ Form::submit('Criar', array('class' => 'btn btn-primary')) }}
             
        {{ Form::close() }}
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $('#editor').summernote({
        height: 150,   // sets the height of the editor 
        focus: false,
        toolbar: [               
                ['style', ['bold', 'italic', 'underline', 'strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['clear', ['clear']],
                ['paragraph', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'table']],
                ['misc', ['undo', 'redo', 'help']]
              ]
    });

});
</script>
@stop

