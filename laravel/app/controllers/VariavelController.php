<?php

class VariavelController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$variaveis = DB::table('Variavel')->get();

		return View::make('variaveis.index')->with('variaveis', $variaveis);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$tipos = DB::table('TipoVariavel')->lists('nome', 'id');

		return View::make('variaveis.create', compact('tipos'));
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

		return $result;

		$id_variavel = DB::table('Variavel')->insertGetId(array('nome' =>$result['nome'], 'id_tipo' =>$result['tipo'], 'id_estrutura' =>$result['estrutura']));

		//$id = DB::table('TipoVariavel_EstruturaVariavel')->insertGetId(array('id_tipo'=>$result['tipo'], 'id_estrutura'=>$result['estrutura']));


    	return Redirect::action('VariavelController@show', array($id_variavel));

		/*$validator = Validator::make(
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
    	}*/
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
		$variavel = DB::table('Variavel')->where('id',$id)->first();

		$tipo = DB::table('TipoVariavel')->where('id',$variavel->id_tipo)->first();

		$estrutura = DB::table('EstruturaVariavel')->where('id',$variavel->id_estrutura)->first();

		return View::make('variaveis.show')->with('variavel', $variavel)->with('tipo', $tipo)->with('estrutura',$estrutura);
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

	public function get_estruturasValidas($id_tipo)
	{
		//
		$estruturas_validas = DB::table('TipoVariavel_EstruturaVariavel')
									->join('EstruturaVariavel', 'TipoVariavel_EstruturaVariavel.id_estrutura','=','EstruturaVariavel.id')
									->where('id_tipo',$id_tipo)
									->get();

		return $estruturas_validas;
	}

	public function get_campos($id_estrutura)
	{
		$campos = DB::table('EstruturaVariavel_Campo')
						->join('Campos','EstruturaVariavel_Campo.id_campo','=','Campos.id')
						->where('id_estruturavariavel',$id_estrutura)
						->get();

		return $campos;
	}
}

