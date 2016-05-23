<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\FlyerRequest;

use App\Flyer;


class FlyersController extends Controller
{
    public function create() 
    {
        flash()->overlay('Welcome Aboard', 'Thank you for signing up.');

        return view ('flyers.create');
    }
    
    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());
        
        flash()->success('Success!', 'Your flyer has been created.');
        
        return redirect()->back();
    }
}