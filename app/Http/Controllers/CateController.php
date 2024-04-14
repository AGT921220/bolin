<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Cate;
use App\Language;
use App\User;
use DB;
use Validator;
use Redirect;
use IMS;
class CateController extends Controller {

	public $folder  = "cate.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Cate;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => 'cate/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new Cate,'form_url' => env('admin').'/cate']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Cate;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/cate')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => Cate::find($id),'form_url' => env('admin').'/cate/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Cate;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/cate')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Cate::where('id',$id)->delete();

		return redirect(env('admin').'/cate')->with('message','Record Deleted Successfully.');
	}
}