<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use App\Models\Type;
use Illuminate\Http\Request;

class IdeMenuController extends Controller
{
    public function index(){
        return view('market.ide_menu',[
            'title' => 'Ide Menu',
            'recipes' => Recipe::latest()->get(),
            'types' =>Type::all()
        ]);
    }
    public function detail(Recipe $recipe){
        return view('market.detail_menu',[
            'title' => 'Ide Menu',
            'recipe' => $recipe
        ]);
    }
    public function show(){
        $title = '';
        if(request('type')){
            $type = Type::firstWhere('slug', request('type'));
            $title = $type->name;
        }
        if(request('user')){
            $user = User::firstWhere('username', request('user'));
            $title = ' dari '.$user->name;
        }
        return view('market.search_menu', [
            'title' => 'Resep '. $title,
            'recipes' => Recipe::latest()->filter(request(['search', 'type', 'user']))->get()
        ]);
    }
}
