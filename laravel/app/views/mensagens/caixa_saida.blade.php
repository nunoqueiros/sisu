@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Caixa Saída
@stop
 
{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('MensagensController@index') }}'">Mensagens</a>
        <small> » Caixa de Saída</small>
    </h1>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
        <table id="caixa_saida" class="table table-striped table-hover">
            <thead>
                <th>Assunto</th>
                <th>Data</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($mensagens as $mensagem)
                    <tr>
                        <td>{{ $mensagem->assunto }}</td>
                        <td>{{ $mensagem->data }}</td>
                        <td>
                            <span class="glyphicon glyphicon-eye-open" onClick="location.href=''"></span> 
                        </td>
                        <td> 
                            <span class="glyphicon glyphicon-trash" onClick="location.href=''"></span> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#caixa_saida').dataTable({
        "aLengthMenu": [[5, 15, 25, -1], [5, 15, 25, "Todas"]],
        "iDisplayLength": 5,
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "oPaginate": {
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Última",
                "sFirst": "Primeira"
             },
            "sLengthMenu": "Mostrar _MENU_ mensagens",
            "sSearch": "Procurar: ",
            "sZeroRecords": "Sem mensagens",
            "sInfo": "Mensagens de _START_ a _END_ de um total de _TOTAL_",
            "sInfoEmpty": "Sem Mensagens",
            "sInfoFiltered": "(filtrado de _MAX_ mensagens)"
        },
        "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [2,3] },
            { "bSortable": false, "aTargets": [2,3] }
        ],
        "order": [[ 1, "desc" ]]
    });
} );
</script>
@stop