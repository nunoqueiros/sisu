@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Fórum
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('ForumController@index') }}'">Fórum</a>
        <small> » <a onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">{{$forum->nome}}</a><small> » {{$topico->nome}}</small> </small>
    </h1>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
    </div>
    <div class="panel-body">


            <ul class="media-list list-group content">
                @foreach($posts as $post)

                    @if($post->eliminado == FALSE)
                    <li class="media list-group-item">
                        
                        <a class="pull-left">
                            <p>Nuno Queirós</p>
                            <p>&lt;{{$post->email}} &gt;</p>
                            <p>{{$post->data}}</p>
                        </a>

                        <a class="pull-right">
                            
                            @if($post->id_utilizador == $user) 
                                <span class="glyphicon glyphicon-edit"></span>
                                <span class="glyphicon glyphicon-trash" onClick="location.href='{{ action('TopicoController@eliminar_post', array($post->id)) }}'"></span>
                            @else
                                <span id="{{$post->id}}" class="glyphicon glyphicon-share citar"></span>
                            @endif
                        </a>
                        
                        <div class="media-body">{{$post->texto}}</div>
                    
                        <!--<p>{{$post->texto}}</p>-->
                    </li>
                    @endif

                @endforeach
            </ul>  

            {{$posts->links()}}

        {{ Form::open(array('action' => array('TopicoController@store_post', $topico->id))) }}

            <!-- TOOLBAR -->
            <!--
                <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                  <div class="btn-group">
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="glyphicon glyphicon-font"></i><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                  </div>
                  <div class="btn-group">
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="glyphicon glyphicon-text-height"></i>&nbsp;<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                      <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                      <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                      </ul>
                  </div>
                  <div class="btn-group">
                    <a class="btn btn-primary" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="glyphicon glyphicon-bold"></i></a>
                    <a class="btn btn-primary" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="glyphicon glyphicon-italic"></i></a>
                    <a class="btn btn-primary" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="glyphicon glyphicon-text-width"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn btn-primary" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="glyphicon glyphicon-list"></i></a>
                    <a class="btn btn-primary" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="glyphicon glyphicon-list-alt"></i></a>
                    <a class="btn btn-primary" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="glyphicon glyphicon-indent-left"></i></a>
                    <a class="btn btn-primary" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="glyphicon glyphicon-indent-right"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn btn-primary" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="glyphicon glyphicon-align-left"></i></a>
                    <a class="btn btn-primary" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="glyphicon glyphicon-align-center"></i></a>
                    <a class="btn btn-primary" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="glyphicon glyphicon-align-right"></i></a>
                    <a class="btn btn-primary" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="glyphicon glyphicon-align-justify"></i></a>
                  </div>
                  <div class="btn-group">
                  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="glyphicon glyphicon-link"></i></a>
                    <div class="dropdown-menu input-append">
                      <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                      <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn btn-primary" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="glyphicon glyphicon-remove"></i></a>

                  </div>

                  <div class="btn-group">
                    <a class="btn btn-primary" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="glyphicon glyphicon-picture"></i></a>
                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 37px; height: 30px;">
                  </div>
                  <div class="btn-group">
                    <a class="btn btn-primary" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="glyphicon glyphicon-backward"></i></a>
                    <a class="btn btn-primary" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="glyphicon glyphicon-forward"></i></a>
                  </div>
                </div>
            -->
            <!-- FIM TOOLBAR -->

            <div class="form-group {{ ($errors->has('resposta')) ? 'has-error' : '' }}">
            {{ Form::label('resposta', 'Resposta') }}
            {{ Form::textarea('resposta', 'Resposta...', array('class' => 'form-control', 'id' => 'editor')) }}
            </div>

            {{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

    $(".citar").click(function() {

        var id_post = $(this).attr('id');

        $.ajax({
            method: 'get',
            url: "/laravel/index.php/get_post/" + id_post,
            error: function(e){
                console.log("ERRO:" + e);
            },
            success: function(data){

                console.log(data);
                $('#editor').code(">> Citação: " + data[0]["texto"]);
            }
        });
    });

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