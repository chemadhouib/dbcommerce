<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articles extends Model
{
   use HasFactory;
   protected $fillable = [
    'designation' , 'marque' , 'reference' , 'qtestock' , 'prix' , 'imageart' , 'scategorieID'
   ];

   public function scategories()
   {
    return $this->belongsTo(Scategories::class,"scategorieID");
   }
}
