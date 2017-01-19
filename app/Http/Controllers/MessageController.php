<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;

class MessageController extends Controller
{

	public $user; 
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = Auth::user();
	}
	/**
	 * Store a new instance of a message in the conversation
	 * 
	 * @param  Request      $request
	 * @param  $id
	 * @return Response
	 */
	public function store($id, Request $request)
	{
		Message::create([
			'body' => $request->input('message'),
			'conversation_id' => $id,
			//need to change sender_id to use $this->user->id;
			'sender_id' => Auth::user()->id,
			'type' => 'user_message'
		]);
		return redirect()->back();
	}
}
