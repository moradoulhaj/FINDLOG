<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $fillable = [
        'nameHouse',
        'NomberRoom',
        'DistanceFac',
        'HouseGender',
        'photo',
        'adresse',
        'landlord_id',
    ];

    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id_house');
    }
}
