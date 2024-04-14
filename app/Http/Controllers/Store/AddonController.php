<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Addon;
use App\AddonCate;
use DB;
use Validator;
use Redirect;
use IMS;
class AddonController extends Controller {

	public $folder  = "store_end.addon.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Addon;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => env('store').'/addon/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		$cate = new AddonCate;

		return View($this->folder.'add',[

			'data' 		=> new Addon,
			'form_url' 	=> env('store').'/addon',
			'cates'		=> $cate->getAll()

		]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Addon;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('store').'/addon')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		$cate = new AddonCate;
		
		return View($this->folder.'edit',[

		'data' 		=> Addon::find($id),
		'form_url' 	=> env('store').'/addon/'.$id,
		'cates'		=> $cate->getAll()


		]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Addon;
		
		$data->addNew($Request->all(),$id);
		
		return redirect(env('store').'/addon')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Addon::where('id',$id)->delete();

		return redirect(env('store').'/addon')->with('message','Record Deleted Successfully.');
	}
}