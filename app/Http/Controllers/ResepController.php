<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use App\Models\Type;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('market.resep.index', [
            'title' => 'Resep Anda',
            'recipes' => Recipe::where('user_id', auth()->user()->id)->latest()->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('market.resep.create', [
            'title' => 'Buat Resep',
            'types' => Type::all(),
            'recipes' => Recipe::all(),
            'product' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $slug = SlugService::createSlug(Recipe::class, 'slug', $request->name);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'type_id' => 'required',
            'portion' => 'required',
            'cooking_time' => 'required',
            'image' => 'image|file|max:1024',
            'igredient' => 'required',
            'description' => 'required'
        ]);

        $validatedData['slug'] = $slug;
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->storePublicly('recipes-images', 'public');
        }
        $validatedData['user_id'] = auth()->user()->id;

        $recipe = Recipe::create($validatedData);
        $recipe->product()->attach($request->input('product_id'));

        return redirect('resep/recipes')->with('success', 'Postingan Berhail Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return view('market.resep.edit', [
            'title' => 'Buat Resep',
            'types' => Type::all(),
            'recipes' => $recipe,
            'product' => Product::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $slug = SlugService::createSlug(Recipe::class, 'slug', $request->name);
        $rules = [
            'name' => 'required|max:255',
            'type_id' => 'required',
            'portion' => 'required',
            'cooking_time' => 'required',
            'image' => 'image|file|max:1024',
            'igredient' => 'required',
            'description' => 'required'
        ];

        $rules['slug'] = $slug;
        if($recipe->slug != $slug){
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->storePublicly('recipes-images', 'public');
        }
        $validatedData['user_id'] = auth()->user()->id;

        $recipe = Recipe::where('id', $recipe->id)
        ->update($validatedData);
        $recipe->product()->attach($request->input('product_id'));

        return redirect('resep/recipes')->with('success', 'Postingan Berhail Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        if($recipe->image){
            Storage::delete($recipe->image);
        }
        Recipe::destroy($recipe->id);
        $d = new Product();
        $d->recipe()->detach($recipe->id);

        return redirect('resep/recipes')->with('success', 'Resep Berhail Dihapus');
    }
}
