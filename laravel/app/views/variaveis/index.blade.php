@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Variáveis
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('VariavelController@index') }}'">Variáveis</a></h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table id="table_variaveis" class="table table-striped table-hover">
			<thead>
				<th>Nome</th>
				<th>Data de criação</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($variaveis as $variavel)
					<tr>
						<td><a onClick="location.href='{{ action('VariavelController@show', array($variavel->id)) }}'">{{$variavel->nome}}</a></td>
						<td>{{$variavel->data}}</td>
						<td>
							<span class="glyphicon glyphicon-trash" onClick="location.href=''"></span>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<button class="btn btn-primary" onClick="location.href='{{ action('VariavelController@create') }}'">Adicionar Nova Variável</button>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $('#table_variaveis').dataTable({
        "aLengthMenu": [[5, 15, 25, -1], [5, 15, 25, "Todas"]],
        "iDisplayLength": 15,
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "oPaginate": {
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Última",
                "sFirst": "Primeira"
             },
            "sLengthMenu": "Mostrar _MENU_ variáveis",
            "sSearch": "Procurar: ",
            "sZeroRecords": "Sem variáveis",
            "sInfo": "Variáveis de _START_ a _END_ de um total de _TOTAL_",
            "sInfoEmpty": "Sem variáveis",
            "sInfoFiltered": "(filtrado de _MAX_ variáveis)"
        },
        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [1,2] },
            { "bSortable": false, "aTargets": [2] }
        ],
        "order": [[ 1, "desc" ]]
    });    
});
</script>
@stop