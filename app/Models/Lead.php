<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';
    protected $primaryKey = 'lead_id';
    public $timestamps = false;

    protected $guarded = [];

    public function user ()
	{
		return $this->belongsTo('\App\Models\User', 'lead_assigned_to');
	}

    public function status ()
	{
		return $this->belongsTo('\App\Models\Status', 'lead_status');
	}

    public function country ()
    {
        return $this->belongsTo('\App\Models\Country', 'lead_country');
    }

    public function company ()
    {
        return $this->belongsTo('\App\Models\Company', 'lead_company');
    }

    public function gender ()
    {
        return $this->belongsTo('\App\Models\Gender', 'lead_gender');
    }

    public function source ()
    {
    	return $this->belongsTo('\App\Models\Source', 'lead_source');
    }
}
