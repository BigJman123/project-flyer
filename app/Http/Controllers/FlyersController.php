<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Uploadedfile;

use App\Http\Requests\FlyerRequest;

use App\Flyer;

use App\Photo;


class FlyersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function create() 
    {
        // flash()->overlay('Welcome Aboard', 'Thank you for signing up.');

        return view ('flyers.create');
    }
    
    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());
        
        flash()->success('Success!', 'Your flyer has been created.');
        
        return redirect()->back();
    }

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
                'photo' => 'required|mimes:jpg,jpeg,png,bmp'
            ]);

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

    }

    public function makePhoto(Uploadedfile $file)
    {
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }
}