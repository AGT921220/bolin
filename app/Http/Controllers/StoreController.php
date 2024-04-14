<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Language;
use App\User;
use App\Cate;
use App\Store;
use App\City;
use App\StoreCate;
use App\StoreImage;
use App\Plan;
use App\StorePlan;
use App\StoreMenu;
use DB;
use Validator;
use Redirect;
use QrCode;
class StoreController extends Controller {

	public $folder  = "store.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res 	= new Store;
		$plan   = new Plan;

		return View($this->folder.'index',[

			'data'  	=> $res->getAll(),
			'link'  	=> 'store/',
			'plan'		=> $plan->getAll(0),
			'storePlan' => new StorePlan

		]);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		$cate = new Cate;
		$city = new City;
		$plan = new Plan;

		return View($this->folder.'add',[

		'data' 		=> new Store,
		'form_url' 	=> env('admin').'/store',
		'cates'		=> $cate->getAll(0),
		'city'		=> $city->getAll(0),
		'array'		=> [],
		'images'	=> [],
		'admin'		=> true,
		'menu'		=> []
		

		]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Store;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/store')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		$cate = new Cate;
		$city = new City;
		$plan = new Plan;

		return View($this->folder.'edit',[

		'data' 		=> Store::find($id),
		'form_url' 	=> env('admin').'/store/'.$id,
		'cates'		=> $cate->getAll(0),
		'city'		=> $city->getAll(0),
		'array'		=> StoreCate::where('store_id',$id)->pluck('cate_id')->toArray(),
		'images'	=> StoreImage::where('store_id',$id)->get(),
		'admin'		=> true,
		'menu'		=> StoreMenu::where('store_id',$id)->get()

		]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Store;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/store')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Store::where('id',$id)->delete();
		StoreImage::where('store_id',$id)->delete();
		StorePlan::where('store_id',$id)->delete();

		return redirect(env('admin').'/store')->with('message','Record Deleted Successfully.');
	}

	public function removeImage()
	{
		if(isset($_GET['type']))
		{
			$res 			= StoreMenu::find($_GET['id']);
		
			unlink("upload/store/menu/".$res->file);
		}
		else
		{
			$res 			= StoreImage::find($_GET['id']);
		
			unlink("upload/store/gallery/".$res->img);
		}

		$res->delete();

		return redirect::back()->with('message','Image Removed Successfully.');
	}

	public function storeAction()
	{
		$res 		= Store::find($_GET['id']);
		
		if($_GET['action'] == "status")
		{
			$res->status  = $res->status == 0 ? 1 : 0;
		}
		elseif($_GET['action'] == "open")
		{
			$res->open  = $res->open == 0 ? 1 : 0;
		}
		elseif($_GET['action'] == "trend")
		{
			$res->trend  = $res->trend == 0 ? 1 : 0;
		}

		$res->save();

		return redirect::back()->with('message','Updated Successfully.');
	}

	public function loginAsStore()
	{
		if(Auth::guard('store')->loginUsingId($_GET['id']))
		{
		   return Redirect::to(env('store').'/home')->with('message', 'Welcome ! Your are logged in now.');	
		}
		else
		{
			return Redirect::back()->with('error', 'Something went wrong.');
		}
		
	}

	public function qr()
	{
		return QrCode::size(200)->generate($this->setting()->web_app."/item/".$_GET['id']."/0");
	}

	public function storePlan(Request $Request)
	{
		$res = new StorePlan;

		$res->addNew($Request->get('plan_id'),$Request->get('id'));

		return Redirect::back()->with('message', 'Plan Assigned Successfully.');
	}

	public function pay()
	{
		$res = new StorePlan;
		$res->pay();

		return Redirect::back()->with('message', 'Plan Status Successfully.');
	}
}