<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\AppUser;
use DB;
use Validator;
use Redirect;
use IMS;
class UserController extends Controller {

	public $folder  = "user.";
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

	public function edit($id)
	{
		return View($this->folder.'edit',['data' => AppUser::find($id)]);
	}	

	public function _edit($id,Request $Request)
	{
		$res 				= AppUser::find($id);
		$res->name 			= $Request->get('name');
		$res->email 		= $Request->get('email');
		$res->phone 		= $Request->get('phone');
		$res->whatsapp_no 	= $Request->get('whatsapp_no');

		if($Request->get('password'))
		{
			$res->password = $Request->get('password');
		}

		$res->save();

		return Redirect('user')->with('message','Updated Successfully');
	}

	public function delete($id)
	{
		AppUser::where('id',$id)->delete();

		return Redirect('user')->with('message','Deleted Successfully');
	}
}