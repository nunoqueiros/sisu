@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Vistas
@stop

{{-- Content --}}
@section('content')
<h4>Vistas Atuais</h4>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>Nome</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($vistas as $vista)
					<tr>
						<td>{{ $vista->nome }}</td>
						<td>
							<button class="btn btn-primary" onClick="location.href='{{ action('VistaController@show', array($vista->id)) }}'">Ver</button> 
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<button class="btn btn-primary" onClick="location.href='{{ action('VistaController@create') }}'">Adicionar Vista</button>
  </div>
</div>
@stop