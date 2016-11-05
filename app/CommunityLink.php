<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    protected $fillable = ["title", "link", "channel_id"];

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public static function from(User $user)
    {
    	$link = new static;

    	$link->user_id = $user->id;

    	// TEMPORARY
    	$link->channel_id = 1;

    	return $link;
    }

    public function contribute($attributes)
    {
    	return $this->fill($attributes)->save();
    }
}
