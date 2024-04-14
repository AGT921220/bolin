<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Delivery;
use DB;
use Validator;
use Redirect;
use IMS;
class DeliveryController extends Controller {

	public $folder  = "store_end.delivery.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Delivery;
		
		return View($this->folder.'index',['data' => $res->getAll(Auth::guard('store')->user()->id),'link' => env('store').'/delivery/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',[

			'data' 		=> new Delivery,
			'form_url' 	=> env('store').'/delivery',

		]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Delivery;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('store').'/delivery')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
	
		return View($this->folder.'edit',[

		'data' 		=> Delivery::find($id),
		'form_url' 	=> env('store').'/delivery/'.$id,


		]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Delivery;
		
		$data->addNew($Request->all(),$id);
		
		return redirect(env('store').'/delivery')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Delivery::where('id',$id)->delete();

		return redirect(env('store').'/delivery')->with('message','Record Deleted Successfully.');
	}
}