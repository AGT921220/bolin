<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Cate;
use App\Language;
use App\AppUser;
use DB;
use Validator;
use Redirect;
use IMS;
class AppUserController extends Controller {

	public $folder  = "appUser.";
	
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new AppUser;
		
		return View($this->folder.'index',['data' => $res->getAll()]);
	}	

	public function updateWallet(Request $Request)
	{
		$res 			= AppUser::find($Request->get('id'));
		$res->wallet 	= $Request->get('wallet');
		$res->save();

		return Redirect::back()->with('message','Update Successfully.');
	}
}