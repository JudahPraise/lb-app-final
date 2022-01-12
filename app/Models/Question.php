<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['skill_id','question'];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
