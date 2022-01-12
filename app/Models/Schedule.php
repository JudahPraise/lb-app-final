<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['position_id','date','time_from','time_to','link'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function getDate() {

        if(!empty($this->date))
        {
            return Carbon::parse($this->date)->isoFormat('MMMM D, YYYY');
        }else
        {
            return 'null';
        }
    }

    public function getDay() {

        if(!empty($this->date))
        {
            return Carbon::parse($this->date)->isoFormat('dddd');
        }else
        {
            return 'null';
        }
    }


    public function getTimeFrom()
    {
        if(!empty($this->date))
        {
            return Carbon::parse($this->time_from)->isoFormat('h:mm a');;
        }else
        {
            return 'null';
        }
    }

    public function getTimeTo()
    {
        if(!empty($this->date))
        {
            return Carbon::parse($this->time_to)->isoFormat('h:mm a');;
        }else
        {
            return 'null';
        }
    }
}
