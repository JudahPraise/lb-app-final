<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['registration_id','position_id','qualification','exam','schedule_id'];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
