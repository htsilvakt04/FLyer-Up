<?php

namespace App\Http\Controllers;
use App\Flyer;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Middleware\CanEditFlyer;




class FlyersController extends Controller
{
    protected $user;
    public function __construct()
    {
      $this->middleware('auth', ['except' => ['show', 'index']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flyers = Flyer::oldest()->orderBy('state')->paginate(10);
        return view('pages.home', compact('flyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("flyers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        $user = $request->user();

        $flyer = $user->addFlyer(
          new Flyer($request->all())
        );

        flash()->success("Ya ha!", "Your flyer created succesfully");

        return redirect(flyer_path($flyer));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        return view("flyers.show", compact("flyer"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flyer = Flyer::with('photos')->find($id);

        if (! request()->user()->owns($flyer)) {
            flash()->success("Ya ha!", "You can't do that bro..");
            return redirect("/");
        }

        return view('flyers.edit', compact('flyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FlyerRequest $request, $id)
    {
        $user = $request->user();
        $flyer = Flyer::find($id);

        if (! $user->owns($flyer)) {
            flash()->success("Ya ha!", "You can't do that bro..");
            return back();
        }
        
        $input = $this->determineUpdatedField($request, $flyer);

        if ($flyer->update($input)) {

            flash()->success("Ya ha!", "Your flyer updated succesfully");
            return redirect("/home");
        }
        return false;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = request()->user();
        $flyer = Flyer::findOrFail($id);

        if ($user->owns($flyer)) {
            Flyer::where('id', $id)->delete();
            flash()->info("Yes", "Your flyer was deleted successfully");
            return back();
        }
        
        flash()->info("Ya ha!", "You Do not have the permission to do that bro..");
        return back();
    }

    public function determineUpdatedField($request, $flyer)
    {
        $flyer_array = $flyer->toArray();

        $changes = array_diff($request->all(), $flyer_array);

        return $input = array_intersect_key($changes, $flyer_array);
    }
}
