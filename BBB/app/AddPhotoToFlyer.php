<?php
namespace App;
use Illuminate\Http\UploadedFile;

class AddPhotoToFlyer
{
  protected $flyer;
  protected $file;
  public function __construct(Flyer $flyer, UploadedFile  $file, Thumbnail $thumbnail = null)
  {
    $this->flyer = $flyer;
    $this->file = $file;
    $this->thumbnail = $thumbnail ?: new Thumbnail;
  }

  public function save()
  {
    //attach photo to flyer
    $photo = $this->flyer->addPhoto($this->makePhoto());
    //move photo to proper path
    $this->file->move($photo->baseDir(), $photo->name);
    // make thumbnail
    $this->thumbnail->make($photo->path, $photo->thumbnail_path, $photo->mini_thumbnail_path);
  }


  public function makePhoto()
  {
     $photo = new Photo;
     $photo->name = $this->makeFileName();
     return $photo;
  }


  public function makeFileName()
  {
    $name = sha1(
      time().$this->file->getClientOriginalName()
    );
    $extension = $this->file->getClientOriginalExtension();
    return "{$name}.{$extension}";
  }


}
