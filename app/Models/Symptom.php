<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Symptom extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'kategori_id', 'image', 'image_source'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function kategori()
    {
        return $this->belongsTo(SymptomCategory::class, 'kategori_id');
    }

}

