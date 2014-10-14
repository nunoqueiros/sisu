@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Serviço
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
				    <h3 class="panel-title">{{$servico->nome}} </h3>
				</div>
				<div class="panel-body">
				    <p><strong>Nome:</strong> {{ $servico->nome }} </p>
				    <p><strong>Sigla:</strong> {{ $servico->sigla }} </p><br>
					
					<h4>Clínicos do Serviço</h4>
					<div class="row">
					  <div class="col-md-10 col-md-offset-1">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<thead>
									<th>Nome</th>
									<th>Especialidade</th>
									<th>Iniciou em</th>
									<!--<th>Finalizou em</th>-->
								</thead>
								<tbody>
									@foreach ($clinicos as $clinico)
										<tr>
											<td>{{ $clinico->username }}</td>
											<td>{{ $clinico->nome}}</td>
											<td>{{ $clinico->data_inicio}}</td>
											<!--<td>{{ $clinico->data_fim}}</td>-->
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<button class="btn btn-primary" onClick="location.href='{{ action('ServicoController@addClinico_create', array($servico->id)) }}'">Adicionar Clínico</button> 
					  </div>
					</div>					
				</div>
			</div>
		</div>
	</div>
@stop