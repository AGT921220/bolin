<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Mail;
use Auth;

class AppUser extends Authenticatable
{
   protected $table = 'app_user';

   public function signup($data)
   {
     $count = AppUser::where('email',$data['email'])->count();

     if($count == 0)
     {
       if(isset($data['rcode']))
       {
         $chkCode = AppUser::where('rcode',$data['rcode'])->first();

         if(!isset($chkCode->id))
         {
            return ['msg' => 'error','error' => 'Opps! This referral code is not valid.'];
            exit;
         }
       }
       else
       {
         $chkCode = 0;
       }

        $add                = new AppUser;
        $add->name          = $data['name'];
        $add->email         = $data['email'];
        $add->phone         = $data['phone'];
        $add->password      = $data['password'];
        $add->status        = 0;

        if(isset($chkCode->id))
        {
            $user           = User::find(1);
            $add->wallet    = $user->point_use;
            $up             = AppUser::find($chkCode->id);
            $up->wallet     = $up->wallet + $user->point_who; 
            $up->save();
        }

        $add->save();

        return ['msg' => 'done','user' => $add];
     }
     else
     {
        return ['msg' => 'error','error' => 'Opps! This email is already exists.'];
     }
   }

   public function login($data)
   {
     $chk = AppUser::where('email',$data['email'])->where('password',$data['password'])->first();

     if(isset($chk->id))
     {
        return ['msg' => 'done','user' => $chk];
     }
     else
     {
        return ['msg' => 'Opps! Invalid login details'];
     }
   }

   public function forgot($data)
    {
        $res = AppUser::where('email',$data['email'])->first();

        if(isset($res->id))
        {
            $otp = rand(1111,9999);

            $res->vcode = $otp;
            $res->save();

            Mail::send('email',['res' => $res], function($message) use($res)
            {     
               $message->to($res->email)->subject("Verify Your Email");
                        
            });

            $return = ['msg' => 'done','user_id' => $res->id];
        }
        else
        {
            $return = ['msg' => 'error','error' => 'Sorry! This email is not registered with us.'];
        }

        return $return;
    }

    public function verify($data)
    {
        $res = AppUser::where('id',$data['user_id'])->where('vcode',$data['otp'])->first();

        if(isset($res->id))
        {
            $res->status = 1;
            $res->save();

            $return = ['msg' => 'done','user_id' => $res->id];
        }
        else
        {
            $return = ['msg' => 'error','error' => 'Sorry! OTP not match.'];
        }

        return $return;
    }

    public function updatePassword($data)
    {
        $res = AppUser::where('id',$data['user_id'])->first();

        if(isset($res->id))
        {
            $res->password = $data['password'];
            $res->save();

            $return = ['msg' => 'done','user_id' => $res->id];
        }
        else
        {
            $return = ['msg' => 'error','error' => 'Sorry! Something went wrong.'];
        }

        return $return;
    }

    public function countOrder($id)
    {
        return Order::where('user_id',$id)->where('status','>',0)->count();
    }

    public function getAll()
    {
        return AppUser::orderBy('id','DESC')->get();
    }

    public function updateInfo($data)
    {
      $count = AppUser::where('id','!=',$_GET['id'])->where('email',$data['email'])->count();

      if($count == 0)
      {
            $add                = AppUser::find($_GET['id']);
            $add->name          = $data['name'];
            $add->email         = $data['email'];
            $add->phone         = $data['phone'];
            $add->whatsapp_no   = isset($data['whatsapp_no']) ? $data['whatsapp_no'] : null;
            
            if(isset($data['password']))
            {
                $add->password  = $data['password'];
            }

            $add->save();

             return ['msg' => 'done','user_id' => $add->id];
        }
        else
        {
            return ['msg' => 'error','error' => 'Opps! This email is already exists.'];
        }
    }

    public function totalOrder($id)
    {
        return Order::where('user_id',$id)->where('status',$id)->count();
    }

    public function getLastOrder($id)
   {
     $res = Order::where('store_id',Auth::guard('store')->user()->id)->where('user_id',$id)->orderBy('id','DESC')->first();

     return isset($res->id) ? date('d-M-Y h:i:A',strtotime($res->created_at)) : null;
   }

   public function getTotalOrder($id)
   {
     return Order::where('store_id',Auth::guard('store')->user()->id)->where('user_id',$id)->count();
   }
}
