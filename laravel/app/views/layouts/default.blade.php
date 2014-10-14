<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title> 
			@section('title') 
			@show 
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Bootstrap 3.0: Latest compiled and minified CSS -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

		
		


   		<!--{{HTML::script('js/myjs.js');}}-->
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
   		<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->

   		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->

		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

 		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

 		<!-- dynamic tables-->
 		<!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">-->
 		<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

 		<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
 		<script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>

 		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css"> -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap-tokenfield.css') }}">
		<link rel="stylesheet" href="{{ asset('css/tokenfield-typeahead.css') }}">
		<link rel="stylesheet" href="{{ asset('css/listbox.css') }}">
		<link rel="stylesheet" href="{{ asset('css/index.css') }}">
		<link rel="stylesheet" href="{{ asset('css/summernote.css') }}">

		<style>
		@section('styles')
			body {
				padding-top: 60px;
			}
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	
	</head>

	<body>
		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{{ URL::route('home') }}">SISU</a>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
				@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
					<li {{ (Request::is('users/create') ? 'class="active"' : '') }}><a href="{{ URL::to('users/create') }}">Registar Novo Clínico</a></li>
					<li {{ (Request::is('unidades') ? 'class="active"' : '') }}><a href="{{ URL::to('unidades') }}">Unidades</a></li>
					<li {{ (Request::is('vistas') ? 'class="active"' : '') }}><a href="{{ URL::to('vistas') }}">Vistas</a></li>
					<li {{ (Request::is('variaveis') ? 'class="active"' : '') }}><a href="{{ URL::to('variaveis') }}">Variaveis</a></li>
					<li {{ (Request::is('dadosclinicos') ? 'class="active"' : '') }}><a href="{{ URL::to('dadosclinicos') }}">Dados Clínicos</a></li>
				@endif
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            @if (Sentry::check())
				<li {{ (Request::is('users/show/' . Session::get('userId')) ? 'class="active"' : '') }}><a href="{{ URL::to('users') }}/{{ Session::get('userId') }}">{{ Session::get('email') }}</a></li>
				<li><a href="{{ URL::to('logout') }}">Terminar Sessão</a></li>
				@endif
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('layouts/notifications')
			<!-- ./ notifications -->
			
			@if (Sentry::check())
		    <div id="sidebar-wrapper">
	            <ul class="sidebar-nav col-md-2">
	                <li><a href={{ URL::to('pacientes') }}>Pacientes</a>
	                </li>
	                <li><a href="#">Pesquisas</a>
	                </li>
	                <li><a href={{ URL::to('foruns') }}>Fórum</a>
	                </li>
	                <li><a href={{ URL::to('mensagens') }}>Mensagens</a>
	                </li>
	            </ul>
        	</div>

			<!-- Content -->
			<div class="col-md-10 content">
				@yield('content')
			</div>
			@endif

			@if (!Sentry::check())
				@yield('content')
			@endif


		</div>

		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->
		
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap-tokenfield.js') }}"></script>
		<script src="{{ asset('js/bootstrap3-typeahead.js') }}"></script>
		<script src="{{ asset('js/jquery.twbsPagination.js') }}"></script>
		<script src="{{ asset('js/bootstrap-wysiwyg.js') }}"></script>
		<script src="{{ asset('js/quickpager.jquery.js') }}"></script>
		<script src="{{ asset('js/listbox.js') }}"></script>
		<script src="{{ asset('js/jquery.pajinate.js') }}"></script>
		<script src="{{ asset('js/summernote.js') }}"></script>
		<script src="{{ asset('js/restfulizer.js') }}"></script>
		
		<!-- Thanks to Zizaco for the Restfulizer script.  http://zizaco.net  -->
	</body>
</html>
