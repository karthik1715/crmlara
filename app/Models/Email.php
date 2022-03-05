<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Email extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $guarded = [];

    public function segments()
    {
        return $this->belongsTo(Segment::class);
    }
    
}
