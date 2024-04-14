<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\AddonCate;
use DB;
use Validator;
use Redirect;
use IMS;
class AddonCateController extends Controller {

	public $folder  = "store_end.addonCate.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new AddonCate;
		
		return View($this->folder.'index',[

		'data' => $res->getAll(),
		'link' => env('store').'/addonCate/',

		]);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new AddonCate,'form_url' => env('store').'/addonCate']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new AddonCate;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('store').'/addonCate')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => AddonCate::find($id),'form_url' => env('store').'/addonCate/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new AddonCate;
		
		$data->addNew($Request->all(),$id);
		
		return redirect(env('store').'/addonCate')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		AddonCate::where('id',$id)->delete();

		return redirect(env('store').'/addonCate')->with('message','Record Deleted Successfully.');
	}
}