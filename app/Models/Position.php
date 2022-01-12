<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['position','department','description'];

    public function qualifications()
    {
        return $this->hasMany(SetQualification::class);
    }

    public function skills()
    {
        return $this->hasMany(SetSkill::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
