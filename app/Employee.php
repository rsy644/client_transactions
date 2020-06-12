<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Employee extends Model
{
    protected $table = 'employees';
	protected $primaryKey = 'id';
	
	public $timestamps = false;

	public static function get_employees_list(){
		$query = DB::select('SELECT *
			FROM employees ORDER BY first_name ASC');

		return $query;
	}

	public static function get_employee_from_id($id){
		$query = db::select("SELECT *
			FROM employees
			WHERE id = ?",
			[$id]);

		return $query[0];
	}
}
