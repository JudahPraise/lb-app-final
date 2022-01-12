<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','middlename','dob','gender','contact_no','email_address', 'position_id'];

    public function getFullname()
    {
        return $this->lastname.','.$this->firstname.','.$this->middlename;
    }

    public function getPosition()
    {

        $position = Position::where('id','=',$this->position_id)->select('position')->first();

        return $position->position;
    }
    
}
