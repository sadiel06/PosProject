<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sale_id',
        'date_created',
        'producto_id',
        'producto_price',
        'quantity',
    ];


    protected $casts = [
        'id' => 'integer',
        'sales_id' => 'integer',
        'date_created' => 'date',
        'producto_id' => 'integer',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


}
