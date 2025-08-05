<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    protected $fillable = ['job_id','first_name','last_name','email','phone','location','cv'];

    public function jobOpening(){
        return $this->belongsTo(JobOpening::class);
    }
}