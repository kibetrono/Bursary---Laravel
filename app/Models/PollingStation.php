<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingStation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sublocation_id'
    ];

    public function sublocation() {
        return $this->belongsTo(SubLocation::class);
    }
}
