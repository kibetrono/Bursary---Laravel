<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'county_number'
    ];

    public function constituencies()
    {
        return $this->hasMany(Constituency::class);
    }
    
}
