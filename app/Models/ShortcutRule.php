<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortcutRule extends Model
{
    protected $fillable = ['disease_code', 'symptom_codes'];

    protected $casts = [
        'symptom_codes' => 'array',
    ];

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_code', 'code');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }

}

