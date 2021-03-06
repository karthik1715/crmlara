<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $guarded = [];

    protected $with = [
        'organization'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function segments()
    {
        return $this->belongsToMany(Segment::class);
    }
    
}
