<?php

class ForumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$id_clinico = Session::get('userId');

		// especialidades (ids) em que o clínico se encontra ativo
		$especialidades_user = DB::table('User_Servico_Especialidade_Periodo')
									->join('Periodo', 'User_Servico_Especialidade_Periodo.id_periodo','=','Periodo.id')
									->distinct()
									->where('id_user',$id_clinico)
									->whereNull('data_fim')
									->lists('id_especialidade');

		// servicos (ids) em que o clínico se encontra ativo							
		$servicos_user = DB::table('User_Servico_Especialidade_Periodo')
									->join('Periodo', 'User_Servico_Especialidade_Periodo.id_periodo','=','Periodo.id')
									->distinct()
									->where('id_user',$id_clinico)
									->whereNull('data_fim')
									->lists('id_servico');

		// superservicos (ids) dos servicos em que o clinico se encontra ativo
		$superservicos_user = DB::table('Servico')
									->whereIn('id', $servicos_user)
									->lists('id_superservico');

		// unidades (ids) em que o clínico se encontra ativo	
		$unidades_user = DB::table('User_Servico_Especialidade_Periodo')
										->join('Periodo', 'User_Servico_Especialidade_Periodo.id_periodo','=','Periodo.id')
										->join('Servico', 'User_Servico_Especialidade_Periodo.id_servico', '=', 'Servico.id')
										->join('Unidade','Servico.id_unidade','=','Unidade.id')
										->distinct()
										->where('id_user',$id_clinico)
										->lists('id_unidade');

		// foruns das unidades do clínico
		$foruns_unidades = DB::table('Foruns')
								->whereIn('id_unidade', $unidades_user)
								->whereNull('id_especialidade')
								->whereNull('id_servico')
								->whereNull('id_superservico')
								->whereNull('id_forum_pai')
								->get();

		// foruns das especialidades do clínico
		$foruns_especialidades = DB::table('Foruns')
										->whereIn('id_especialidade', $especialidades_user)
										->whereNull('id_unidade')
										->whereNull('id_servico')
										->whereNull('id_superservico')
										->whereNull('id_forum_pai')
										->get();

		// foruns dos super servicos do clínico
		$foruns_superservicos = DB::table('Foruns')
										->whereIn('id_superservico', $superservicos_user)
										->whereNull('id_unidade')
										->whereNull('id_servico')
										->whereNull('id_unidade')
										->whereNull('id_forum_pai')
										->get();


		// foruns das especialidades das unidades do clínico
		$foruns_especialidades_das_unidades = DB::table('Foruns')
													->whereIn('id_unidade', $unidades_user)
													->whereIn('id_especialidade', $especialidades_user)
													->whereNull('id_forum_pai')
													->get();

		// foruns dos servicos das unidades do clínico
		$foruns_servicos_das_unidades = DB::table('Foruns')
													->whereIn('id_unidade', $unidades_user)
													->whereIn('id_servico', $servicos_user)
													->whereNull('id_forum_pai')
													->get();


		return View::make('foruns.index')
						->with('foruns_unidades', $foruns_unidades)
						->with('foruns_especialidades', $foruns_especialidades)
						->with('foruns_superservicos',$foruns_superservicos)
						->with('foruns_especialidades_das_unidades',$foruns_especialidades_das_unidades)
						->with('foruns_servicos_das_unidades',$foruns_servicos_das_unidades);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$forum = DB::table('Foruns')->where('id',$id)->first();

		$topicos = DB::table('Topico')
						->join('users', 'Topico.id_utilizador', '=', 'users.id')
						->select('Topico.*', 'first_name', 'last_name')
						->where('id_forum',$id)
						->where('eliminado',FALSE)
						->get();

		$subforuns = DB::table('Foruns')->where('id_forum_pai', $forum->id)->get();
		/*
		foreach($topicos as $topico) {

			$ultimo_post = DB::table('Post')
								->join('users', 'Post.id_utilizador', '=', 'users.id')
								->where('id_topico',$topico->id)
								->select('Post.*', 'first_name', 'last_name')
								->orderBy('data', 'desc')
								->first();

			$topico->ultimo_post = $ultimo_post;
		}
		*/

		//return $topicos;
		return View::make('foruns.show')->with('forum', $forum)->with('topicos', $topicos)->with('subforuns', $subforuns);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function create_subforum($id_forum_pai)
	{
		$forum_pai = DB::table('Foruns')->where('id',$id_forum_pai)->first();

		return View::make('foruns.create')->with('forum_pai', $forum_pai);
	}

	public function store_subforum($id_forum_pai)
	{	
		$result = Input::all();

		$id = DB::table('Foruns')->insertGetId(array('nome' => $result['titulo'], 'id_forum_pai' => $id_forum_pai));

		return Redirect::action('ForumController@show', array($id_forum_pai));
	}


}
