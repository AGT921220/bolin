<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Item;
use App\Language;
use App\User;
use App\Category;
use App\Addon;
use App\ItemAddon;
use App\Inv;
use DB;
use Validator;
use Redirect;
use IMS;
class ItemController extends Controller {

	public $folder  = "store_end.item.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res 	= new Item;
		$addon 	= new Addon;

		return View($this->folder.'index',[

			'data'  	=> $res->getAll(),
			'link'  	=> env('store').'/item/',
			'addon' 	=> $addon->getAllAssign(),
			'assign' 	=> new ItemAddon,
			'hasItem' 	=> $this->hasItem(Auth::guard('store')->user()->id),
			'inv'		=> new Inv

		]);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		if(!$this->hasItem(Auth::guard('store')->user()->id)['item'])
		{
			return Redirect(env('store').'/item')->with('error','You dont have item upload limit. Please contact to admin');
			exit;
		}

		$cate = new Category;

		return View($this->folder.'add',[

		'data' 		=> new Item,
		'form_url' 	=> env('store').'/item',
		'cates'		=> $cate->getAll(0),
		'units'		=> explode(",", Auth::guard('store')->user()->unit)

		]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Item;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('store').'/item')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		$cate = new Category;

		return View($this->folder.'edit',[

		'data' 		=> Item::find($id),
		'form_url' 	=> env('store').'/item/'.$id,
		'cates'		=> $cate->getAll(0),
		'units'		=> explode(",", Auth::guard('store')->user()->unit)

		]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Item;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('store').'/item')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Item::where('id',$id)->delete();

		return redirect(env('store').'/item')->with('message','Record Deleted Successfully.');
	}

	public function itemStatus()
	{
		$res 			= Item::find($_GET['id']);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('store').'/item')->with('message','Status Updated  Successfully.');
	}

	public function addAddon(Request $Request)
	{
		$res = new ItemAddon;

		$res->addNew($Request->all());

		return redirect(env('store').'/item')->with('message','Addon Assigned Successfully.');
	}

	public function inv(Request $Request)
	{
		$res = new Inv;

		$res->addNew($Request->all());

		return redirect(env('store').'/item')->with('message','Stock Added Successfully.');
	}
}