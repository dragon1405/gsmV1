<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	public $incrementing = false;
	protected $fillable = [
		'id', 'description', 'project_manager', 'address', 'cost',
	];
}
