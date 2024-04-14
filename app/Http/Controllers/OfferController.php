<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Offer;
use App\Store;
use App\StoreOffer;
use DB;
use Validator;
use Redirect;
use IMS;
class OfferController extends Controller {

	public $folder  = "offer.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Offer;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => 'offer/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		$store = new Store;
		
		return View($this->folder.'add',[

		'data' 	 	=> new Offer,
		'form_url'  => env('admin').'/offer',
		'store'		=> $store->getAll(),
		'array'		=> []

		]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data  = new Offer;	

		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/offer')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		$store = new Store;

		return View($this->folder.'edit',[

		'data' 		=> Offer::find($id),
		'form_url' 	=> env('admin').'/offer/'.$id,
		'store'		=> $store->getAll(),
		'array'		=> StoreOffer::where('offer_id',$id)->pluck('store_id')->toArray()

		]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Offer;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/offer')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Offer::where('id',$id)->delete();

		return redirect(env('admin').'/offer')->with('message','Record Deleted Successfully.');
	}
}