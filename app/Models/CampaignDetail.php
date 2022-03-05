<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignDetail extends Model implements Auditable
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $guarded = [];
    
    public $table = 'campaign_details';

    public function campaigns()
    {
        return $this->belongsTo(Campaign::class);
    }

}
