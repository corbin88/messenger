<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['body', 'conversation_id', 'sender_id', 'type'];
	protected $table = 'messages';
	protected $guarded = ['id'];

	//Relationships

	public function conversation(){
		return $this->belongsTo('App\Conversation', 'conversation_id');
	}

	public function sender()
	{
		return $this->belongsTo('App\User', 'sender_id');
	}  
}
