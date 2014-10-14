<?php

class PacienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//

		$id_clinico = Session::get('userId');
		
		$pacientes = DB::table('Clinico_Paciente')
							->join('Paciente','Clinico_Paciente.id_paciente','=','Paciente.id')
							->where('id_clinico',$id_clinico)
							->get();

		return View::make('pacientes.index')->with('pacientes', $pacientes);
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
		
		$paciente = DB::table('Paciente')->where('id',$id)->first();

		$id_clinico = Session::get('userId');

		$vistas = DB::table('User_Servico_Especialidade_Periodo')
						->join('Periodo', 'User_Servico_Especialidade_Periodo.id_periodo','=','Periodo.id')
						->join('Especialidade_Vista', 'User_Servico_Especialidade_Periodo.id_especialidade','=', 'Especialidade_Vista.id_especialidade')
						->join('Vista','Especialidade_Vista.id_vista','=','Vista.id')
						->where('id_user',$id_clinico)
						->whereNull('data_fim')
						//->groupBy('User_Servico_Especialidade_Periodo.id_user')
						->select('nome','id_vista')
						//->orderBy('id_vista')
						->distinct()
						->get();

		return View::make('pacientes.show')->with('paciente', $paciente)->with('vistas', $vistas);
		//$vistas[0];

		//$vistas = json_encode($vistas[0]);

		//$vistas = array_add($vistas, 'key', 'value');

		//$array = $vistas[0];

		//var_dump($vistas);

		//return $vistas['nome'];

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

	public function grupo_da_vista($id_vista)
	{
		$grupos = DB::table('Vista_GrupoVariaveis')
						->join('Grupo_variaveis', 'Vista_GrupoVariaveis.id_grupo','=','Grupo_variaveis.id')
						->where('id_vista',$id_vista)
						->get();

		//return $grupos[0]["variaveis"];

		return $grupos;
	}

	public function variaveis_do_grupo($id_grupo)
	{
		$variaveis = DB::table('GrupoVariaveis_Variaveis')
						->join('Variavel', 'GrupoVariaveis_Variaveis.id_variavel','=','Variavel.id')
						->where('id_grupo',$id_grupo)
						->get();

		return $variaveis;

		//return $grupos;
	}
}
