<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $guarded = [];
    
    protected $casts = [
        'schedule_datetime' => 'date:hh:mm'
    ];

    public function category() {
        return $this->belongsTo(Category::class,);
    }

    public function segment() {
        return $this->belongsTo(Segment::class,);
    }

    public function campaignDetail() {
        return $this->hasOne(CampaignDetail::class);
    }
}
