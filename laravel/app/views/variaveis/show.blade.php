@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Variável
@stop

{{-- Content --}}
@section('content')

  	<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">{{ $variavel->nome }} </h3>
	    </div>
	    <div class="panel-body">
		    <p><strong>Nome:</strong> {{ $variavel->nome }} </p>
		    <p><strong>Tipo:</strong> {{ $tipo->nome }} </p>
		    <p><strong>Estrutura:</strong> {{ $estrutura->nome }} </p>
		</div>
	</div>
@stop