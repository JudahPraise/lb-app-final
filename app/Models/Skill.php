<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['tag','skill_title','description','total_points'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function setSkill()
    {
        return $this->hasMany(SetSkill::class, 'skill_id');
    }

    public function skillScore()
    {
        return $this->hasOne(SkillResult::class, 'skill_id');
    }
}
