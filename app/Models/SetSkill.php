<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetSkill extends Model
{
    use HasFactory;

    protected $fillable = ['position_id','skill_id','points'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function skills()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
