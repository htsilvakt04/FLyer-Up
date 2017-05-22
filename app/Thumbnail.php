<?php

namespace App;
use Image;
class Thumbnail

{
  public function make($src, $destination_thumbnail, $destination_mini_thumbnail)
  {
    Image::make($src)
            ->fit(200)
            ->save($destination_thumbnail);
    Image::make($src)
            ->fit(30)
            ->save($destination_mini_thumbnail);
  }

}
