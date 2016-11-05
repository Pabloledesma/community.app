<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    protected $fillable = ["title", "link", "channel_id"];

    public static function from(User $user)
    {
    	$link = new static;

        $link->user_id = $user->id;

        if($user->isTrusted()){
            $link->approve();
        }

        return $link; 
    }

    /**
    * Contribute the given community link.
    *
    * @param array $attributes
    * @return bool
    */
    public function contribute($attributes)
    {
    	return $this->fill($attributes)->save();
    }

    public function approve()
    {
        $this->approved = true;
        return $this;
    }

    /**
    * A community links has a creator
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
