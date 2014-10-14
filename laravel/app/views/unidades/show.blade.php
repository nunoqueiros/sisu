@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Unidade
@stop

{{-- Content --}}
@section('content')

  	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">{{ $unidade->nome }} </h3>
	    </div>
	    <div class="panel-body">
		    <p><strong>Nome:</strong> {{ $unidade->nome }} </p>
		    <p><strong>Sigla:</strong> {{ $unidade->sigla }} </p>
		    <p><strong>NIF: </strong> {{ $unidade->nif }}</p>
		    <p><strong>Localização: </strong> {{ $unidade->localizacao }}</p>
		    <p><strong>Coordenadas: </strong> {{ $unidade->coordenadas }}</p>
		    <p><strong>Contacto: </strong> {{ $unidade->contacto }}</p><br>
			
			<h4>Serviços Disponíveis</h4>
			<div class="row">
			  <div class="col-md-10 col-md-offset-1">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<th>Nome</th>
							<th>Sigla</th>
							<th></th>
						</thead>
						<tbody>
							@foreach ($servicos as $servico)
								<tr>
									<td>{{ $servico->nome }}</td>
									<td>{{ $servico->sigla }}</td>
									<td>
										<button class="btn btn-primary" onClick="location.href='{{ action('ServicoController@show', array($servico->id)) }}'">Ver</button> 
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<button class="btn btn-primary" onClick="location.href='{{ action('ServicoController@create', array($unidade->id)) }}'">Adicionar Serviço</button> 
			  </div>
			</div> 
		</div>
	</div>
@stop