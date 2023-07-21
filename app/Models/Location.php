<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ward_id'
    ];

    public function ward(){
        return $this->belongsTo(Ward::class);
    }
    public function sublocations(){
        return $this->hasMany(SubLocation::class);
    }
}
