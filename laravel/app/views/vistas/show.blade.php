@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Vista
@stop

{{-- Content --}}
@section('content')

  	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">{{ $vista->nome }} </h3>
	    </div>
	    <div class="panel-body">
		    <p><strong>Nome:</strong> {{ $vista->nome }} </p>
		    			
			<h4>Grupo de Variáveis</h4>
			<div class="row">
			  <div class="col-md-10 col-md-offset-1">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<th>Nome</th>
							<th></th>
						</thead>
						<tbody>
							@foreach ($grupos as $grupo)
								<tr>
									<td>{{ $grupo->nome }}</td>
									<td>
										<button class="btn btn-primary" onClick="location.href='{{ action('GrupoController@show', array($grupo->id)) }}'">Ver</button> 
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<button class="btn btn-primary" onClick="location.href='{{ action('VistaController@addGrupo_create', array($vista->id)) }}'">Adicionar Grupo</button> 
			  </div>
			</div> 
		</div>
	</div>
@stop