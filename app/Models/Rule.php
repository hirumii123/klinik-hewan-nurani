<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = ['symptom_id', 'disease_id', 'cf_value'];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
