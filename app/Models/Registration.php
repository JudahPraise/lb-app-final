<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','middlename','dob','gender','contact_no','email_address', 'position_id', 'resume', 'resume_permission','interview_status'];

    public function getFullname()
    {
        return $this->firstname.' '.$this->middlename.' '.$this->lastname;
    }

    public function getPosition()
    {
        $position = Position::where('id','=',$this->position_id)->select('position')->first();

        return $position->position;
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }
    
}
