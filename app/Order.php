<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
use DB;
class Order extends Authenticatable
{
   protected $table = 'orders';

   public function addNew($data)
   {

      $totalCal            = $this->getTotal($data['cart_no'],$data);
      $user                = AppUser::find($data['user_id']);

      if(isset($data['address']) && $data['address'] > 0)
      {
          $address = Address::find($data['address']);
      }
      else
      {
          $address = new Address;
      }

      $add                 = new Order;
      $add->store_id       = $this->getStore($data['cart_no']);
      $add->user_id        = $data['user_id'];
      $add->name           = $user->name;
      $add->email          = $user->email;
      $add->phone          = $user->phone;
      $add->address        = $address->address;
      $add->lat            = $address->lat;
      $add->lng            = $address->lng;
      $add->d_charges      = $totalCal['d_charges'];
      $add->discount       = $totalCal['discount'];
      $add->cashback       = $totalCal['cashback'];
      $add->total          = $totalCal['total'];
      $add->payment_method = isset($data['payment']) ? $data['payment'] : 4;
      $add->payment_id     = isset($data['payment_id']) ? $data['payment_id'] : 0;
      $add->type           = isset($data['otype']) ? $data['otype'] : 1;
      $add->odate          = isset($data['odate']) ? $data['odate'] : 1;
      $add->order_date     = isset($data['order_date']) ? $this->getDateTime($data)['date'] : null;
      $add->order_time     = isset($data['order_time']) ? $this->getDateTime($data)['time'] : null;
      $add->notes          = isset($data['comment']) ? $data['comment'] : null;
      $add->ecash          = isset($data['ecash']) ? $data['ecash'] : 0;
      $add->tax_name       = $totalCal['tax_name'];
      $add->tax_value      = $totalCal['tax_value'];
      $add->save();

      $item = new OrderItem;
      $item->addNew($add->id,$data['cart_no']);

      $addon = new OrderAddon;
      $addon->addNew($add->id,$data['cart_no']);

      Cart::where('cart_no',$data['cart_no'])->delete();
      CartCoupen::where('cart_no',$data['cart_no'])->delete();

      if($add->ecash > 0)
      {
        $update         = AppUser::find($add->user_id);
        $update->wallet = $update->wallet - $add->ecash;
        $update->save(); 
      }

      $return = [

      'id'     => $add->id,
      'store'  => Store::find($add->store_id)->name,
      'total'  => $add->total,
      'name'   => $add->name,
     
      ];

      $msg = "A new order receive of amount ".$add->total.". Tap to check order details";
      app('App\Http\Controllers\Controller')->sendPushS("New Order Received",$msg,$add->store_id);

      return ['data' => ['data' => $return,'currency' => User::find(1)->currency]];
   }

   public function getDateTime($data)
   {
     $date = strtotime($data['order_date'].' UTC');
     $date = date("Y-m-d", $date);

     $time = strtotime($data['order_time'].' UTC');
     $time = date("h:i:A", $time);

     return ['date' => $date,'time' => $time];
   }

   public function getStore($cartNo)
   {
      return Cart::where('cart_no',$cartNo)->first()->store_id;
   }

   public function getTotal($cartNo,$data = [])
   {
      $cart       = new Cart;
      $item_total = $cart->getTotal($cartNo);
      $d_charges  = $cart->d_charges($item_total,$cartNo);
      $discount   = CartCoupen::where('discount_type',0)->where('cart_no',$cartNo)->sum('amount');
      $cashback   = CartCoupen::where('discount_type',1)->where('cart_no',$cartNo)->sum('amount');
      $store      = Store::find($this->getStore($cartNo));
      $taxValue   = 0;

       if($store->tax_value > 0)
       {
         $taxValue = round($item_total * $store->tax_value / 100);
       }

      if(isset($data['otype']) && $data['otype'] == "2")
      {
         $d_charges  = 0;
         $total      = $item_total - $discount;
      }
      else
      {
         $total      = ($item_total - $discount) + $d_charges;
      }

       $total      = $total + $taxValue;

      return [ 

      'total'     => $total,
      'discount'  => $discount,
      'd_charges' => $d_charges,
      'cashback'  => $cashback,
      'tax_name'  => $store->getLang($store->id)['tax'],
      'tax_value' => $taxValue

      ];
   }

