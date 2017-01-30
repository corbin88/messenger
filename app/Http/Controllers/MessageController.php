<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Redis;
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
		$message = Message::create([
			'body' => $request->input('message'),
			'conversation_id' => $id,
			//need to change sender_id to use $this->user->id;
			'sender_id' => Auth::user()->id,
			'type' => 'user_message'
		]);

		$redis = Redis::connection();

		$data = ['message' => $request->input('message'), 'user' => Auth::user()->name,
		 'room' => $message->conversation_id];
		$redis->publish('message', json_encode($data));

		Redis::get('message');
		response()->json([]);
		
	}
}
