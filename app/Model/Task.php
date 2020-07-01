<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
    protected $fillable = ['name', 'project_id'];

    use SoftDeletes;

    /**
     * Link To Project
     */
    function project(){
        return $this->belongsTo(Project::class);
    }
}
