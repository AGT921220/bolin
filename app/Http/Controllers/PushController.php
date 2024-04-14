<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Language;
use App\User;
use App\Order;
use App\Store;
use App\Delivery;
use DB;
use Validator;
use Redirect;
use IMS;
class PushController extends Controller {

	public $folder  = "push.";

	public function index()
	{
		return View($this->folder.'index');
	}

	public function send(Request $Request)
	{
		$this->sendPush($Request->get('title'),$Request->get('text'));

		return Redirect::back()->with('message','Push Notification Sent Successfully');
	}

	public function report()
	{
		$dboy = new Delivery;

		return View($this->folder.'report',['data' => Store::get(),'dboy' => $dboy->getAll(0)]);
	}

	public function _report(Request $Request)
	{
		$res = new Order;

		return View($this->folder.'getReport',[

		'data'	=> $res->getReport($Request->all()),
		'c'		=> $this->setting()->currency

		]);
	}
}