   public function history()
   {
      $data     = [];
      $currency = User::find(1)->currency;

      $orders = Order::where(function($query){

         if(isset($_GET['id']))
         {
            $query->where('orders.user_id',$_GET['id']);
         }

         if(isset($_GET['dboy_id']))
         {
            $query->whereIn('orders.dboy',[$_GET['dboy_id'],0]);
         }

         if(isset($_GET['status']))
         {
            if($_GET['status'] == 3)
            {
               $query->whereIn('orders.status',[1,3,4]);
            }
            else
            {
               $query->where('orders.status',5);
            }
         }

      })->join('store','orders.store_id','=','store.id')
         ->select('store.name as store','orders.*','store.lat as slat','store.lng as slng')
         ->orderBy('id','DESC')
         ->get();

      $u = new Store;

      foreach($orders as $order)
      {
         $items = [];
         $i     = new OrderItem;

         if(isset($_GET['id']))
         {
           $countRate = Rate::where('order_id',$order->id)->where('user_id',$_GET['id'])->first();
         }
         else
         {
          $countRate = new Rate;
         }

         $data[] = [

         'id'        => $order->id,
         'store'     => $u->getLang($order->store_id,$_GET['lid'])['name'],
         'date'      => date('d-M-Y',strtotime($order->created_at))." | ".date('h:i:A',strtotime($order->created_at)),
         'total'     => $order->total,
         'items'     => $i->getItem($order->id),
         'status'    => $this->status($order),
         'currency'  => $currency,
         'pay'       => $order->payment_method,
         'st'        => $order->status,
         'hasRating' => isset($countRate->id) ? $countRate->star : 0,
         'user'      => $order,
         'payable'   => $this->payable($order),
         'slat'      => $order->slat,
         'slng'      => $order->slng

         ];
      }

      return $data;
   }

   public function status($order)
   {  
       if($order->status == 0)
       {
          $status = "Order Placed";
       }
       elseif($order->status == 1)
       {
          $status = "Order Confirmed";
       }
       elseif($order->status == 2)
       {
          $status = "Order Cancelled";
       }
       elseif($order->status == 3)
       {
          $status = "Delivery Partner Assigned";
       }
       elseif($order->status == 4)
       {
          $status = "Order Coming";
       }
       else
       {
          $status = "Delivered";
       }

       return $status;
   }

   public function payable($data)
   {
     if($data->total == $data->ecash)
     {
       return 0;
     }
     else
     {
       return $data->total - $data->ecash;
     }
   }

   public function getAll($type = null,$store_id = 0)
   {
      $take  = $type ? 15 : "";

      return Order::where(function($query) use($store_id) { 

         if(isset($_GET['status']) && !isset($_GET['q']))
         {
            if($_GET['status'] == 1)
            {
              $query->whereIn('orders.status',[1,3,4]);
            }
            else
            {
              $query->where('orders.status',$_GET['status']);
            }
         } 

         if(isset($_GET['q']))
         {
            $query->where('orders.id',$_GET['q']);
         }

         if($store_id > 0)
         {
            $query->where('orders.store_id',$store_id);
         }

         if(isset($_GET['type']))
         {
            $query->where('orders.store_id',Auth::user()->id);
         }

      })->join('store','orders.store_id','=','store.id')
        ->select('store.name as store','orders.*','store.delivery_by')
        ->orderBy('orders.id','DESC')
        ->take($take)
        ->paginate(50);
   }

