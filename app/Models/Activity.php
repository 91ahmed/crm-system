<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $primaryKey = 'activity_id';
    public $timestamps = false;

    protected $guarded = [];

    public function activityStatus ()
    {
        return $this->belongsTo('\App\Models\ActivityStatus', 'activity_status');
    }

    public function activityTarget ()
    {
        return $this->belongsTo('\App\Models\ActivityTarget', 'activity_target');
    }

    public function activityType ()
    {
        return $this->belongsTo('\App\Models\ActivityType', 'activity_type');
    }

    public function lead ()
    {
        return $this->belongsTo('\App\Models\Lead', 'activity_lead');
    }

    public function user ()
    {
        return $this->belongsTo('\App\Models\User', 'activity_user');
    }
}
