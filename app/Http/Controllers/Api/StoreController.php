<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Delivery;
use App\Order;
use App\Language;
use App\Text;
use App\User;
use App\Item;
use App\Plan;
use App\City;
use App\Store;
use App\StorePlan;
use DB;
use Validator;
use Redirect;
use Excel;
use Stripe;
class StoreController extends Controller {

	public function homepage()
	{
		$res 	 = new Order;
		$text    = new Text;
		$l 		 = Language::find($_GET['lid']);

		return response()->json([

		'data' 		=> $res->storeOrder(),
		'complete' 	=> $res->storeOrder(5),
		'cancel' 	=> $res->storeOrder(2),
		'text'		=> $text->getAppData($_GET['lid']),
		'app_type'	=> isset($l->id) ? $l->type : 0,
		'store'		=> Store::find($_GET['id']),
		'overview'	=> $res->overView(),

		]);
	}

	public function getDboy()
	{
		$res = new Delivery;
		
		return response()->json(['data' => $res->getAllAssign($_GET['id'])]);
	}

	public function login(Request $Request)
	{
		$res = new Store;
		
		return response()->json($res->login($Request->all()));
	}

	public function signup(Request $Request)
	{
		$res = new Store;

		return response()->json($res->signup($Request->all()));
	}

	public function forgot(Request $Request)
	{
		$res = new AppUser;
		
		return response()->json($res->forgot($Request->all()));
	}

	public function verify(Request $Request)
	{
		$res = new AppUser;
		
		return response()->json($res->verify($Request->all()));
	}

	public function updatePassword(Request $Request)
	{
		$res = new AppUser;
		
		return response()->json($res->updatePassword($Request->all()));
	}

	public function orderProcess()
	{
		$res 		 = Order::find($_GET['id']);
		$res->status = $_GET['status'];
		$res->save();

		if(isset($_GET['dboy']))
		{
			$res->status_by 	= 1;
			$res->dboy 			= $_GET['dboy'];
			$res->status_time 	= date('d-M-Y').' | '.date('h:i:A');
			$res->save();
		}

		$res->notify($res->id);

		return response()->json(['data' => $res->status]);
	}

	public function userInfo($id)
	{
		return response()->json(['data' => Store::find($id)]);
	}

	public function storeOpen($type)
	{
		$res 		= Store::find($_GET['user_id']);
		$res->open 	= $type;
		$res->save();

		return response()->json(['data' => true]);
	}

	public function updateInfo(Request $Request)
	{
		$count = Store::where('id','!=',$_GET['user_id'])->where('phone',$Request->get('phone'))->count();

		if($count > 0)
		{
			return response()->json(['data' => 'error']);
		}
		
		$res   = Store::find($_GET['user_id']);
		
		if($Request->get('password'))
		{
			$res->password      = bcrypt($Request->get('password'));
        	$res->shw_password  = $Request->get('password');
		}

		$res->name 		 			 = $Request->get('name');
		$res->phone 				 = $Request->get('phone');
		$res->address 				 = $Request->get('address');
		$res->fix_km 				 = $Request->get('fix_km');
		$res->fix_amount 			 = $Request->get('fix_amount');
		$res->per_km 				 = $Request->get('per_km');
		$res->max_km 				 = $Request->get('max_km');
		$res->save();

		return response()->json(['data' => true,'res' => $res]);
	}

	public function updateLocation(Request $Request)
	{
		if($Request->get('user_id') > 0)
		{
			$add 			= Delivery::find($Request->get('user_id'));
			$add->lat 		= $Request->get('lat');
			$add->lng 		= $Request->get('lng');
			$add->save();
		}

		return response()->json(['data' => true]);
	}

	public function getItem()
	{
		$res = new Store;

		return response()->json(['data' => $res->item()]);
	}

	public function changeStatus()
	{
		$res 		 = Item::find($_GET['id']);
		$res->status = $_GET['status'];
		$res->save();

		return response()->json(['data' => true]);
	}

	public function editItem(Request $Request)
	{
		$res = new Item;

		return response()->json(['data' => $res->editItem($Request->all())]);
	}
	
	public function getCount()
	{
		return response()->json(['data' => Order::where('store_id',$_GET['id'])->count()]);
	}

	public function plan()
	{
		$plan = new Plan;
		$data = [

		'plan'			=> $plan->getAppData(),
		'setting' 		=> $this->setting()

		];

		return response()->json(['data' => $data]);
	}

	public function myPlan()
	{
		$my   = new StorePlan;
		$plan = new Plan;
		$data = [

		'plan'			=> $plan->getAppData(),
		'setting' 		=> $this->setting(),
		'my'			=> $my->myPlan()

		];

		return response()->json(['data' => $data]);
	}

	public function renew(Request $Request)
	{
		$res = new StorePlan;

		$res->addNew($Request->get('plan_id'),$Request->get('user_id'),$Request->all());

		return response()->json(['data' => true]);
	}
}