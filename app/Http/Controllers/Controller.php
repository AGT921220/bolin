<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\StorePlan;
use App\Item;
use App\Order;
use App\Plan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function setting()
    {
    	return User::find(1);
    }

    function sendPush($title,$description,$uid = 0)
	{
		$content = ["en" => $description];
		$head 	 = ["en" => $title];		

		$daTags = [];

		if($uid > 0)
		{
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $uid];
		}
		else
		{
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "!=", "value" => 'NAN'];
		}
		
		$fields = array(
		'app_id' => $this->setting()->push_app_id,
		'included_segments' => array('All'),	
		'filters' => [$daTags],
		'data' => array("foo" => "bar"),
		'contents' => $content,
		'headings' => $head,
		);
        
     
		$fields = json_encode($fields);
        
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		'Authorization: Basic '.$this->setting()->push_rest_api));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
       
	    return $response;
	}

	function sendPushD($title,$description,$uid = 0)
	{
		$content = ["en" => $description];
		$head 	 = ["en" => $title];		

		$daTags = [];

		if($uid > 0)
		{
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $uid];
		}
		else
		{
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "!=", "value" => 'NAN'];
		}
		
		$fields = array(
		'app_id' => $this->setting()->d_push_app_id,
		'included_segments' => array('All'),	
		'filters' => [$daTags],
		'data' => array("foo" => "bar"),
		'contents' => $content,
		'headings' => $head,
		'android_channel_id' => '3e4d9e51-bb77-40f7-9a36-7839e3fd68a0'
		);
        
     
		$fields = json_encode($fields);
        
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		'Authorization: Basic '.$this->setting()->d_push_rest_api));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
       
	    return $response;
	}

	function sendPushS($title,$description,$uid = 0)
	{
		$content = ["en" => $description];
		$head 	 = ["en" => $title];		

		$daTags = [];

		if($uid > 0)
		{
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $uid];
		}
		else
		{
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "!=", "value" => 'NAN'];
		}
		
		$fields = array(
		'app_id' => $this->setting()->s_push_app_id,
		'included_segments' => array('All'),	
		'filters' => [$daTags],
		'data' => array("foo" => "bar"),
		'contents' => $content,
		'headings' => $head,
		'android_channel_id' => 'f504b3cb-1de8-45f1-b2ba-39691b86f9f5'
		);
        
     
		$fields = json_encode($fields);
        
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
		'Authorization: Basic '.$this->setting()->s_push_rest_api));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
       
	    return $response;
	}

	public function hasPlan($id)
	{
		$storePlan = StorePlan::join('plan','store_plan.plan_id','=','plan.id')
							 ->select('plan.item_limit','plan.order_limit','store_plan.*','plan.name')
							  ->where('store_plan.store_id',$id)
							  ->where('store_plan.status',1)
							  ->where('store_plan.valid_till','>=',date('Y-m-d'))
							  ->first();

		return isset($storePlan->id) ? $storePlan : new StorePlan;

	}

	public function hasItem($id)
    {
        $plan = $this->hasPlan($id);

        if($plan->id)
        {
        	$item  		= Item::where('store_id',$id)->count();
        	$order 		= Order::where('store_id',$id)->count();

        	if($plan->item_limit > 0)
        	{
        		$itemLeft = $plan->item_limit - $item;
        	}
        	else
        	{
        		$itemLeft = "unlimited";
        	}

        	if($plan->order_limit > 0)
        	{
        		$canOrder  = StorePlan::where('store_id',$id)->where('status',1)->sum('order_limit');

        		$orderLeft = $canOrder - $order;
        	}
        	else
        	{
        		$orderLeft = "unlimited";
        	}

        	return ['item' => $itemLeft,'order' => $orderLeft];

        }
        else
        {
        	return ['item' => null,'order' => null];
        }
    }
}
