<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiagnosisResult extends Model
{
    use HasFactory;

    protected $fillable = ['selected_symptoms', 'result_json'];
}
