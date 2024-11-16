<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomingRawMaterials extends Model
{
    use HasFactory;

    protected $table = 'incoming_raw_materials';

    protected $fillable = [
        'uuid',
        'material_id',
        'tanggal_pembelian',
        'unit',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class, 'material_id','id');
    }
}
