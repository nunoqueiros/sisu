@extends('layouts.default')
 
{{-- Web site Title --}}
@section('title')
@parent
Variáveis
@stop
 
{{-- Content --}}
@section('content')
<div class="page-header">
    <h1><a onClick="location.href='{{ action('MensagensController@index') }}'">Mensagens</a></h1>
</div>
<ul class="nav nav-pills">
  <li>
    <a onClick="location.href='{{ action('MensagensController@create') }}'">Enviar Nova Mensagem</a>
  </li>
  <li>
    <a onClick="location.href='{{ action('MensagensController@show_entrada') }}'">Caixa de Entrada</a>
  </li>
  <li>
    <a onClick="location.href='{{ action('MensagensController@show_saida') }}'">Caixa de Saída</a>
  </li>
    <li>
    <a onClick="location.href='{{ action('MensagensController@reciclagem') }}'">Reciclagem</a>
  </li>
</ul>

@stop