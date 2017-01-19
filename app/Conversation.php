<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['name', 'is_private'];
	protected $table = 'conversations';
	protected $guarded = ['id'];

	//Relationships
	public function participants(){
		return $this->belongsToMany('App\User' ,'conversation_participants','conversation_id','user_id');
	}

	public function messages(){
		return $this->hasMany('App\Message','conversation_id');
	}
}
