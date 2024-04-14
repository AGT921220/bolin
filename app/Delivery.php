<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class Delivery extends Authenticatable
{
    protected $table = "delivery_boys";

    /*
    |----------------------------------------------------------------
    |   Validation Rules and Validate data for add & Update Records
    |----------------------------------------------------------------
    */
    
    public function rules($type)
    {
        if($type === 'add')
        {
            return [

            'phone' => 'required|unique:delivery_boys',

            ];
        }
        else
        {
            return [

            'phone'     => 'required|unique:delivery_boys,phone,'.$type,

            ];
        }
    }
    
    public function validate($data,$type)
    {

        $validator = Validator::make($data,$this->rules($type));       
        if($validator->fails())
        {
            return $validator;
        }
    }

    /*
    |--------------------------------
    |Create/Update city
    |--------------------------------
    */

    public function addNew($data,$type)
    {
        $a                      = isset($data['lid']) ? array_combine($data['lid'], $data['l_name']) : [];
        $add                    = $type === 'add' ? new Delivery : Delivery::find($type);
        $add->store_id          = isset($data['user_id']) ? $data['user_id'] : 0;
        $add->name              = isset($data['name']) ? $data['name'] : null;
        $add->charge            = isset($data['charge']) ? $data['charge'] : 0;
        $add->phone             = isset($data['phone']) ? $data['phone'] : null;
        $add->status            = isset($data['status']) ? $data['status'] : 0;
        $add->s_data            = serialize($a);

        if(isset($data['password']))
        {
            $add->password      = bcrypt($data['password']);
            $add->shw_password  = $data['password'];
        }

        $add->save();
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($store = "all")
    {
        return Delivery::where(function($query) use($store) {

            if($store !== "all")
            {
                $query->where('store_id',$store);
            }

        })->leftjoin('users','delivery_boys.store_id','=','users.id')
          ->select('users.name as store','delivery_boys.*')
          ->orderBy('delivery_boys.id','DESC')->get();
    }

   public function login($data)
   {
     $chk = Delivery::where('status',0)->where('phone',$data['phone'])->where('shw_password',$data['password'])->first();

     if(isset($chk->id))
     {
        return ['msg' => 'done','user' => $chk];
     }
     else
     {
        return ['msg' => 'Opps! Invalid login details'];
     }
   }

   public function getSData($data,$id,$field)
    {
        $data = unserialize($data);

        return isset($data[$id]) ? $data[$id] : null;
    }

   public function getAllAssign($id)
   {
        $order  = Order::find($id);
        
        return Delivery::where('status',0)->where('store_id',$order->store_id)->get();

   }

   public function earn()
   {
        $total    = Order::where('dboy',$_GET['id'])->where('status',5)->count();
        $month    = Order::where('dboy',$_GET['id'])->where('status',5)
                         ->where('created_at','LIKE',date('Y-m').'%')
                         ->count();

        $dboy     = Delivery::find($_GET['id']);

        return [

        'total'         => $total,
        'month'         => $month,
        'total_earn'    => round($total * $dboy->charge),
        'month_earn'    => round($month * $dboy->charge),
        'currency'      => User::find(1)->currency

        ];
    }
}
