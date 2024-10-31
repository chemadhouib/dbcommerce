<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Scategories extends Model
{
    use HasFactory;
    protected $fillable = [
     'nomscategorie','imagescategorie','categorieID' 
    ];

     public function categories() { 
        return $this->belongsTo(Categories::class,"categorieID"); 
    }

    public function article() { 
        return $this->hasMany(articles::class,"scategorieID"); }
}
