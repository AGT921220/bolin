<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Language;
use App\Order;
use App\Delivery;
use App\Models\User as ModelsUser;
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
        // return ModelsUser::get()->toArray();
		return View('index',['form_url' => Asset('login')]);
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

		if (Auth::attempt(['username' => $username, 'password' => $password]))
		{
			return Redirect::to('home')->with('message', 'Welcome ! Your are logged in now.');
		}
		else
		{
			return Redirect::to('login')->with('error', 'Username password not match')->withInput();
		}
	}

	/*
	|------------------------------------------------------------------
	|Homepage, Dashboard
	|------------------------------------------------------------------
	*/
	public function home()
	{
		$user  = new User;
		$order = new Order;
		$c     = User::find(1)->currency;
		$dboy  = new Delivery;

		return View('dashboard.home',[

			'data' 		=> $user->overview(),
			'order' 	=> $order->getAll(1),
			'c' 		=> $c,
			'dboy'		=> $dboy->getAll(0),
			'schart'	=> $user->storeChart(),

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

		return Redirect::to('login')->with('message', 'Logout Successfully !');
	}

	/*
	|------------------------------------------------------------------
	|Account setting's page
	|------------------------------------------------------------------
	*/
	public function setting()
	{
		$lang = new Language;

		return View('dashboard.setting',[

			'data' 		=> auth()->user(),
			'form_url'	=> Asset('setting'),
			'lang' 		=> $lang->getAll(0)

			]);
	}

	/*
	|------------------------------------------------------------------
	|update account setting's
	|------------------------------------------------------------------
	*/
	public function update(Request $Request)
	{
		$admin = new User;

		if($admin->matchPassword($Request->get('password')))
		{
			return Redirect::back()->with('error','Opps! Your current password is not match.');
		}
		else
		{
			$admin->updateData($Request->all());

			return Redirect::back()->with('message','Account Information Updated Successfully.');
		}
	}

	public function setLang()
	{
		Session::put('locale', $_GET['lang']);

		return Redirect::back()->with('message', 'Language Changed Successfully.');
	}
}
