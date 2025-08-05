<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class JobOpening extends Model
{
    protected $fillable = ['user_id', 'title', 'company', 'company_logo', 'location', 'category', 'salary', 'description', 'benefits', 'type', 'work_condition'];

    public function business() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobApplication(){
        return $this->hasMany(JobApplication::class);
    }

    public function scopeFilter(Builder|QueryBuilder $query, $keyword): Builder|QueryBuilder
    {
        return $query->when($keyword ?? null, function ($query, $keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')->orWhere('description', 'like', '%' . $keyword . '%');
        });
    }
}