<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillResult extends Model
{
    use HasFactory;

    protected $fillable = ['registration_id','skill_id','points','status'];
}
