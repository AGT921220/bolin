<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Auth;
use App\Page;
use App\AppUser;
use App\Category;
use App\Text;
use App\Language;
use App\Delivery;
use App\Store;
use App\Order;
use DB;
use Validator;
use Redirect;
use Excel;

class DboyController extends Controller {

	public function login(Request $Request)
	{
		$res = new Delivery;
		
		return response()->json($res->login($Request->all()));
	}

	public function homepage()
	{
		$res 	 = new Order;
		$text    = new Text;
		$l 		 = Language::find($_GET['lid']);

		$dboy    	= Delivery::find($_GET['dboy_id']);
		$dboy->lat  = $_GET['lat'];
		$dboy->lng  = $_GET['lng'];
		$dboy->save();

		return response()->json([

		'data' 		=> $res->history(0),
		'text'		=> $text->getAppData($_GET['lid']),
		'dboy'		=> $dboy,

		]);
	}

	public function startRide()
	{
		$res 		 = Order::find($_GET['id']);
		$res->status = $_GET['status'];
		$res->save();
		$res->notify($res->id);
		
		return response()->json(['data' => true]);
	}

	public function userInfo($id)
	{
		$count = Order::where('dboy',$id)->where('status',5)->count();

		return response()->json(['data' => Delivery::find($id),'order' => $count]);
	}

	public function updateInfo(Request $Request)
	{
		$res 				= Delivery::find($Request->get('id'));
		$res->password      = bcrypt($Request->get('password'));
        $res->shw_password  = $Request->get('password');
		$res->save();

		return response()->json(['data' => true]);
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

	public function updateActiveStatus()
	{
		$res 			= Delivery::find($_GET['id']);
		$res->active 	= $_GET['status'] == "true" ? 0 : 1;
		$res->save();

		return response()->json(['data' => true]);
	}

	public function getAssign()
	{
		return response()->json(['data' => 1]);
	}

	public function getLang()
	{
		$res  = new Text;
		$lang = new Language;

		return response()->json([

		'data'  => $lang->getWithEng(),
		'text'	=> $res->getAppData($_GET['lang_id'])

		]);	
	}

	public function setStatus()
	{
		$res 			= Delivery::find($_GET['id']);
		$res->online 	= $_GET['online'];
		$res->lat 		= $_GET['lat'];
		$res->lng 		= $_GET['lng'];
		$res->save();

		return response()->json(['data' => true]);
	}

	public function accept()
	{
		$order 			= Order::find($_GET['order_id']);
		
		if($order->dboy == 0)
		{
			$res 			= Delivery::find($_GET['dboy_id']);
			$res->lat 		= $_GET['lat'];
			$res->lng 		= $_GET['lng'];
			$res->save();

			$order->dboy 	= $_GET['dboy_id'];
			$order->status  = 3;
			$order->save();

			$order->notify($res->id);

			return response()->json(['data' => $order->history(0)]);
		}
		else
		{
			return response()->json(['data' => 'error']);
		}
	}

	public function earn()
	{
		$res = new Delivery;

		return response()->json(['data' => $res->earn()]);
	}
}