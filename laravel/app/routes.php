<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Session Routes
Route::get('login',  array('as' => 'login', 'uses' => 'SessionController@create'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionController@destroy'));
Route::resource('sessions', 'SessionController', array('only' => array('create', 'store', 'destroy')));

// User Routes
Route::get('register', 'UserController@create');
Route::get('users/{id}/activate/{code}', 'UserController@activate')->where('id', '[0-9]+');
Route::get('resend', array('as' => 'resendActivationForm', function()
{
	return View::make('users.resend');
}));
Route::post('resend', 'UserController@resend');
Route::get('forgot', array('as' => 'forgotPasswordForm', function()
{
	return View::make('users.forgot');
}));
Route::post('forgot', 'UserController@forgot');
Route::post('users/{id}/change', 'UserController@change');
Route::get('users/{id}/reset/{code}', 'UserController@reset')->where('id', '[0-9]+');
Route::get('users/{id}/suspend', array('as' => 'suspendUserForm', function($id)
{
	return View::make('users.suspend')->with('id', $id);
}));
Route::post('users/{id}/suspend', 'UserController@suspend')->where('id', '[0-9]+');
Route::get('users/{id}/unsuspend', 'UserController@unsuspend')->where('id', '[0-9]+');
Route::get('users/{id}/ban', 'UserController@ban')->where('id', '[0-9]+');
Route::get('users/{id}/unban', 'UserController@unban')->where('id', '[0-9]+');
Route::resource('users', 'UserController');

// Unidades
Route::post('unidades/{id}/addServico', 'UnidadeController@addServico');
Route::resource('unidades', 'UnidadeController');

// Servicos
Route::get('servicos/{id}/create', 'ServicoController@create');
Route::post('servicos/{id}/store', 'ServicoController@store');
Route::get('servicos/{id}/addClinico_create', 'ServicoController@addClinico_create');
Route::post('servicos/{id}/addClinico_store', 'ServicoController@addClinico_store');
Route::resource('servicos', 'ServicoController');

// Vistas
Route::get('vistas/{id}/addGrupo_create', 'VistaController@addGrupo_create');
Route::post('vistas/{id}/addGrupo_store', 'VistaController@addGrupo_store');
Route::resource('vistas', 'VistaController');

// Grupos Variáveis
Route::get('grupos/{id}/addVariavel_create', 'GrupoController@addVariavel_create');
Route::post('grupos/{id}/addVariavel_store', 'GrupoController@addVariavel_store');
Route::resource('grupos', 'GrupoController');

// Variaveis
Route::resource('variaveis', 'VariavelController');
Route::get('get_estruturasValidas/{id_tipo}', 'VariavelController@get_estruturasValidas');
Route::get('get_campos/{id_estrutura}', 'VariavelController@get_campos');

// Group Routes
Route::resource('groups', 'GroupController');

// Pacientes
Route::resource('pacientes', 'PacienteController');

// Teste2
Route::get('grupo_da_vista/{id}', 'PacienteController@grupo_da_vista');
Route::get('variaveis_do_grupo/{id}', 'PacienteController@variaveis_do_grupo');

// Mensagens
Route::resource('mensagens', 'MensagensController');
Route::get('emails', 'MensagensController@emails');
Route::get('caixa_saida', 'MensagensController@show_saida');
Route::get('caixa_entrada', 'MensagensController@show_entrada');
Route::get('mensagens/{id}/responder', 'MensagensController@responder');
Route::get('reciclagem', 'MensagensController@reciclagem');
Route::get('enviar_reciclagem/{id}', 'MensagensController@enviar_reciclagem');

// Foruns
Route::resource('foruns', 'ForumController');
Route::resource('topicos', 'TopicoController');
Route::get('create_topico/{id_forum}', 'TopicoController@create_topico');
Route::post('store_topico/{id_forum}', 'TopicoController@store_topico');
Route::get('get_post/{id}', 'TopicoController@get_post');
Route::post('store_post/{id}', 'TopicoController@store_post');
Route::get('eliminar_post/{id}', 'TopicoController@eliminar_post');
Route::get('create_subforum/{id_forum_pai}', 'ForumController@create_subforum');
Route::post('store_subforum/{id_forum_pai}', 'ForumController@store_subforum');

// Dados clinicos
Route::resource('dadosclinicos', 'DadosClinicosController');
Route::get('tipos_dadosclinicos/{id}', 'DadosClinicosController@tipos_dadosclinicos');
Route::get('especialidades_vistas', 'DadosClinicosController@especialidades_vistas');
Route::get('vistas_respetivas/{id_tipodadoclinico}/{id_especialidade}', 'DadosClinicosController@vistas_respetivas');
Route::get('vistas_desassociadas/{id_tipodadoclinico}/{id_especialidade}', 'DadosClinicosController@vistas_desassociadas');
Route::get('add_tipodadoclinico', 'DadosClinicosController@add_tipodadoclinico');

// Triggers
Route::resource('triggers', 'TriggersController');
Route::get('get_acoesValidas/{id_variavel}', 'TriggersController@get_acoesValidas');
Route::get('get_campos/{id_acao}', 'TriggersController@get_campos');
Route::get('get_configVariavel/{id_variavel}', 'TriggersController@get_configVariavel');


Route::get('/', array('as' => 'home', function()
{
	return View::make('home2');
}));


// App::missing(function($exception)
// {
//     App::abort(404, 'Page not found');
//     //return Response::view('errors.missing', array(), 404);
// });





