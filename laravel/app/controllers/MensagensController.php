<?php

class MensagensController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return View::make('mensagens.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// 
        return View::make('mensagens.create');
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

		//remetente
		$remetente = Session::get('userId');

 
        $id_mensagem = DB::table('Mensagem')->insertGetId(array('assunto' =>$result['assunto'], 'corpo' =>$result['mensagem'], 'id_utilizador' =>$remetente));

        //destinatários

 		//coloca emails num array
        $destinatarios = array_map('trim', explode(',', $result["destinatarios"]));

        foreach($destinatarios as $dest) {
        	$destinatario = DB::table('users')->where('email',$dest)->first();
        	$id_mensagem_saida = DB::table('User_Mensagem')->insertGetId(array('id_user'=>$destinatario->id, 'id_mensagem'=>$id_mensagem));
        }
 
        return Redirect::action('MensagensController@show_saida');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$id_clinico = Session::get('userId');

		//marcar como lida
		DB::table('User_Mensagem')->where('id_mensagem', $id)->where('id_user',$id_clinico)->update(array('lido' => 'TRUE'));

		//$mensagem = DB::table('Mensagem')->where('id',$id)->first();

		//$remetente = DB::table('users')->where('id',$mensagem->id_utilizador)->first();

		//return View::make('mensagens.show')->with('mensagem', $mensagem)->with('remetente',$remetente);

		//var_dump($mensagem);
		//$mensagem = (array) $mensagem;
		//$remetente = (array) $remetente;

		//$mensagem["remetente"]=$remetente;

		$mensagem = DB::table('User_Mensagem')
							->join('Mensagem','User_Mensagem.id_mensagem','=','Mensagem.id')
							->join('users','Mensagem.id_utilizador','=','users.id')
							->where('id_user',$id_clinico)
							->where('id_mensagem',$id)
							->get();

		return $mensagem;

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

	public function emails()
	{
		//
		
		$emails = DB::table('users')->lists('email');

		//$emails = DB::table('users')->select('email')->get();

		return $emails;

	}

	public function show_saida()
	{
		$id_clinico = Session::get('userId');

		$mensagens = DB::table('Mensagem')->where('id_utilizador',$id_clinico)->get();
 
        return View::make('mensagens.caixa_saida')->with('mensagens', $mensagens);
	}

	public function show_entrada()
	{
		$id_clinico = Session::get('userId');

		$mensagens = DB::table('User_Mensagem')
							->join('Mensagem','User_Mensagem.id_mensagem','=','Mensagem.id')
							->join('users','Mensagem.id_utilizador','=','users.id')
							->where('id_user',$id_clinico)
							->where('reciclagem', FALSE)
							->get();

		return View::make('mensagens.caixa_entrada')->with('mensagens', $mensagens);
	}

	public function responder($id)
	{
		//$id_clinico = Session::get('userId');

		$mensagem = DB::table('Mensagem')->where('id',$id)->first();

		$remetente = DB::table('users')->where('id',$mensagem->id_utilizador)->first();

		return View::make('mensagens.responder')->with('mensagem', $mensagem)->with('remetente',$remetente);
	}

	public function enviar_reciclagem($id)
	{
		$id_clinico = Session::get('userId');

		//marcar como lida
		DB::table('User_Mensagem')->where('id_mensagem', $id)->where('id_user',$id_clinico)->update(array('reciclagem' => 'TRUE'));

		return Redirect::action('MensagensController@reciclagem');
	}

	public function reciclagem()
	{
		$id_clinico = Session::get('userId');

		$mensagens = DB::table('User_Mensagem')
							->join('Mensagem','User_Mensagem.id_mensagem','=','Mensagem.id')
							->join('users','Mensagem.id_utilizador','=','users.id')
							->where('id_user',$id_clinico)
							->where('reciclagem', TRUE)
							->get();

		return View::make('mensagens.reciclagem')->with('mensagens', $mensagens);
	}
}
