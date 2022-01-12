<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillTestForm extends Model
{
    use HasFactory;

    protected $fillable = ['registration_id','skill_id','choice_id','points'];
}
