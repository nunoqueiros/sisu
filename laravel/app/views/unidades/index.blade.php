@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Unidades
@stop

{{-- Content --}}
@section('content')
<h4>Unidades atuais</h4>
<div class="row">
  <div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>Nome</th>
				<th>Sigla</th>
				<th>Localização</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($unidades as $unidade)
					<tr>
						<td>{{ $unidade->nome }}</td>
						<td>{{ $unidade->sigla }}</td>
						<td>{{ $unidade->localizacao }}</td>
						<td>
							<button class="btn btn-primary" onClick="location.href='{{ action('UnidadeController@show', array($unidade->id)) }}'">Ver</button> 
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<button class="btn btn-primary" onClick="location.href='{{ action('UnidadeController@create') }}'">Adicionar Unidade</button>
  </div>
</div>
@stop