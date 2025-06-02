<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SymptomCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function symptoms()
    {
        return $this->hasMany(Symptom::class, 'kategori_id');
    }

}
