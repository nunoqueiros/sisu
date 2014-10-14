<?php

class TopicoController extends \BaseController {

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
		return "ENTROU";
		//$result = Input::all();
		//return $result;
		//return View::make('topicos.create');

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
		$user = Session::get('userId');

		$topico = DB::table('Topico')->where('id',$id)->first();

		$forum = DB::table('Foruns')->where('id', $topico->id_forum)->first();

		$posts = DB::table('Post')
						->join('users', 'Post.id_utilizador', '=', 'users.id')
						->select('Post.*','email')
						->where('id_topico',$id)
						->where('eliminado', FALSE)
						->orderBy('data', 'asc')
						->paginate(3);
						//->get();

		return View::make('topicos.show')->with('topico', $topico)->with('posts', $posts)->with('forum', $forum)->with('user',$user);
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
		//return "CHEGOU";
		//DB::table('Post')->where('id', $id)->update(array('eliminado' => TRUE));

		//$post = DB::table('Post')->where('id',$id)->first();

		return "CHEGOU";

		DB::table('Topico')->where('id', $id)->update(array('eliminado' => TRUE));

		$topico = DB::table('Topico')->where('id', $id)->first();

		return Redirect::action('ForumController@show', array($topico->id_forum));
	}

	public function store_post($id_topico)
	{
		$result = Input::all();

		$user = Session::get('userId');

		$post = $id = DB::table('Post')->insertGetId(array('texto' => $result["resposta"], 'id_topico' => $id_topico, 'id_utilizador' => $user));

		return Redirect::action('TopicoController@show', array($id_topico));
	}

	public function create_topico($id_forum)
	{
		$forum = DB::table('Foruns')->where('id',$id_forum)->first();

		return View::make('topicos.create')->with('forum', $forum);

	}

	public function store_topico($id_forum)
	{
		$result = Input::all();

		$user = Session::get('userId');

		$id_topico = DB::table('Topico')->insertGetId(array('nome' => $result["titulo"], 'id_forum' => $id_forum, 'id_utilizador' => $user));

		$id_post = DB::table('Post')->insertGetId(array('texto' => $result["texto"], 'id_topico' => $id_topico, 'id_utilizador' => $user));
		
		return Redirect::action('TopicoController@show', array($id_topico));
	}

	public function get_post($id_post)
	{
		$post = DB::table('Post')->where('id',$id_post)->get();

		return $post;
	}

	public function eliminar_post($id_post)
	{
		DB::table('Post')->where('id', $id_post)->update(array('eliminado' => TRUE));

		$post = DB::table('Post')->where('id',$id_post)->first();

		return Redirect::action('TopicoController@show', array($post->id_topico));
	}

}
