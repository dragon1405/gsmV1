<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    //scope
	public function scopeName($query, $name)
	{
		if ($name) {
			 return $query->whereIn('user_id', $name);
		}
	}

	public function scopeProject($query, $project)
	{
		if ($project) {
			return $query->whereIn('title', $project);
		}
	}

	public function scopeBfecha($query, $date)
	{
		if ($date) {
			return $query->where('date', 'LIKE', "%$date%");
		}
	}



}
