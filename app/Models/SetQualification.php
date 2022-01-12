<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetQualification extends Model
{
    use HasFactory;

    protected $casts = [        
        'qulification_options' => 'array'
    ];

    protected $fillable = [
        'position_id',
        'qualification_id',
        'qualification_options',
        'point',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function qualification()
    {
        return $this->belongsTo(AddQualifications::class, 'qualification_id');
    }
}
