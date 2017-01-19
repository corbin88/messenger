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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function startConversation(Request $request, $recieverUserId)
    {   

        //Needs refactoring
        $user = Auth::user();
        $userWithConversationParticipants = $user->where(['id'=> Auth::user()->id])->with(['conversations.participants' => function ($query) use ($recieverUserId) {
            $query->where(['id' =>  $recieverUserId]);
        }])->get(); 

        foreach ($userWithConversationParticipants as $userConversations) {
            foreach ($userConversations['conversations'] as $userParticipants) {
               $userParticipants['participants'];
            }
        }
        if(empty($userParticipants))
        {
            $participantsIds = [$user->id, $recieverUserId];
            $newConversation =  Conversation::create(['name' => "A private conversation."]);
            $newConversation->participants()->attach($participantsIds);

            return redirect('conversations/'.$recieverUserId);
        }

            return redirect('conversations/'.$recieverUserId);  
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //User::find($id);

        return view('conversations.show', compact('id'));
    }
}
