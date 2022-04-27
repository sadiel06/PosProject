<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id',
        'province_id',
        'municipality_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'region_id' => 'integer',
        'municipality_id' => 'integer',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
