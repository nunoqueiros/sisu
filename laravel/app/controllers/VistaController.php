<?php

class VistaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$vistas = DB::table('Vista')->get();

		return View::make('vistas.index')->with('vistas', $vistas);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return View::make('vistas.create');
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
   							 	'nome' => $result['nome']
   							 	),
    						 array(
    						 	'nome' => 'required|min:5'
    						 	)
    						 );

    	if ($validator->fails()) {

    		return Redirect::action('VistaController@create')->withErrors($validator);
    	}
    	else {
    		$id = DB::table('Vista')->insertGetId(array('nome' =>$result['nome']));
    		return Redirect::action('VistaController@index');
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
		$vista = DB::table('Vista')->where('id',$id)->first();

		$grupos = DB::table('Vista_GrupoVariaveis')
						->join('Grupo_variaveis','Vista_GrupoVariaveis.id_grupo','=','Grupo_variaveis.id')
						->where('id_vista',$id)
						->get();

		return View::make('vistas.show')->with('vista', $vista)->with('grupos',$grupos);
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

	public function addGrupo_create($id_vista)
	{
		$vista = DB::table('Vista')->where('id',$id_vista)->first();

		$grupos = DB::table('Grupo_variaveis')->lists('nome', 'id');

		return View::make('vistas.addGrupo_create', compact('grupos'))->with('vista',$vista);
	}

	public function addGrupo_store($id_vista)
	{
		$result = Input::all();

		$validator = Validator::make(
   							 array(
   							 	'id_grupo' => $result['id_grupo']
   							 	),
    						 array(
    						 	'id_grupo' => 'required'
    						 	)
    						 );

		if ($validator->fails()) {

    		return Redirect::action('VistaController@addGrupo_create', array($id_vista))->withErrors($validator);
    	}
    	else {
    		$id = DB::table('Vista_GrupoVariaveis')->insertGetId(array('id_vista' => $id_vista, 'id_grupo' => $result['id_grupo']));
    		return Redirect::action('VistaController@show', array($id_vista));
    	}
	}

}
