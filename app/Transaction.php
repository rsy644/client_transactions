<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\Client;

class Transaction extends Model
{
    protected $table = 'transactions';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	/* sets up many to one relationship */

	public function client(){
		return $this->belongsTo('App\Client');
	}
}
