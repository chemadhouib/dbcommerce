<?php

namespace App\Http\Controllers;

use App\Models\Scategories;
use Illuminate\Http\Request;

class ScategoriesController extends Controller
{
    public function index() { 
        $scategories = Scategories::with('categories')->get()->toArray();
         return array_reverse($scategories); 
    }

    public function store(Request $request) { 
        $scategorie = new Scategories([ 
            'nomscategorie' => $request->input('nomscategorie'), 
            'imagescategorie' => $request->input('imagescategorie'),
            'categorieID' => $request->input('categorieID'), ]); 
            $scategorie->save(); 
            return response()->json('S/Categorie créée !');
    }

    public function show($id) { 
        $scategorie = Scategories::find($id); 
        return response()->json($scategorie);
    }

    public function update(Request $request, $id) { 
        $scategorie = Scategories::find($id);
         $scategorie->update($request->all()); 
         return response()->json('S/Catégorie MAJ !'); 
    }

    public function destroy($id) { 
        $scategorie = Scategories::find($id);
         $scategorie->delete();
          return response()->json('Scategorie supprimée !'); 
    }

    public function showSCategorieByCAT($idcat) { 
        $Scategorie= Scategories::where('categorieID', $idcat)->with('categories')->get()->toArray();
         return response()->json($Scategorie); 
    }
}
