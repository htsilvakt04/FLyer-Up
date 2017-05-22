<?php

namespace App\Http\Controllers\Traits;
use App\Flyer;
use Illuminate\Http\Request;

trait AuthorizesUsers {

  public function userCreatedFlyer(Request $request)
  {
    return Flyer::where([
      "zip" => $request->zip,
      "street" => $request->street,
      "user_id" => \Auth::user()->id,
    ])->exists();
  }

  public function unauthorize(Request $request)
  {
    if ($request->ajax()) {
      return response(["message" => "No way!"], 403);
    }
    flash("No way!");
    redirect("/");
  }

}
