<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Page;
use DB;
use Validator;
use Redirect;
use IMS;
class PageController extends Controller {

	public $folder  = "page.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{					
		$count = Page::find(1);

		if(!isset($count->id))
		{
			$add 			= new Page;
			$add->about_us  = "About Us"; 
			$add->save();
		}

		$res = new Page;
		
		if(isset($_GET['remove']))
		{
			$update = Page::find(1);

			if($_GET['remove'] == "img")
			{
				$update->img = null;	
			}

			if($_GET['remove'] == "home_img")
			{
				$update->home_img = null;	
			}

			if($_GET['remove'] == "apt_img")
			{
				$update->apt_img = null;	
			}

			$update->save();

			return redirect::back()->with('message','Updated Successfully.');

			exit;
		}

		return View($this->folder.'index',['data' => Page::find(1),'form_url' => 'page']);
	}	
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function _save(Request $Request)
	{			
		$data = new Page;	
		
		$data->addNew($Request->all(),"add");
		
		return redirect::back()->with('message','Updated Successfully.');
	}
}