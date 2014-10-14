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
        <small> » {{$forum->nome}}</small>
    </h1>
</div>

<!-- Sub-fóruns -->
<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Sub-Fóruns</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover"> 
                <tbody>
                    @foreach ($subforuns as $subforum)
                    <tr onClick="location.href='{{ action('ForumController@show', array($subforum->id)) }}'">
                        <td>{{ $subforum->nome }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary" onClick="location.href='{{ action('ForumController@create_subforum', array($forum->id)) }}'">Criar Novo Sub-Fórum</button>
        </div>
</div>

<!-- Tópicos --> 
<div class="panel panel-primary">
	<div class="panel-heading">
	</div>
	<div class="panel-body">
		<table id="topicos" class="table table-striped table-hover">
			<thead>
                <th>Título</th>
                <th>Autor</th>
                <th>Data de criação</th>
                <th></th>
            </thead>
			<tbody>
				@foreach ($topicos as $topico)
					<tr>
						<td><a onClick="location.href='{{ action('TopicoController@show', array($topico->id)) }}'">{{ $topico->nome }}</a></td>
						<td>{{ $topico->first_name}} {{$topico->last_name}}</td>
						<td>{{ $topico->data}}</td>
						<td>
							<span class="glyphicon glyphicon-trash"  onClick="location.href='{{ action('TopicoController@destroy', array($topico->id)) }}'" title="Eliminar tópico"></span> 
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<button class="btn btn-primary" onClick="location.href='{{ action('TopicoController@create_topico', array($forum->id)) }}'">Criar Novo Tópico</button> 					
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $('#topicos').dataTable({
        "aLengthMenu": [[5, 15, 25, -1], [5, 15, 25, "Todos"]],
        "iDisplayLength": 15,
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "oPaginate": {
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Última",
                "sFirst": "Primeira"
             },
            "sLengthMenu": "Mostrar _MENU_ tópicos",
            "sSearch": "Procurar: ",
            "sZeroRecords": "Sem tópicos",
            "sInfo": "Tópicos de _START_ a _END_ de um total de _TOTAL_",
            "sInfoEmpty": "Sem tópicos",
            "sInfoFiltered": "(filtrado de _MAX_ tópicos)"
        },
        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [2,3] },
            { "bSortable": false, "aTargets": [2,3] }
        ],
        "order": [[ 1, "desc" ]]
    });    
});
</script>
@stop