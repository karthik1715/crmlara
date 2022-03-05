<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $guarded = [];
    
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
