<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    
    protected $fillable = ['nome'];
    
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
    
    public function cidade()
    {
        return $this->hasOne(Cidade::class);
    }
}
