<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Un extends Model
{
    use HasFactory;

    protected $table = 'un';

    protected $fillable = [
        'unit',
        'business_unit',
        'business_type',
    ];
    
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'un_id');
    }
}
