@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Reciclagem
@stop
 
{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('MensagensController@index') }}'">Mensagens</a>
        <small> » Reciclagem</small>
    </h1>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
        <table id="reciclagem" class="table table-striped table-hover">
            <thead>
                <th>Assunto</th>
                <th>Remetente</th>
                <th>Data</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($mensagens as $mensagem)
                    <tr> 
                        <td>{{ $mensagem->assunto }}</td>
                        <td>{{ $mensagem->email }}</td>
                        <td>{{ $mensagem->data_chegada }}</td>                        
                        <td>
                            <span class="glyphicon glyphicon-eye-open ver_mensagem" id="{{$mensagem->id_mensagem}}" title="Ver Mensagem"></span>
                        </td>
                        <td> 
                            <span class="glyphicon glyphicon-trash" title="Enviar para reciclagem"></span> 
                        </td>
                        <td>
                            <span class="glyphicon glyphicon-share-alt" onClick="location.href='{{ action('MensagensController@responder', array($mensagem->id_mensagem)) }}'" title="Responder"></span>  
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<div id="mensagem">
</div>
<script type="text/javascript">
$(document).ready(function() {

    // Ver mensagem
    $('.ver_mensagem').click(function() {

        var id_mensagem = $(this).attr('id');

        $.ajax({
            method: 'get',
            url: "/laravel/index.php/mensagens/" + id_mensagem,
            error: function(e){
                console.log("ERRO:" + e);
            },
            success: function(data){

                //location.reload(true);

                //console.log(data);
                $("#mensagem").html("");
                $("#mensagem").append("<h3>» Ver Mensagem</h3>");
                $("#mensagem").append('<div class="panel panel-default"><div class="panel-heading">'
                    +
                '<p><strong>Assunto </strong>' + data[0]["assunto"] + '</p>'
                    +
                '<p><strong>Remetente </strong>' + data[0]["email"] + '</p>'
                    +
                '<p><strong>Data </strong>' + data[0]["data_chegada"] + '</p></div>'
                    +
                '<div class="panel-body">' + data[0]["corpo"] + '</div></div>');
            }
        });

    });

    $('#reciclagem').dataTable({
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
            { "bSearchable": false, "aTargets": [2,3,4,5] },
            { "bSortable": false, "aTargets": [3,4,5] }
        ]
    });    
});
</script>
@stop