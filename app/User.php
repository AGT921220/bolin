<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    /*
    |------------------------------------------------------------------
    |Checking for current admin password
    |@password = admin password
    |------------------------------------------------------------------
    */
    public function matchPassword($password)
    {
      if(auth()->attempt(['username' => Auth()->user()->username, 'password' => $password]))
      {
          return false;
      }
      else
      {
          return true;
      }
    }

    /*
    |---------------------------------
    |Update Account Data
    |---------------------------------
    */
    public function updateData($data)
    {
        $update                     = User::find(Auth::user()->id);
        $update->name               = isset($data['name']) ? $data['name'] : null;
        $update->email              = isset($data['email']) ? $data['email'] : null;
        $update->username           = isset($data['username']) ? $data['username'] : null;
        $update->currency           = isset($data['currency']) ? $data['currency'] : "$";
        $update->time_slot          = isset($data['time_slot']) ? $data['time_slot'] : "30";
        $update->currency_code      = isset($data['currency_code']) ? $data['currency_code'] : "usd";
        $update->cod                = isset($data['cod']) ? $data['cod'] : 0;
        $update->razor_key          = isset($data['razor_key']) ? $data['razor_key'] : null;
        $update->stripe_key         = isset($data['stripe_key']) ? $data['stripe_key'] : null;
        $update->stripe_skey        = isset($data['stripe_skey']) ? $data['stripe_skey'] : null;
        $update->push_app_id        = isset($data['push_app_id']) ? $data['push_app_id'] : null;
        $update->push_rest_api      = isset($data['push_rest_api']) ? $data['push_rest_api'] : null;
        $update->push_google        = isset($data['push_google']) ? $data['push_google'] : null;
        $update->lang               = isset($data['lang']) ? $data['lang'] : 0;
        $update->web_app            = isset($data['web_app']) ? $data['web_app'] : null;
        $update->point_who          = isset($data['point_who']) ? $data['point_who'] : null;
        $update->point_use          = isset($data['point_use']) ? $data['point_use'] : null;
        $update->d_push_app_id      = isset($data['d_push_app_id']) ? $data['d_push_app_id'] : null;
        $update->d_push_rest_api    = isset($data['d_push_rest_api']) ? $data['d_push_rest_api'] : null;
        $update->d_push_google      = isset($data['d_push_google']) ? $data['d_push_google'] : null;
        $update->s_push_app_id      = isset($data['s_push_app_id']) ? $data['s_push_app_id'] : null;
        $update->s_push_rest_api    = isset($data['s_push_rest_api']) ? $data['s_push_rest_api'] : null;
        $update->s_push_google      = isset($data['s_push_google']) ? $data['s_push_google'] : null;
        $update->term               = isset($data['term']) ? $data['term'] : null;
        $update->paypal_id          = isset($data['paypal_id']) ? $data['paypal_id'] : null;
        $update->paystack_id        = isset($data['paystack_id']) ? $data['paystack_id'] : null;
        $update->bank_transfer      = isset($data['bank_transfer']) ? str_replace("\n","<br>",$data['bank_transfer']) : null;
        
        if(isset($data['new_password']))
        {
            $update->password = bcrypt($data['new_password']);
        }

        $update->save();
    }

    public function overview()
    {
        $store       = Store::where('status',0)->count();
        $delivery    = Delivery::where('store_id',0)->where('status',0)->count();
        $order       = Order::count();
        $complete    = Order::where('status',5)->count();
        $cancel      = Order::where('status',2)->count();
        $running     = Order::whereIn('status',[0,1,3,4])->count();
        $user        = Order::pluck('phone')->toArray();

        return [

        'store'         => $store,
        'delivery'      => $delivery,
        'order'         => $order,
        'user'          => count(array_unique($user)),
        'complete'      => $complete,
        'cancel'        => $cancel,
        'running'       => $running,

        ]; 
    }

    public function storeChart()
    {
        $storeID = Order::where('status',5)->pluck('store_id')->toArray();

        $data = [];

        foreach(array_unique($storeID) as $sid)
        {
            $user = Store::find($sid);

            if(isset($user->id))
            {
                $data[] = ['name' => $user->name,'order' => Order::where('store_id',$sid)->where('status',5)->count()];
            }
        }   

         usort($data, function ($a, $b) {
        if ($b["order"] == $a["order"]) return 0;
        return $b["order"] < $a["order"] ? -1 : 1;
        });

         $all = $data;


         return array_slice($all,0,5);
    }
}
