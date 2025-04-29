<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'solution'];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }
}
