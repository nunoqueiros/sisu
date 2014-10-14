<?php

class UnidadeController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$unidades = DB::table('Unidade')->get();

		//$unidades = json_encode($unidades);

		//$unidades = json_decode($unidades);

		//return $unidades;

		return View::make('unidades.index')->with('unidades', $unidades);
      
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return View::make('unidades.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$result = Input::all();

		$validator = Validator::make(
   							 array(
   							 	'nome' => $result['nome'],
   							 	'sigla' => $result['sigla'],
   							 	'NIF' => $result['NIF'],
   							 	'localizacao' => $result['localizacao'],
   							 	'coordenadas' => $result['coordenadas'],
   							 	'contacto' => $result['contacto']
   							 	),
    						 array(
    						 	'nome' => 'required|min:5',
   							 	'sigla' => 'required|max:5',
   							 	'NIF' => 'required|numeric',
   							 	'localizacao' => 'required',
   							 	'coordenadas' => 'required',
   							 	'contacto' => 'required|numeric'
    						 	)
    						 );

    	if ($validator->fails()) {

    		return Redirect::action('UnidadeController@create')->withErrors($validator);
    	}
    	else {
    		$id = DB::table('Unidade')->insertGetId(array('nome' =>$result['nome'], 'sigla' =>$result['sigla'], 'nif' =>$result['NIF'], 'localizacao' =>$result['localizacao'], 'coordenadas' =>$result['coordenadas'], 'contacto' =>$result['contacto']));
    		return Redirect::action('UnidadeController@show', array($id));
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
		$unidade = DB::table('Unidade')->where('id',$id)->first();

		$servicos = DB::table('Servico')->where('id_unidade',$id)->get();

		return View::make('unidades.show')->with('unidade', $unidade)->with('servicos', $servicos);
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
	public function update($id_unidade)
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

	/*
	public function addServico($id_unidade)
	{
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
	*/
}
