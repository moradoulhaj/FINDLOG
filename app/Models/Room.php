<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['Longueur', 'largeur', 'Photo', 'status', 'price', 'id_house'];
    
    public function house()
    {
        return $this->belongsTo(House::class, 'id_house');
    }
}
