<?php

namespace App\Http\Controllers;

use App\Models\Secteur;
use App\Http\Resources\SecteurCollection;
use App\Http\Requests\SecteurStoreRequest;
// use App\Http\Resources\OrganizationResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class SecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Secteurs/Index', [
            'filters' => Request::all('search', 'trashed'),
            'secteurs' => new SecteurCollection(
                Secteur::paginate()
                    ->appends(Request::all()) 
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Secteurs/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecteurStoreRequest $request)
    {
        $data = $request->validated();
        $secteur = new Secteur();
        $secteur->name = $data['s_name'];
        $secteur->slug = Str::of($data['s_name'])->slug('-');
        $secteur->save();
        return Redirect::route('secteurs')->with('success', 'secteur created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function show(Secteur $secteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Secteur $secteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secteur $secteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secteur $secteur)
    {
        $secteur->delete();
        return Redirect::back()->with('success', 'secteur deleted.');
    }
}
