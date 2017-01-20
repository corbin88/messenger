<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Conversation;
use App\User;


class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();

    	return view('conversations.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Find a conversation between the user and another, or create it
     * 
     * @param  User   $user
     * @return Response
     */
    public function find(User $user, $recieverUserId)
    {
        //Need to refactor to use route model binding
        $recievingUser = User::find($recieverUserId);
        $conversation = Conversation::findOrCreateBetween(Auth::user(), $recievingUser);
        return $this->show($conversation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Conversation $conversation)
    {
        $conversation->load('participants');
        $messages = $conversation->messages()->with('sender')->latest()->take(5)->get()->sortBy('created_at');
        return view('conversations.show', compact('conversation', 'messages'));

    }
}
