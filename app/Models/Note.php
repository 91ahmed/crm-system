<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

	protected $table = 'notes';
	protected $primaryKey = 'note_id';
	public $timestamps = false;
	
	protected $guarded = [];

    public function user ()
    {
        return $this->belongsTo('\App\Models\User', 'note_user_id');
    }

    public function lead ()
    {
        return $this->belongsTo('\App\Models\Lead', 'note_lead_id');
    }
}
