<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\City;
use App\User;
use DB;
use Validator;
use Redirect;
use IMS;
class CityController extends Controller {

	public $folder  = "city.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new City;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => 'city/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new City,'form_url' => env('admin').'/city']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new City;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/city')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => City::find($id),'form_url' => env('admin').'/city/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new City;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/city')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		City::where('id',$id)->delete();

		return redirect(env('admin').'/city')->with('message','Record Deleted Successfully.');
	}
}