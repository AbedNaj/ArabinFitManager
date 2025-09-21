<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionList extends Model
{
    /** @use HasFactory<\Database\Factories\PermissionListFactory> */
    use HasFactory;
    protected $fillable = [
        'feature_id',
        'name',
        'description',
        'sort',
    ];
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
