<?php

namespace App\Http\Controllers;
use App\Photo;
use App\Flyer;
use App\AddPhotoToFlyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPhotoRequest;

class PhotosController extends Controller
{
  public function __construct()
  {
  }
  
  public function store($zip, $street, AddPhotoRequest $request)
  {
    
    $flyer = Flyer::locatedAt($zip, $street);
    $file = $request->file("photo");

    (new AddPhotoToFlyer($flyer, $file))->save();
  }


  public function destroy($id)
  {
    Photo::findOrFail($id)->delete();
    return back();
  }


}
