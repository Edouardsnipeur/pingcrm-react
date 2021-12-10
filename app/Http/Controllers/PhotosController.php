<?php

namespace App\Http\Controllers;

// use App\Http\Requests\OrganizationStoreRequest;
// use App\Http\Requests\OrganizationUpdateRequest;
use App\Http\Resources\PhotoCollection;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\SecteurCollection;
// use App\Http\Resources\OrganizationResource;
use Inertia\Inertia;
use App\Models\Photo;
use App\Models\Category;
use App\Models\Secteur;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\PhotoStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Photo/Index', [
            'filters' => Request::all('search', 'trashed'),
            'photos' => new PhotoCollection(
                Photo::paginate()
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
        return Inertia::render('Photo/Create', [
            'categories' => new CategoryCollection(
                Category::orderBy('name')
                    ->get()
            ),
            'secteurs' => new SecteurCollection(
                Secteur::orderBy('name')
                    ->get()
            )
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoStoreRequest $request)
    {
        $data = $request->validated();
        $photos = $data['photos'];
        $category = Category::findOrFail($data['category_id']);
        $secteur = Secteur::findOrFail($data['secteur_id']);
        // dd($category->name);
        foreach ($photos as $key => $ph) {
            $filename = $this->getFileName($ph, $category);
            $ph->move(public_path().'/images/'.$secteur->slug.'/'.$category->slug.'/', $filename); 
            $url ='images/'.$secteur->slug.'/'.$category->slug.'/'.$filename;
            $photo = new Photo();
            $photo->name = $this->getOriginalName($ph);
            $photo->category_id = $category->id;
            $photo->secteur_id = $secteur->id;
            $photo->url = $url;
            $photo->save();
        }
        return Redirect::route('photos')->with('success', 'Photos ajoutées.');
    }
    private function getOriginalName($ph)
    {
        $originalName = str_replace(".".$ph->getClientOriginalExtension(),"",$ph->getClientOriginalName());
        return $originalName;
    }
    private function getFileName($ph, $category)
    {
        $originalName = $this->getOriginalName($ph);
        $photoName = "$category->name ".md5(uniqid(rand(), true));
        return Str::of($originalName.' '.$photoName)->slug('-').".".$ph->getClientOriginalExtension();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return Redirect::back()->with('success', 'Photo deleted.');
    }
}
