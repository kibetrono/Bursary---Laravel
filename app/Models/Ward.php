<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'constituency_id'
    ];

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
