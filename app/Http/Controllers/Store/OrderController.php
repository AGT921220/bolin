<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Slider;
use App\Language;
use App\Order;
use App\OrderItem;
use App\Delivery;
use App\AppUser;
use App\Item;
use App\Store;
use DB;
use Validator;
use Redirect;
use IMS;
class OrderController extends Controller {

	public $folder  = "store_end.order.";
	
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{	
		$res  = new Order;
		$dboy = new Delivery;
		
		return View($this->folder.'index',[

			'data'  => $res->getAll(),
			'item'  => new OrderItem,
			'c'     => $this->setting()->currency,
			'title' => $this->getTitle(),
			'dboy'	=> $dboy->getAll(Auth::guard('store')->user()->id)

		]);
	}	

	public function getTitle()
	{
		if($_GET['status'] == 0)
		{
			$title = "New Orders"; 
		}
		elseif($_GET['status'] == 1)
		{
			$title = "Running Orders"; 
		}
		elseif($_GET['status'] == 2)
		{
			$title = "Cancelled Orders"; 
		}
		else
		{
			$title = "Completed Orders"; 
		}

		return $title;
	}

	public function status()
	{
		$res 			= Order::find($_GET['id']);
		$res->status 	= $_GET['status'];
		$res->save();
		$res->notify($res->id);

		return Redirect::back()->with('message','Status changed successfully');
	}

	public function orderView()
	{
		$res = new Order;

		return View($this->folder.'view',[

		'data' 	=> $res->signleOrder($_GET['id']),
		'item' 	=> new OrderItem,
		'c' 	=> $this->setting()->currency

		]);
	}

	public function report()
	{	
		$dboy = new Delivery;

		return View($this->folder.'report',['dboy' => $dboy->getAll(Auth::guard('store')->user()->id)]);
	}

	public function _report(Request $Request)
	{
		$res = new Order;

		return View('push.getReport',[

		'data'	=> $res->getReport($Request->all(),Auth::guard('store')->user()->id),
		'c'		=> $this->setting()->currency

		]);
	}

	public function assign(Request $Request)
	{
		$res 			= Order::find($Request->get('id'));
		$res->dboy 		= $Request->get('dboy');
		$res->status    = 3;
		$res->save();
		$res->notify($res->id);
		
		return Redirect::back()->with('message','Status changed successfully');
	}

	public function user()
	{
		$res = Order::where('store_id',Auth::guard('store')->user()->id)->pluck('user_id')->toArray();

		return View($this->folder.'user',['data' => AppUser::whereIn('id',$res)->get()]);
	}

	public function add()
	{
		if($this->hasPlan(Auth::guard('store')->user()->id)->pos != 0)
		{
			return Redirect(env('store').'/home')->with('error','Sorry! You can not access this page.');
			exit;
		}

		$res   = new Store;
		$items = $res->item(Auth::guard('store')->user()->id);
		$cate  = $items['cate'];
		$items = $items['item'];

		return View($this->folder.'add',[

			'data'  => new Order,
			'items' => $items,
			'all' 	=> json_encode($items),
			'cate'	=> $cate,
			'c'		=> $this->setting()->currency

		]);
	}

	public function _add(Request $Request)
	{
		if($this->hasPlan(Auth::guard('store')->user()->id)->pos != 0)
		{
			return Redirect(env('store').'/home')->with('error','Sorry! You can not access this page.');
			exit;
		}

		$res = new Order;
		$res->addPos($Request->all());

		return Redirect::back()->with('message','Order Placed Successfully.');
	}	

	public function orderEdit()
	{
		if($this->hasPlan(Auth::guard('store')->user()->id)->pos != 0)
		{
			return Redirect(env('store').'/home')->with('error','Sorry! You can not access this page.');
			exit;
		}

		$res    = new Store;
		$items  = $res->item(Auth::guard('store')->user()->id);
		$cate   = $items['cate'];
		$items  = $items['item'];
		$detail = new OrderItem;

		return View($this->folder.'edit',[

			'data'  => Order::find($_GET['id']),
			'items' => $items,
			'all' 	=> json_encode($items),
			'cate'	=> $cate,
			'c'		=> $this->setting()->currency,
			'edit'	=> $detail->getItem($_GET['id'])

		]);
	}

	public function _orderEdit(Request $Request)
	{
		$res = new Order;
		$res->addPos($Request->all(),$_GET['id']);

		return Redirect::back()->with('message','Order Placed Successfully.');
	}	
}