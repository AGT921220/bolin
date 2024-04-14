<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
class Plan extends Authenticatable
{
    protected $table = "plan";
  
    /*
    |--------------------------------
    |Create/Update user
    |--------------------------------
    */

    public function addNew($data,$type)
    {
        $a                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_name']) : [];
        $b                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_desc']) : [];
        $c                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_feat']) : [];
        $add                = $type === 'add' ? new Plan : Plan::find($type);
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->description   = isset($data['description']) ? $data['description'] : null;
        $add->price         = isset($data['price']) ? $data['price'] : 0;
        $add->item_limit    = isset($data['item_limit']) ? $data['item_limit'] : 0;
        $add->valid_type    = isset($data['valid_type']) ? $data['valid_type'] : 0;
        $add->valid_value   = isset($data['valid_value']) ? $data['valid_value'] : 0;
        $add->can_order     = isset($data['can_order']) ? $data['can_order'] : 0;
        $add->order_limit   = isset($data['order_limit']) ? $data['order_limit'] : 0;
        $add->feat          = isset($data['feat']) ? $data['feat'] : null;
        $add->sort_no       = isset($data['sort_no']) ? $data['sort_no'] : 0;
        $add->status        = isset($data['status']) ? $data['status'] : 0;
        $add->pos           = isset($data['pos']) ? $data['pos'] : 0;
        $add->s_data        = serialize([$a,$b,$c]);
        $add->save();
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($status = "all")
    {
        return Plan::where(function($query) use($status){

            if($status !== "all")
            {
                $query->where('status',$status);
            }

        })->orderBy('sort_no','ASC')->get();
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);
 
        return isset($data[$field][$id]) ? $data[$field][$id] : null;
    }

    public function getAppData()
    {
        $data = [];
        $user = User::find(1);
        
        foreach($this->getAll(0) as $row)
        {
            $data[] = [

            'id'            => $row->id,
            'name'          => $this->getLang($row->id)['name'],
            'desc'          => $this->getLang($row->id)['desc'],
            'feat'          => $this->getLang($row->id)['feat'],
            'price'         => $row->price,
            'item_limit'    => $row->item_limit,
            'order_limit'   => $row->order_limit,
            'time'          => $row->valid_value." ".$this->getValidType($row->valid_type),
            'currency'      => $user->currency

            ];
        }

        return $data;
    }

    public function getLang($id)
    {
        $lang = new Language;
        $lid  = $lang->getLang();
        $data = Plan::find($id);

        if($lid == 0)
        {
            return ['name' => $data->name,'desc' => $data->description,'feat' => explode(",", $data->feat)];
        }
        else
        {
            $data = unserialize($data->s_data);

            return ['name' => $data[0][$lid],'desc' => $data[1][$lid],'feat' => explode(",",$data[2][$lid])];
        }
    }

    public function getValidType($type)
    {
        if($type == 0)
        {
            $return = "Days";
        }
        elseif($type == 1)
        {
            $return = "Month";
        }
        else
        {
            $return = "Year";
        }

        return $return;
    }

    public function getFiance($month = false)
    {
        //Total Order Comission
        $orders = Order::where(function($query) use($month) {

            if($month)
            {
                $query->where('created_at','LIKE',date('Y-m').'%');
            }

        })->where('status',5)->get();
        
        $fee    = 0;

        foreach($orders as $order)
        {
             $store = Store::find($order->store_id);

             if($order->com_type == 0)
             {
               $fee = $store->com_value;
             }
             else
             {
               $fee = round($order->total * $store->com_value / 100);
             }
        }

        //Total Plan Subscription Fee
        $storePlan = StorePlan::where(function($query) use($month) {

        if($month)
        {
            $query->where('created_at','LIKE',date('Y-m').'%');
        }

        })->where('status',1)
          ->where('payment_method','!=',0)
          ->sum('price');

        return ['com' => $fee,'plan' => $storePlan,'total' => $fee + $storePlan];
    }
}
