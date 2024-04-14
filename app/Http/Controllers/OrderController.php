<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Slider;
use App\Language;
use App\Order;
use App\OrderItem;
use App\Delivery;
use DB;
use Validator;
use Redirect;
use IMS;
use Lang;
class OrderController extends Controller {

	public $folder  = "order.";
	
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
			'dboy'	=> $dboy->getAll(0)

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

	public function assign(Request $Request)
	{
		$res 			= Order::find($Request->get('id'));
		$res->dboy 		= $Request->get('dboy');
		$res->status    = 3;
		$res->save();

		$res->notify($res->id);

		return Redirect::back()->with('message','Status changed successfully');
	}
}