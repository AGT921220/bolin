<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
class StorePlan extends Authenticatable
{
    protected $table = "store_plan";

    public function getAll($id)
    {
        $res =  StorePlan::join('plan','store_plan.plan_id','=','plan.id')
                        ->select('plan.name','store_plan.*')
                        ->where('store_plan.store_id',$id)
                        ->orderBy('id','DESC')
                        ->get();
        $data = [];
        $plan = new Plan;

        foreach($res as $row)
        {
            $data[] = [

            'id'        => $row->id,
            'plan'      => $row->name,
            'time'      => $row->valid_value." ".$plan->getValidType($row->valid_type),
            'valid'     => date('d-M-Y',strtotime($row->valid_till)),
            'payment'   => $this->getPayment($row),
            'price'     => $row->price,
            'status'    => $row->status,
            'notes'     => $row->notes   

            ];
        }

        return $data;
    }

    public function getPayment($row)
    {
        if($row->payment_method == 0)
        {
            $return = "Not Paid";
        }
        elseif($row->payment_method == 1)
        {
            $return = "Cash Payment";
        }
        elseif($row->payment_method == 2 || $row->payment_method == 4)
        {
            $return = "Online Paid";
        }
        elseif($row->payment_method == 3)
        {
            $return = "Bank Transfer";
        }

        return $return;
    }

    public function addNew($id,$sid,$otherData = [])
    {
        StorePlan::where('store_id',$sid)->update(['status' => 0]);

        $plan               = Plan::find($id);
        $store              = Store::find($sid);

        $add                = new StorePlan;
        $add->store_id      = $sid;
        $add->plan_id       = $id;
        $add->price         = $plan->price;
        $add->valid_type    = $plan->valid_type;
        $add->valid_value   = $plan->valid_value;
        $add->item_limit    = $plan->item_limit;
        $add->order_limit   = $plan->order_limit;
        $add->valid_till    = $this->createValid($id,$sid);

        if(isset($otherData['payment_method']))
        {
            $add->payment_method = $otherData['payment_method'];
        }

        if(isset($otherData['payment_id']))
        {
            $add->status = 1;
            $add->notes  = $otherData['payment_id'];
        }

        if(isset($otherData['notes']))
        {
            $add->notes = $otherData['notes'];
        }

        $add->save();

        $store->plan_id     = $id;
        $store->valid_till  = $this->createValid($id,$sid);
        $store->save();  
    }

    public function createValid($id,$sid)
    {
        $plan  = Plan::find($id);
        $store = Store::find($sid);

        if($plan->valid_type == 0)
        {
            $days = $plan->valid_value;
        }
        elseif($plan->valid_type == 1)
        {
            $days = $plan->valid_value * 30;
        }
        else
        {
            $days = $plan->valid_value * 365;
        }   

        if($store->valid_till && $store->valid_till > date('Y-m-d'))
        {
            $valid = date('Y-m-d',strtotime($store->valid_till.' + '.$days.' days'));
        }
        else
        {
            $valid = date('Y-m-d',strtotime(date('Y-m-d').' + '.$days.' days'));
        }

        return $valid;
    }

    public function pay()
    {
        $res                    = StorePlan::find($_GET['id']);
        $res->payment_method    = $_GET['pay'];
        $res->status            = 1;
        $res->valid_till        = $this->createValid($res->plan_id,$res->store_id);
        $res->save();
    }

    public function getExpiry()
    {
        $date = date('Y-m-d',strtotime(date('Y-m-d').' + 60 days'));

        return StorePlan::join('store','store_plan.store_id','=','store.id')
                        ->join('plan','store_plan.plan_id','=','plan.id')
                        ->select('store.name as store','plan.name as plan','store_plan.*')
                        ->where('store_plan.valid_till','<=',$date)
                        ->where('store_plan.status',1)
                        ->where('store_plan.payment_method','!=',0)
                        ->orderBy('store_plan.valid_till','ASC')
                        ->get();
    }

    public function myPlan()
    {
        $res  = StorePlan::where('status',1)->where('store_id',$_GET['user_id'])->orderBy('id','DESC')->first();
        $plan = Plan::find($res->plan_id);

        return [

        'name'  => $plan->getLang($plan->id)['name'],
        'desc'  => $plan->getLang($plan->id)['desc'],
        'feat'  => $plan->getLang($plan->id)['feat'],
        'price' => User::find(1)->currency.$res->price,
        'valid' => date('d-M-Y',strtotime($res->valid_till))

        ]; 
    }
}
