<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Client extends Model
{
    protected $table = 'clients';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	public static function get_clients_list(){
		$query = db::select("SELECT * FROM clients");

		return $query;
	}

	public static function get_client_from_id($id){
		$query = db::select("SELECT *
			FROM clients
			WHERE id = ?",
			[$id]);

		return $query[0];
	}
}
