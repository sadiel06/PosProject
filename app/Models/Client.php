<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'entity_id',
        'name',
        'apellido',
        'cedula',
    ];


    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
    ];

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
