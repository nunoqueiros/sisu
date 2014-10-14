@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Variáveis
@stop

{{-- Content --}}
@section('content')
<h4>Variáveis atuais</h4>
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
	<button class="btn btn-primary" onClick="location.href='{{ action('VariavelController@create') }}'">Adicionar Vista</button>
  </div>
</div>
@stop