<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'saldo',
        'moneda',
    ];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}