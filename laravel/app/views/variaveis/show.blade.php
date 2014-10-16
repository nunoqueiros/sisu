@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Variável
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('VariavelController@index') }}'">Variáveis</a>
        <small> » {{ $variavel->nome }}</small>
    </h1>
</div>
<div class="row">
    <div class="col-md-4">
    	<div class="input-group">
  			<span class="input-group-addon"><strong>Nome</strong></span>
  			<input type="text" class="form-control" value="{{ $variavel->nome }}" disabled>
		</div>
		<br>
		<div class="input-group">
  			<span class="input-group-addon"><strong>Tipo</strong></span>
  			<input type="text" class="form-control" value="{{ $tipo->nome }}" disabled>
		</div>
		<br>
		<div class="input-group">
  			<span class="input-group-addon"><strong>Estrutura</strong></span>
  			<input type="text" class="form-control" value="{{ $estrutura->nome }}" disabled>
		</div>
		<br>

		@foreach($campos as $campo)
			<div class="input-group">
	  			<span class="input-group-addon"><strong>{{$campo->nome}}</strong></span>
	  			<input type="text" class="form-control" value="{{ $campo->valor }}" disabled>
			</div>
			<br>
		@endforeach
	</div>
</div>
@stop