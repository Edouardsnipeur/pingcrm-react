<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Secteur;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\PhotoCollection;

class PhotoController extends Controller
{
    
    public function photoSecteurCategory($secteur_slug, $category_slug)
    {
        // return [$secteur_slug, $category_slug];
        try {
            $category = Category::where('slug', $category_slug)->firstOrFail();
            $secteur = Secteur::where('slug', $secteur_slug)->firstOrFail();
            
        } catch (Exception  $th) {
            return 'erreur' ;
        
        }
// return [$secteur, $category];
        return new PhotoCollection(
            Photo::where('secteur_id',  $secteur->id)->where('category_id', $category->id)->paginate() 
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
