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
    public function flyers()
    {
      return $this->hasMany(Flyer::class);
    }
    // check if the user owns some particular flyers
    public function owns($relation)
    {
        if(empty($relation)) {
            return false;
        }
      return $this->id == $relation->user_id;
    }
    public function addFlyer(Flyer $flyer)
    {
      return $this->flyers()->save($flyer);
    }

}
