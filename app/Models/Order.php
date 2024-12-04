<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Definir la tabla en la que se almacenarán los pedidos
    protected $table = 'orders';

    // Definir los campos que se pueden asignar de forma masiva (mass assignable)
    protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
        'image',
    ];

    // Si no usas convenciones de nombres en tus columnas (como 'created_at' y 'updated_at'), puedes deshabilitar los timestamps
    public $timestamps = true;

    // Si quieres que la fecha en la que se creó el pedido se guarde en un formato específico
    // Puedes definir el formato de la fecha
    protected $dateFormat = 'Y-m-d H:i:s';
}
