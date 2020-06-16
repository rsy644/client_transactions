<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Transaction extends Model
{
    protected $table = 'transactions';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	public static function get_transactions_list(){
		$query = DB::select('SELECT *
			FROM transactions ORDER BY first_name ASC');

		return $query;
	}

	public static function get_transaction_from_id($id){
		$query = db::select("SELECT *
			FROM transactions
			WHERE id = ?",
			[$id]);

		return $query[0];
	}
}
