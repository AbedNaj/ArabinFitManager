<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
    ];
    public function permissionLists()
    {
        return $this->hasMany(PermissionList::class);
    }

    public function plan()
    {
        return $this->belongsToMany(Plan::class, 'plan_features');
    }
}
