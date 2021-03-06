<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationships
    
    public function conversations(){
        return $this->belongsToMany('App\Conversation','conversation_participants', 'user_id', 'conversation_id');
    }

    public function privateConversations()
    {
        return $this->conversations()->where(['is_private' => 1])->pluck('id')->toArray();
    }
}
