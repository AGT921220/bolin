<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Plan;
use App\Language;
use App\User;
use App\StorePlan;
use App\Store;
use DB;
use Validator;
use Redirect;
use IMS;
class PlanController extends Controller {

	public $folder  = "plan.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$res = new Plan;
		
		return View($this->folder.'index',['data' => $res->getAll(),'link' => 'plan/']);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{								
		return View($this->folder.'add',['data' => new Plan,'form_url' => env('admin').'/plan']);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		$data = new Plan;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect(env('admin').'/plan')->with('message','New Record Added Successfully.');
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',['data' => Plan::find($id),'form_url' => env('admin').'/plan/'.$id]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		$data = new Plan;

		$data->addNew($Request->all(),$id);
		
		return redirect(env('admin').'/plan')->with('message','Record Updated Successfully.');
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		Plan::where('id',$id)->delete();

		return redirect(env('admin').'/plan')->with('message','Record Deleted Successfully.');
	}

	/*
	|---------------------------------------------
	|@Chnage Status Data
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= Plan::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect(env('admin').'/plan')->with('message','Status Changed Successfully.');
	}

	public function fiance()
	{
		$plan = new Plan;
		$res  = new StorePlan;

		return View('plan.fiance',[

		'data'  		=> $plan->getFiance(),
		'month' 		=> $plan->getFiance(true),
		'store' 		=> $res->getExpiry(),
		'plan'			=> $plan->getAll(0),
		'storePlan' 	=> $res

		]);
	}

	public function sendAlert()
	{
		$plan = StorePlan::find($_GET['pid']);
		$date = date('Y-m-d',strtotime($plan->valid_till));
		$store = Store::find($_GET['id']);

		$plan->last_notify = date('d-M-Y h:i:A');
		$plan->save();

		$msg  = "Dear ".$store->name.", Your Subscription Plan is Expiring on ".$date.". You can manage your plan in My Plan section in your plan & can payment from there to continue.";

		$this->sendPushS("Your Subscription Plan is Expiring on ".$date,$msg,$_GET['id']);

		return Redirect::back()->with('message','Push Notification Sent Successfully.');
	}
}