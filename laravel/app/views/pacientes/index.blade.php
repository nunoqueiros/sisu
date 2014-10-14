@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Pacientes
@stop

{{-- Content --}}
@section('content')
<h4>Pacientes</h4>
<div class="row">
  <div class="col-md-10">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>Nome</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($pacientes as $paciente)
					<tr>
						<td>{{ $paciente->nome }}</td>
						<td>
							<button class="btn btn-primary" onClick="location.href='{{ action('PacienteController@show', array($paciente->id)) }}'">Ver</button> 
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<button class="btn btn-primary" onClick="location.href=''">Adicionar Paciente</button>
  </div>
</div>
@stop