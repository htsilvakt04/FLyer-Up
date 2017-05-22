<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "flyer_photos";
    protected $fillable = ["name", "path", "thumbnail_path","mini_thumbnail_path"];

    public function setNameAttribute($value)
    {
      $this->attributes['name'] = $value;
      $this->path = $this->baseDir() ."/". $value;
      $this->thumbnail_path =  $this->baseDir()."/tn-".$value;
      $this->mini_thumbnail_path =  $this->baseDir()."/mini-tn-".$value;
    }


    public function flyer()
    {
      return $this->belongsTo(Flyer::class);
    }

    public function baseDir()
    {
      return "images/photos";
    }

    public function delete()
    {
      \File::delete([
        $this->path,
        $this->thumnail_path,
        $this->mini_thumbnail_path,
      ]);
      parent::delete();
    }

    
}
