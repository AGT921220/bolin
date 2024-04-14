<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Slider;
use App\Language;
use App\User;
use DB;
use Validator;
use Redirect;
use IMS;
class SliderController extends Controller {

	public $folder  = "slider.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Slider;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => 'slider/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new Slider,'form_url' => env('admin').'/slider']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Slider;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/slider')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => Slider::find($id),'form_url' => env('admin').'/slider/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Slider;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/slider')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		$res = Slider::find($id);

		unlink("upload/slider/".$res->img);

		$res->delete();

		return redirect(env('admin').'/slider')->with('message','Record Deleted Successfully.');
	}

	public function status($id)
	{
		$res 			= Slider::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('admin').'/slider')->with('message','Record Deleted Successfully.');
	}
}