<?php

namespace App\Http\Controllers;

use App\Models\articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = articles::with('scategories')->get()->toArray();
         $res = array_reverse($articles); 
         return response()->json($res);
    }

    public function store(Request $request)
    {
        $articles = new articles();
        $articles -> designation =  $request-> input('designation');
        $articles -> marque =  $request-> input('marque');
        $articles -> reference =  $request-> input('reference');
        $articles -> qtestock =  $request-> input('qtestock');
        $articles -> prix =  $request-> input('prix');
        $articles -> imageart =  $request-> input('imageart');
        $articles -> scategorieID =  $request-> input('scategorieID');

        $articles -> save();

        return response() -> json($articles); 
    }

    public function show($id)
    {
         $article= articles::find($id);
          return response()->json($article);
    }

    public function update($id, Request $request) 
    { 
        $article = articles::find($id);
         $article->update($request->all());
          return response()->json($article);
    }

    public function destroy($id) 
    {
         $article = articles::find($id);
          $article->delete(); 
          return response()->json(['message' => 'Article deleted successfully']);
    }

    public function showArticlesPagination(Request $request) 
    { 
        // Récupérer les paramètres de requête 
        $filtre = $request->input('filtre', ''); 
        $page = $request->input('page', 1); 
        $pageSize = $request->input('pageSize', 10);

        // Requête Eloquent avec filtre sur la désignation et pagination
        $query = articles::where('designation', 'like', '%' . $filtre . '%')
         ->with('scategories') // une relation définie avec scategories
        ->orderBy('id', 'desc'); // Tri descendant par ID

        // Pagination 
        $totalArticles = $query->count();
         $articles = $query->skip(($page - 1) * $pageSize)
                           ->take($pageSize)
                           ->get();

        // Calculer le nombre total de pages 
        $totalPages = ceil($totalArticles / $pageSize);

        // Retourner la réponse en JSON 
        return response()->json([ 
            'products' => $articles,
             'totalPages' => $totalPages, 
            ]);

        
    }   

    // Méthode de Pagination avec paginate 
    public function paginationPaginate() {
        // Récupère la valeur dynamique pour la pagination
         $perPage = request()->input('pageSize', 2);
         // Récupère le filtre par désignation depuis la requête
          $filterDesignation = request()->input('filtre');
          // Construction de la requête
           $query = articles::with('scategories');
           // Applique le filtre sur la désignation s'il est fourni 
           if ($filterDesignation) {
             $query->where('designation', 'like', '%' . $filterDesignation . '%'); 
            }

          // Paginer les résultats après avoir appliqué le filtre 
          $articles = $query->paginate($perPage);
           
          // Retourne le résultat en format JSON API 
           return response()->json([ 'products' => $articles->items(), // Les articles paginés 
           'totalPages' => $articles->lastPage(), // Le nombre de pages
]); }
}