   public function getType($id)
   {
      $res = Order::find($id);

      if($res->status_by == 1)
      {
         $return = "Admin";
      }
      elseif($res->status_by == 2)
      {
         $return = "Store";
      }
      elseif($res->status_by == 3)
      {
         $return = "User";
      }

      return $return;
   }

   public function signleOrder($id)
   {
      return Order::join('store','orders.store_id','=','store.id')
                 ->select('store.name as store','orders.*')
                 ->where('orders.id',$id)
                 ->first();
   }

   public function cancelOrder($id)
   {
      $res              = Order::find($id);
      $res->status      = 2;
      $res->status_by   = 3;
      $res->status_time    = date('d-M-Y').' | '.date('h:i:A');
      $res->save();

      return ['data' => $this->history($res->user_id)];   
   }

   public function getReport($data,$sid = 0)
   {
      $res = Order::where(function($query) use($data,$sid) {

      $sid = isset($_GET['id']) ? $_GET['id'] : $sid;

      if(isset($data['from']))
      {
         $from = date('Y-m-d',strtotime($data['from']));
      }
      else
      {
         $from = null;
      }

      if(isset($data['to']))
      {
         $to = date('Y-m-d',strtotime($data['to']));
      }
      else
      {
         $to = null;
      }

      if($from)
      {
         $query->whereDate('orders.created_at','>=',$from);
      }

      if($to)
      {
         $query->whereDate('orders.created_at','<=',$to);
      }

      if(isset($data['store_id']) && $data['store_id'] != "")
      {
         $query->where('orders.store_id',$data['store_id']);
      }

      if(isset($data['dboy']) && $data['dboy'] != "")
      {
         $query->where('orders.dboy',$data['dboy']);
      }

      if($sid > 0)
      {
         $query->where('orders.store_id',$sid);
      }

      $query->where('orders.status',5);

      })->join('store','orders.store_id','=','store.id')
        ->leftjoin('delivery_boys','orders.dboy','=','delivery_boys.id')
        ->select('store.name as store','orders.*','delivery_boys.name as dname')
        ->orderBy('orders.id','ASC')->get();

      $allData = [];

      foreach($res as $row)
      {
         $store = Store::find($row->store_id);

         if($store->com_type == 0)
         {
           $fee = $store->com_value;
         }
         else
         {
           $fee = round($row->total * $store->com_value / 100);
         }

         $allData[] = [

         'id'     => $row->id,
         'date'   => date('d-M-Y',strtotime($row->created_at)),
         'user'   => $row->name,
         'phone'  => $row->phone,
         'store'  => $row->store,
         'amount' => $row->total,
         'fee'    => $fee,
         'dboy'   => $row->dname

         ];
      }

      return $allData;
   }

   public function getStatus($id)
   {
      $order = Order::find($id);

         if($order->status == 0)
         {
            $status = "<span class='badge badge-soft-danger badge-light'>Pending</span>";
         }
         elseif($order->status == 1)
         {
            $status = "<span class='badge badge-soft-info badge-light'>Confirmed</span>";
         }
         elseif($order->status == 2)
         {
            $status = "<span class='badge badge-soft-warning badge-light'>Cancelled</span>";
         }
         elseif($order->status == 3)
         {
            $status = "<span class='badge badge-soft-info badge-light'>Assign Delivery Partner</span>";
         }
         elseif($order->status == 4)
         {
            $status = "<span class='badge badge-soft-info badge-light'>Out for Delivery</span>";
         }
         else
         {
            $status = "<span class='badge badge-soft-success badge-light'>Delivered</span>";
         }

         return $status;
   }

   public function overView()
   {
      $total = Order::where('store_id',$_GET['id'])->count();
      $comp  = Order::where('store_id',$_GET['id'])->where('status',5)->count();

      return ['total' => $total,'complete' => $comp];
   }

