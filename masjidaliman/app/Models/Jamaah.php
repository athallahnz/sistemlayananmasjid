<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;
    public function Infaq()
    {
    return $this->belongsTo(Infaq::class);
    }
}
