<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['client_id', 'name', 'domain', 'token', 'status', 'data'];

    protected $casts = [
        'data' => 'array', // Convertit automatiquement le JSON en tableau PHP
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function formConfig()
{
    return $this->hasOne(FormConfig::class);
}
}
