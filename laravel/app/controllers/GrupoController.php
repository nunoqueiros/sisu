<?php

class GrupoController extends \BaseController {

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
		$grupo = DB::table('Grupo_variaveis')->where('id',$id)->first();

		$variaveis = DB::table('GrupoVariaveis_Variaveis')
						->join('Variavel','GrupoVariaveis_Variaveis.id_variavel','=','Variavel.id')
						->where('id_grupo',$id)
						->get();

		return View::make('grupos.show')->with('grupo', $grupo)->with('variaveis',$variaveis);
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

	public function addVariavel_create($id_grupo)
	{
		$grupo = DB::table('Grupo_variaveis')->where('id',$id_grupo)->first();

		$variaveis = DB::table('Variavel')->lists('nome', 'id');

		return View::make('grupos.addVariavel_create', compact('variaveis'))->with('grupo',$grupo);
	}


	public function addVariavel_store($id_grupo)
	{
		$result = Input::all();
		
		$validator = Validator::make(
   							 array(
   							 	'id_variavel' => $result['id_variavel']
   							 	),
    						 array(
    						 	'id_variavel' => 'required'
    						 	)
    						 );

		if ($validator->fails()) {

    		return Redirect::action('GrupoController@addVariavel_create', array($id_grupo))->withErrors($validator);
    	}
    	else {
    		$id = DB::table('GrupoVariaveis_Variaveis')->insertGetId(array('id_grupo' => $id_grupo, 'id_variavel' => $result['id_variavel']));
    		return Redirect::action('GrupoController@show', array($id_grupo));
    	}
	}

}
