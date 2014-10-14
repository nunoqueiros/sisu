@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('SISU')}}
@stop

{{-- Content --}}
@section('content')

<div class="jumbotron">
  <div class="container" align="center">
    <h2><strong>Sistema de Informação de Sarcomas Uterinos</strong></h2>
    <!--<p>{{trans('pages.description')}}</p>-->
  </div>
</div>

@if (!Sentry::check())
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {{ Form::open(array('action' => 'SessionController@store')) }}

            <h2 class="form-signin-heading">Iniciar Sessão</h2>

            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email', 'autofocus')) }}
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
            
            <label class="checkbox">
                {{ Form::checkbox('rememberMe', 'rememberMe') }} Remember me
            </label>
            {{ Form::submit('Sign In', array('class' => 'btn btn-primary'))}}
            <!-- <a class="btn btn-link" href="{{ route('forgotPasswordForm') }}">Forgot Password</a> -->
        {{ Form::close() }}
    </div>
</div>
@endif

@if (Sentry::check() )
	<div class="panel panel-success">
		 <div class="panel-heading">
			<h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span> {{trans('pages.loginstatus')}}</h3>
		</div>
		<div class="panel-body">
			<p><strong>{{trans('pages.sessiondata')}}:</strong></p>
			<pre>{{ var_dump(Session::all()) }}</pre>
		</div>
	</div>
@endif 
 
 
@stop