<?php namespace App\Http\Controllers\Store;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Language;
use App\Store;
use App\Cate;
use App\City;
use App\StoreCate;
use App\StoreImage;
use App\Order;
use App\Delivery;
use App\StoreMenu;
use DB;
use Validator;
use Redirect;
use Session;
class AdminController extends Controller {

	/*
	|------------------------------------------------------------------
	|Index page for login
	|------------------------------------------------------------------
	*/
	public function index()
	{
		return View('store_end.index',['form_url' => Asset('login')]);
	}

	/*
	|------------------------------------------------------------------
	|Login attempt,check username & password
	|------------------------------------------------------------------
	*/
	public function login(Request $request)
	{
		$username = $request->input('username');
		$password = $request->input('password');
		
		if (Auth::guard('store')->attempt(['phone' => $username, 'password' => $password]))
		{
			return Redirect::to(env('store').'/home')->with('message', 'Welcome ! Your are logged in now.');
		}
		else
		{
			return Redirect::to(env('store').'/login')->with('error', 'Username password not match')->withInput();
		}
	}

	/*
	|------------------------------------------------------------------
	|Homepage, Dashboard
	|------------------------------------------------------------------
	*/
	public function home()
	{	
		$user  = new Store;
		$order = new Order;
		$dboy  = new Delivery;

		return View('store_end.dashboard.home',[

		'data'  	=> $user->overview(),
		'order' 	=> $order->getAll(1,Auth::guard('store')->user()->id),
		'c' 		=> User::find(1)->currency,
		'dboy'		=> $dboy->getAll(0),
		'hasPlan' 	=> $this->hasPlan(Auth::guard('store')->user()->id),
		'hasItem' 	=> $this->hasItem(Auth::guard('store')->user()->id)
		]);
	}
	/*
	|------------------------------------------------------------------
	|Logout
	|------------------------------------------------------------------
	*/
	public function logout()
	{
		Auth::logout();
		
		return Redirect::to(env('store').'/login')->with('message', 'Logout Successfully !');
	}

	/*
	|------------------------------------------------------------------
	|Account setting's page
	|------------------------------------------------------------------
	*/
	public function setting()
	{
		$cate = new Cate;
		$city = new City;
		$id   = Auth::guard('store')->user()->id;

		return View('store_end.dashboard.setting',[

		'data' 		=> Store::find($id),
		'form_url' 	=> env('store').'/setting',
		'cates'		=> $cate->getAll(0),
		'city'		=> $city->getAll(0),
		'array'		=> StoreCate::where('store_id',$id)->pluck('cate_id')->toArray(),
		'images'	=> StoreImage::where('store_id',$id)->get(),
		'menu'		=> StoreMenu::where('store_id',$id)->get()

		]);
	}
	
	/*
	|------------------------------------------------------------------
	|update account setting's
	|------------------------------------------------------------------
	*/
	public function update(Request $Request)
	{		
		$data = new Store;

		$data->addNew($Request->all(),Auth::guard('store')->user()->id);
		
		return redirect::back()->with('message','Record Updated Successfully.');
	}

	public function setLang()
	{
		Session::put('locale', $_GET['lang']);
    		
		return Redirect::back()->with('message', 'Language Changed Successfully.');
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
}