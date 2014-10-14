<?php

class DadosClinicosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$dados = DB::table('DadosClinicos')->orderBy('nome', 'asc')->lists('nome', 'id');

		$especialidades = DB::table('Especialidade')->lists('nome','id');

		$vistas = DB::table('Vista')->lists('nome','id');
		
		return View::make('dadosclinicos.index', compact('dados','especialidades','vistas'));
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
		$result = Input::all();

		$vistas_associadas = Input::get("vistas");

		foreach($vistas_associadas as $vista) { 
			
			$query = DB::table('TipoDadoClinico_Especialidade_Vista')
							->where('id_tipodadoclinico', $result['tipo_dadoclinico'])
							->where('id_especialidade', $result['especialidades'])
							->where('id_vista', $vista)
							->first();

			if(is_null($query)) {
				$id = DB::table('TipoDadoClinico_Especialidade_Vista')->insertGetId(array('id_tipodadoclinico' => $result['tipo_dadoclinico'], 'id_especialidade' => $result['especialidades'], 'id_vista' => $vista ));
			}
		}

		// remover vistas que levaram uncheck
		DB::table('TipoDadoClinico_Especialidade_Vista')
			->where('id_tipodadoclinico', $result['tipo_dadoclinico'])
			->where('id_especialidade', $result['especialidades'])
			->whereNotIn('id_vista',$vistas_associadas)
			->delete();

		return Redirect::action('DadosClinicosController@index');
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

	public function tipos_dadosclinicos($id_dado)
	{
		$tipos_dadosclinicos = DB::table('TipoDadoClinico')
									->where('id_dadoclinico',$id_dado)
									->orderBy('nome', 'asc')
									->get();

		return $tipos_dadosclinicos;
	}

	public function vistas_respetivas($id_tipodadoclinico, $id_especialidade)
	{
		// vistas associadas
		$vistas_associadas = DB::table('TipoDadoClinico_Especialidade_Vista')
						->where('id_tipodadoclinico', $id_tipodadoclinico)
						->where('id_especialidade', $id_especialidade)
						->join('Vista', 'TipoDadoClinico_Especialidade_Vista.id_vista','=','Vista.id')
						->select('Vista.*')
						->get();

		foreach ($vistas_associadas as $vista ) {
  			$vista->associada = "sim";
  		}

  		// vistas desassociadas
  		$vistas_associadas_ = DB::table('TipoDadoClinico_Especialidade_Vista')
						->where('id_tipodadoclinico', $id_tipodadoclinico)
						->where('id_especialidade', $id_especialidade)
						->join('Vista', 'TipoDadoClinico_Especialidade_Vista.id_vista','=','Vista.id')
						->select('Vista.*')
						->lists('Vista.id');

		$vistas_desassociadas = DB::table('Vista')->whereNotIn('id',$vistas_associadas_)->get();

		foreach ($vistas_desassociadas as $vista ) {
  			$vista->associada = "nao";
  		}

  		// conjunto de vistas ordenado por nome
  		$final = array_merge((array)$vistas_associadas, (array)$vistas_desassociadas);

  		usort($final,function($a,$b) {return strnatcasecmp($a->nome,$b->nome);});

  		return $final;
	}

	public function vistas_desassociadas($id_tipodadoclinico, $id_especialidade)
	{
		$vistas_associadas = DB::table('TipoDadoClinico_Especialidade_Vista')
						->where('id_tipodadoclinico', $id_tipodadoclinico)
						->where('id_especialidade', $id_especialidade)
						->join('Vista', 'TipoDadoClinico_Especialidade_Vista.id_vista','=','Vista.id')
						->select('Vista.*')
						->lists('Vista.id');

		$vistas_desassociadas = DB::table('Vista')->whereNotIn('id',$vistas_associadas)->get();

		return $vistas_desassociadas;
	}

	public function add_tipodadoclinico()
	{
		return "CHEGOU";
		$result = Input::all();

		$id = DB::table('TipoDadoClinico')->insertGetId(array('nome' => $result['tipodadoclinico'], 'id_dado' => $result['dadosclinicos']));

		return Redirect::action('DadosClinicosController@index');
	}


}
