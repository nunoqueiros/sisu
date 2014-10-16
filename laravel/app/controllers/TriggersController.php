<?php

class TriggersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$variaveis = DB::table('Variavel')->lists('nome','id');

		return View::make('triggers.create', compact('variaveis'));
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
		$input = Input::all();

		return $input;
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

	// acoes válidas para a variavel selecionada
	public function get_acoesValidas($id_variavel) {

		$variavel = DB::table('Variavel')->where('id',$id_variavel)->first();

		$acoes_validas = DB::table('TipoVariavel_EstruturaVariavel_Acao')
								->join('Acao','TipoVariavel_EstruturaVariavel_Acao.id_acao','=','Acao.id')
								->where('id_tipovariavel',$variavel->id_tipo)
								->where('id_estruturavariavel',$variavel->id_estrutura)
								->get();

		//$acoes_validas["tipo"] = $variavel->id_tipo;

		return $acoes_validas;
	}

	// valores config da variavel
	public function get_configVariavel($id_variavel) {

		$configVariavel = DB::table('ConfigVariavel')
									->join('Campos','ConfigVariavel.id_campo','=','Campos.id')
									->where('id_variavel',$id_variavel)
									->select('ConfigVariavel.*','Campos.nome')
									->get();

		return $configVariavel;
	}

	public function get_camposAcao($id_acao)
	{
		$camposAcao = DB::table('Acao_CamposAR')
						->join('CamposAR','Acao_CamposAR.id_campoacao','=','CamposAR.id')
						->where('id_acao',$id_acao)
						->get();

		return $camposAcao;
	}
}
