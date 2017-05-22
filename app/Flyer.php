<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;

class Flyer extends Model
{
  protected $table = "flyers";
  protected $fillable = [
    "street",
    "city",
    "state",
    "country",
    "zip",
    "price",
    "description"
  ];
  public function owner()
  {
    return $this->belongsTo(User::class, "user_id");
  }
  public function ownedBy(User $user)
  {
    return $this->user_id == $user->id;
  }
  public function photos()
  {
    return $this->hasMany(Photo::class);
  }

  public function getPriceAttribute($price)
  {
    return "$". number_format($price, 2);
  }

  public static function locatedAt($zip, $street)
  {
    $street = str_replace("-", " ",$street);
    return static::where(compact("zip", "street"))->firstOrFail();
  }
  public function addphoto(Photo $photo)
  {
    return $this->photos()->save($photo);
  }

  public function displaySomePhotoInMainView($number_item)
  { 
    $photos = $this->photos->toArray();

    $number = count($photos);

    switch ($number) {
      case 0:
        return [];
      case 1:
        return array_slice($photos,0,1);
      case 2:
        return array_slice($photos,0,2);
      default:
        return array_slice($photos,0,$number_item);
    }
  }
    public static function byUser(User $user)
    {
      return $user->flyers()->with('photos')->get();
    }





}
