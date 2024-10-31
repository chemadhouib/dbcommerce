<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ScategoriesController;

Route::middleware('api') -> group(function (){
    Route::resources([
        'categories' => CategoriesController::class,
    ]);
    
    Route::get('/scat/{idcat}', 
    [ScategoriesController::class,'showSCategorieByCAT']);

    Route::middleware('api')->group(function () {
         Route::resources(['articles'=> ArticlesController::class]); 
        });

    Route::get('/articles/art/pagination',
       [ArticlesController::class, 'showArticlesPagination']);

    Route::get('/articles/art/paginationPaginate',
         [ArticlesController::class, 'paginationPaginate']);
});
