<?php

class ServicoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id_unidade)
	{
		//
		$unidade = DB::table('Unidade')->where('id',$id_unidade)->first();

		return View::make('servicos.create')->with('unidade', $unidade);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id_unidade)
	{
		//
		$result = Input::all();

		$validator = Validator::make(
   							 array(
   							 	'nome' => $result['nome'],
   							 	'sigla' => $result['sigla']
   							 	),
    						 array(
    						 	'nome' => 'required|min:5',
   							 	'sigla' => 'required|max:5'
    						 	)
    						 );

		if ($validator->fails()) {

    		return Redirect::action('ServicoController@create', array($id_unidade))->withErrors($validator);
    	}
    	else {
    		$id = DB::table('Servico')->insertGetId(array('nome' =>$result['nome'], 'sigla' =>$result['sigla'], 'id_unidade' =>$id_unidade));
    		return Redirect::action('UnidadeController@show', array($id_unidade));
    	}
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
		$servico = DB::table('Servico')->where('id',$id)->first();

		$unidade = DB::table('Unidade')->where('id',$servico->id_unidade)->first();

		$clinicos = DB::table('User_Servico_Especialidade_Periodo')
						->join('users', 'User_Servico_Especialidade_Periodo.id_user','=','users.id')
						->join('Especialidade', 'User_Servico_Especialidade_Periodo.id_especialidade','=','Especialidade.id')
						->join('Periodo', 'User_Servico_Especialidade_Periodo.id_periodo','=','Periodo.id')
						->where('id_servico',$id)
						->whereNull('data_fim')
						//->groupBy('User_Servico_Especialidade_Periodo.id_user')
						->get();

						//return $clinicos;

		return View::make('servicos.show')->with('servico', $servico)->with('clinicos',$clinicos)->with('unidade',$unidade);
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

	public function addClinico_create($id_servico)
	{
		$servico = DB::table('Servico')->where('id',$id_servico)->first();

		$unidade = DB::table('Unidade')->where('id',$servico->id_unidade)->first();

		$clinicos = DB::table('users')->lists('username', 'id');

		$especialidades = DB::table('Especialidade')->lists('nome', 'id');

		return View::make('servicos.addClinico_create', compact('clinicos'), compact('especialidades'))->with('servico', $servico)->with('unidade',$unidade);
	}

	public function addClinico_store($id_servico)
	{
		$result = Input::all();

		$servico = DB::table('Servico')->where('id',$id_servico)->first();
		$unidade = DB::table('Unidade')->where('id',$servico->id_unidade)->first();

		$validator = Validator::make(
   							 array(
   							 	'id_clinico' => $result['id_clinico'],
   							 	'id_especialidade' => $result['id_especialidade'],
								'data_inicio' => $result['data_inicio'],
								'data_fim' => $result['data_fim']
   							 	),
    						 array(
    						 	'id_clinico' => 'required',
   							 	'id_especialidade' => 'required',
   							 	'data_inicio' => 'required|date',
   							 	'data_fim' => 'date'
    						 	)
    						 );

		$data_inicio_old = $result['data_inicio'];
		$data_inicio = date("Y-m-d", strtotime($data_inicio_old));

		$data_fim_old = $result['data_fim'];
		$data_fim = NULL;
		if(!$data_fim_old=="") {
			$data_fim = date("Y-m-d", strtotime($data_fim_old));
		}

		if ($validator->fails()) {

    		return Redirect::action('ServicoController@addClinico_create', array($id_servico))->withErrors($validator);
    	}
    	else {
    		$id_periodo = DB::table('Periodo')->insertGetId(array('data_inicio' =>$data_inicio, 'data_fim' =>$data_fim));
    		$id = DB::table('User_Servico_Especialidade_Periodo')->insertGetId(array('id_user' => $result['id_clinico'], 'id_servico' => $id_servico, 'id_especialidade' => $result['id_especialidade'], 'id_periodo' => $id_periodo));
    		return Redirect::action('ServicoController@show', array($unidade->id));
    	}
	}
}