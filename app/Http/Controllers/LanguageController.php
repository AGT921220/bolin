<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Language;
use App\User;
use DB;
use Validator;
use Redirect;
use IMS;
class LanguageController extends Controller {

	public $folder  = "language.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Language;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => 'language/','user' => User::find(1)]);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new Language,'form_url' => env('admin').'/language']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Language;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/language')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => Language::find($id),'form_url' => env('admin').'/language/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Language;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/language')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Language::where('id',$id)->delete();

		return redirect(env('admin').'/language')->with('message','Record Deleted Successfully.');
	}
}