@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Grupo de Variáveis
@stop

{{-- Content --}}
@section('content')

  	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">{{ $grupo->nome }} </h3>
	    </div>
	    <div class="panel-body">
		    <p><strong>Nome:</strong> {{ $grupo->nome }} </p>
		    			
			<h4>Variáveis</h4>
			<div class="row">
			  <div class="col-md-10 col-md-offset-1">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<th>Nome</th>
							<th></th>
						</thead>
						<tbody>
							@foreach ($variaveis as $variavel)
								<tr>
									<td>{{ $variavel->nome }}</td>
									<td>
										<button class="btn btn-primary" onClick="location.href='{{ action('VariavelController@show', array($variavel->id)) }}'">Ver</button> 
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<button class="btn btn-primary" onClick="location.href='{{ action('GrupoController@addVariavel_create', array($grupo->id)) }}'">Adicionar Variável</button> 
			  </div>
			</div> 
		</div>
	</div>
@stop