   public function getUnit($id)
   {
      $item = Item::find($id);

      $data = [];

      if($item->small_price)
      {
         $data[] = ['id' => 1,'name' => "Small - $.".$item->small_price];
      }

      if($item->medium_price)
      {
         $data[] = ['id' => 2,'name' => "Medium - $.".$item->medium_price];
      }

      if($item->large_price)
      {
         $data[] = ['id' => 3,'name' => "Large/Full - $.".$item->large_price];
      }

      return $data;
   }

   public function storeOrder($status = null)
   {
      
      $res = Order::where(function($query) use($status){

         if(isset($_GET['id']))
         {
            $query->where('orders.store_id',$_GET['id']);
         }

         if(isset($_GET['status']) && !$status)
         {
            if($_GET['status'] == 0)
            {
               $query->whereIn('orders.status',[0,1,3,4]);
            }
         }

         if($status)
         {
            $query->where('orders.status',$status);
         }


      })->orderBy('orders.id','DESC')
        ->get();

        $data   = [];
        $admin  = User::find(1);
        $item   = new OrderItem;

        foreach($res as $row)
        {

          $data[] = [

          'id'       => $row->id,
          'name'     => $row->name,
          'phone'    => $row->phone,
          'address'  => $row->address,
          'status'   => $row->status,
          'total'    => $row->total,
          'currency' => $admin->currency,
          'items'    => $item->getItem($row->id),
          'pay'      => $row->payment_method,
          'date'     => date('d-M-Y',strtotime($row->created_at)),
          'time'     => date('h:i:A',strtotime($row->created_at)),
          'otp'      => $row->type,
          'payable'  => $this->payable($row),
          'ecash'    => $row->ecash,
          'notes'    => $row->notes,
          'order_date' => $row->order_date ? $row->order_date." | ".$row->order_time : null

          ];
        }

        return $data;
   }

   public function runningOrder()
   {
     $res =  Order::join('store','orders.store_id','=','store.id')
                 ->select('store.name as store','orders.*')
                 ->where('user_id',$_GET['id'])
                 ->whereIn('orders.status',[0,1,3,4])
                 ->get();

      $data = [];

      foreach($res as $row)
      {
        $data[] = [

        'id'      => $row->id,
        'store'   => $row->store,
        'total'   => $row->total,
        'status'  => $this->status($row),
        'currency' => User::find(1)->currency

        ];
      }

      return $data;
   }

   public function orderDetail()
   {
     $row =  Order::join('store','orders.store_id','=','store.id')
                  ->leftjoin('delivery_boys','orders.dboy','=','delivery_boys.id')
                   ->select('store.name as store','orders.*','delivery_boys.name as dboy_name','delivery_boys.phone as dboy_phone','delivery_boys.lat as dlat','delivery_boys.lng as dlng','store.lat as slat','store.lng as slng','store.whatsapp as wno','store.chat')
                   ->where('orders.id',$_GET['order_id'])
                   ->first();

      $data = [

        'id'        => $row->id,
        'store'     => $row->store,
        'total'     => $row->total,
        'status'    => $this->status($row),
        'currency'  => User::find(1)->currency,
        'st'        => $row->status,
        'dboy'      => $row->dboy_name,
        'dboy_phone' => $row->dboy_phone,
        'order'      => $row,
        'lat'        => $row->dlat,
        'lng'        => $row->dlng,
        'wno'        => $row->wno,
        'chat'       => $row->chat

        ];

      return $data;
   }

