<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories :: all()-> toArray();
        return array_reverse( $categories);
    }

    public function store(Request $request) {
         $categorie = new Categories([
             'nomcategorie' => $request->input('nomcategorie'), 
             'imagecategorie' => $request->input('imagecategorie')
             ]); 
             $categorie->save();
              return response()->json('Catégorie créée !'); 
    }

    public function show($id) {
         $categorie = Categories::find($id); 
         return response()->json($categorie);
    }

    public function update(Request $request, $id) {
         $categorie = Categories::find($id);
          $categorie->update($request->all());
           return response()->json('Catégorie MAJ !'); 
    }

    public function destroy($id) {
         $categorie = Categories::find($id);
          $categorie->delete(); 
          return response()->json('Catégorie supprimée !');
    }
}
