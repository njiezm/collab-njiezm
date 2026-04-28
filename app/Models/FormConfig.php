<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormConfig extends Model
{
    protected $fillable = ['project_id', 'fields'];

    protected $casts = [
    'fields' => 'array',
];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
