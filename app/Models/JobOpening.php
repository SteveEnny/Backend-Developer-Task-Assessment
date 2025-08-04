<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    protected $fillable = ['user_id', 'title', 'company', 'company_logo', 'location', 'category', 'salary', 'description', 'benefits', 'type', 'work_condition'];

    public function admin() {
        return $this->belongsTo(User::class, 'user_id');
    }
}