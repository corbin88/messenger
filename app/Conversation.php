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

	//Scopes

	public static function findOrCreateBetween(\App\User $user, \App\User $other_user)
	{
		$user_participates = $user->privateConversations();
		$other_user_participates = $other_user->privateConversations();
		$static = new static;
		$shared_participations = collect(array_intersect($user_participates, $other_user_participates));
		return $shared_participations->isEmpty() ? $static->createBetween($user, $other_user) : $static->find($shared_participations->first());
	}
	public function createBetween($user, $other_user)
	{
		$conversation = $this->create([
			'name' => 'Conversation between ' . $user->name . ' and ' . $other_user->name,
			'is_private' => true
		]);
		$conversation->participants()->sync([$user->id, $other_user->id]);
		return $conversation;
	}
}
