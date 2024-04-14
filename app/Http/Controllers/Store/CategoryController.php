<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Language;
use App\User;
use DB;
use Validator;
use Redirect;
use IMS;
class CategoryController extends Controller {

	public $folder  = "store_end.category.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Category;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => env('store').'/category/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new Category,'form_url' => env('store').'/category']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Category;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('store').'/category')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => Category::find($id),'form_url' => env('store').'/category/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Category;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('store').'/category')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Category::where('id',$id)->delete();

		return redirect(env('store').'/category')->with('message','Record Deleted Successfully.');
	}
}