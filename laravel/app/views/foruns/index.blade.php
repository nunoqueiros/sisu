@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Fórum
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('ForumController@index') }}'">Fórum</a></h1>
</div>
<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">Unidades de Saúde Gerais</h3>
	    </div>
	    <div class="panel-body">
		    <table class="table table-striped table-hover">	
				<tbody>
				@foreach ($foruns_unidades as $forum)
					<tr onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">
						<td>{{ $forum->nome }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
	    </div>
</div>
<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">Especialidades Gerais</h3>
	    </div>
		<div class="panel-body">
		    <table class="table table-striped table-hover">	
				<tbody>
				@foreach ($foruns_especialidades as $forum)
					<tr>
						<td onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">{{ $forum->nome }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
	    </div>
</div>
<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">Especialidades @ Unidades de Saúde</h3>
	    </div>
		<div class="panel-body">
		    <table class="table table-striped table-hover">	
				<tbody>
				@foreach ($foruns_especialidades_das_unidades as $forum)
					<tr>
						<td onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">{{ $forum->nome }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
	    </div>
</div>
<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">Serviços Gerais</h3>
	    </div>
		<div class="panel-body">
		    <table class="table table-striped table-hover">	
				<tbody>
				@foreach ($foruns_superservicos as $forum)
					<tr>
						<td onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">{{ $forum->nome }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
	    </div>
</div>
<div class="panel panel-primary">
	    <div class="panel-heading">
	    	<h3 class="panel-title">Serviços @ Unidades de Saúde</h3>
	    </div>
		<div class="panel-body">
		    <table class="table table-striped table-hover">	
				<tbody>
				@foreach ($foruns_servicos_das_unidades as $forum)
					<tr>
						<td onClick="location.href='{{ action('ForumController@show', array($forum->id)) }}'">{{ $forum->nome }}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
	    </div>
</div>
@stop