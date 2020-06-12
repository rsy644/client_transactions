<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Company extends Model
{
    protected $table = 'companies';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	public static function get_companies_list(){
		$query = db::select("SELECT * FROM companies");

		return $query;
	}

	public static function get_company_from_id($id){
		$query = db::select("SELECT *
			FROM companies
			WHERE id = ?",
			[$id]);

		return $query[0];
	}
}
