<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    use HasFactory;

	protected $table = 'replays';
	protected $primaryKey = 'replay_id';
	public $timestamps = false;
	
	protected $guarded = [];

    public function note ()
    {
        return $this->belongsTo('\App\Models\Note', 'replay_note_id');
    }

    public function user ()
    {
        return $this->belongsTo('\App\Models\User', 'replay_user_id');
    }

}
