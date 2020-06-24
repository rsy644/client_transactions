<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\Transaction;

class Client extends Model
{
    protected $table = 'clients';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	public function transaction(){
		return $this->hasMany('App\Transaction');
	}
}
