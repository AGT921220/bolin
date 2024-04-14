<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Language;
use App\Text;
use DB;
use Validator;
use Redirect;
use IMS;
class TextController extends Controller {

	public $folder  = "text.";
	
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$lang = new Language;

		return View($this->folder.'index',[

			'data' 		=> new Text,
			'langs' 	=> $lang->getWithEng()

		]);
	}	

	public function save(Request $Request)
	{					
		$res = new Text;
		
		$res->addNew($Request->all());

		return Redirect::back()->with('message','Updated Successfully');
	}
}