   public function notify($id)
   {
      $order = Order::find($id);
      $admin = User::find(1);
      $store = Store::find($order->store_id);

      if($order->status == 1)
      {  
         $msg = "Dear ".$order->name.", your order #".$order->id." has been confirmed.Total order amount is ".$admin->currency.$order->total;
         $title = "Order Confirmed";

         if($order->type == 1)
         {
           $this->sendAlert($order);
         }
      }
      elseif($order->status == 2)
      {
         $msg   = "Dear ".$order->name.", your order #".$order->id." has been Cancelled.";
         $title = "Order Cancelled";

         Inv::where('order_id',$order->id)->delete();
      }
      elseif($order->status == 3)
      {
         $msg = "Dear ".$order->name.", Delivery partner has been assigned for your order no.".$order->id;
         $title = "Delivery Partner Assigned";

         $msg2 = "New Order #".$order->id." received tap for more info";
         app('App\Http\Controllers\Controller')->sendPushD("New Order Received",$msg2,$order->dboy);
      
      }
       elseif($order->status == 4)
      {
         $msg   = "Dear ".$order->name.", your order #".$order->id." has been out for delivery.";
         $title = "Order out for delivery";
      }
      else
      {
         $msg = "Dear ".$order->name.", your order #".$order->id." has been delivered successfully.";
         $title = "Order delivered";

         $check         = AppUser::find($order->user_id);
         
         if(!$check->rcode)
         {
           $check->rcode  = $check->name[0].rand(1111,9999);
           $check->save();
         } 
      }

      app('App\Http\Controllers\Controller')->sendPush($title,$msg,$order->user_id);

      return true;
   }

   public function sendAlert($order)
   {
      $store = Store::find($order->store_id);

      if($store->delivery_by == 0)
      {
        $dboy = Delivery::select('delivery_boys.*',DB::raw("6371 * acos(cos(radians(" . $store->lat . ")) 
                * cos(radians(delivery_boys.lat)) 
                * cos(radians(delivery_boys.lng) - radians(" . $store->lng . ")) 
                + sin(radians(" .$store->lat. ")) 
                * sin(radians(delivery_boys.lat))) AS distance"))
                ->orderBy('distance','ASC')
                ->where('online',1)
                ->where('store_id',0)
                ->get();
      }
      else
      {
        $dboy = Delivery::select('delivery_boys.*',DB::raw("6371 * acos(cos(radians(" . $store->lat . ")) 
                * cos(radians(delivery_boys.lat)) 
                * cos(radians(delivery_boys.lng) - radians(" . $store->lng . ")) 
                + sin(radians(" .$store->lat. ")) 
                * sin(radians(delivery_boys.lat))) AS distance"))
                ->orderBy('distance','ASC')
                ->where('online',1)
                ->where('store_id',$order->store_id)
                ->get();
      }

      foreach($dboy as $d)
      {
        if($d->distance <= 10000000000000000)
        {
          $msg = "A new order receive. Tap to check details or accept.";
          app('App\Http\Controllers\Controller')->sendPushD("New Order Receive",$msg,$d->id);
        }
      }
   }

   public function addPos($data,$type = "add")
   {
     
      $chkUser = AppUser::where('phone',$data['phone'])->first();

      if(isset($chkUser->id))
      {
        $uid  = $chkUser->id; 
      }
      else
      {
        $addUser            = new AppUser;
        $addUser->name      = $data['name'];
        $addUser->phone     = $data['phone'];
        $addUser->password  = 123456;
        $addUser->save();
        $uid                = $addUser->id;
      }

      $add                 = $type == "add" ? new Order : Order::find($type);
      $add->store_id       = Auth::guard('store')->user()->id;
      $add->user_id        = $uid;
      $add->name           = $data['name'];
      $add->phone          = $data['phone'];
      $add->address        = isset($data['address']) ? $data['address'] : null;
      $add->d_charges      = isset($data['d_charges']) ? $data['d_charges'] : 0;
      $add->discount       = isset($data['discount']) ? $data['discount'] : 0;
      $add->total          = isset($data['total_amount']) ? $data['total_amount'] : 0;
      $add->payment_method = 1;
      $add->type           = isset($data['otype']) ? $data['otype'] : 1;
      $add->notes          = isset($data['notes']) ? $data['notes'] : null;
      $add->status         = 1;
      $add->order_from     = 1;
      $add->save();

      $detail = new OrderItem;
      $detail->addPos($data,$add->id);

      if($add->type == 1)
      {
        $this->sendAlert($add);
      }
   }

}
