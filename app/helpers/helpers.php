<?php
	
	/** 
	 *	Get notes replays
	 *
	 *	@param int $note_id
	 *	@return collection
	 */
	function getReplay ($note_id)
	{
		$replays = \App\Models\Replay::with('user', 'note')
									 ->orderBy('replay_id','ASC')
									 ->where('replay_note_id', '=', $note_id)
									 ->get();

		if (count($replays) == 0) {
			return null;
		}

		return $replays;
	}

	/** 
	 *	Get replays count.
	 *
	 *	@param int $note_id
	 *	@return int
	 */
	function getReplayCount ($note_id) 
	{
		$replayCount = \App\Models\Replay::where('replay_note_id', '=', $note_id)->count();

		return $replayCount;
	}

	/** 
	 *	Get notes count
	 *
	 *	@param int $lead_id
	 *	@return int
	 */
	function getNoteCount ($lead_id) 
	{
		$noteCount = \App\Models\Note::where('note_lead_id', '=', $lead_id)->count();

		return $noteCount;
	}

	function getMysqlDate ($dataTime)
	{
		$dataTime = explode(' ', $dataTime);
		return $dataTime[0];
	}

	function changeDateFromate ($date)
	{
		/*
		$postDate = $date;
		$date = str_replace('-', '', $date);
		$currentDate = date('Ymd');
		$diff = ($currentDate-$date);
		$output = null;

		if ($date == $currentDate) {
			$output = 'today';
		} elseif ($diff == 1) {
			$output = 'Yesterday';
		} elseif ($diff > 1 && $diff < 7) {
			$output = $diff.' day';
		} elseif ($diff == 7) {
			$output = 'week';
		} elseif ($diff > 7 && $diff < 14) {
			$output = $diff.' day';
		} elseif ($diff == 14) {
			$output = '2 weeks';
		} elseif ($diff > 14 && $diff < 21) {
			$output = $diff.' day';
		} elseif ($diff == 21) {
			$output = '3 weeks';
		} elseif ($diff > 21 && $diff < 28) {
			$output = $diff.' day';
		} elseif ($diff >= 28 && $diff < 31) {
			$output = 'month';
		} else {
			$output = $postDate;
		}

		return ucwords($output);
		*/

		return $date;
	}

	function isCurrentRoutes ($route) 
	{
		if (\Route::getCurrentRoute()->uri() == $route) 
		{
			return true;
		}
	}

	function totalPrice ($q, $p)
	{
		$total = ($q*$p);

		return $total;
	}
?>