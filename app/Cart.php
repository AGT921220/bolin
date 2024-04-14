<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
class Cart extends Authenticatable
{
    protected $table = 'cart';

    public function addNew($data)
    {
        $store = Item::find($data['id']);

        $this->checkStore($data,$store->store_id);

        $s = new Store;

       if(!$s->hasStock($data['id']))
       {
         return ['error' => true];
         exit;
       }

        $check = Cart::where('cart_no',$data['cart_no'])->where('item_id',$data['id'])
                     ->where('qty_type',$data['qtype'])->first();

        $add                = !isset($check->id) ? new Cart : Cart::find($check->id);
        $add->cart_no       = isset($data['cart_no']) ? $data['cart_no'] : 0;
        $add->store_id      = $store->store_id;
        $add->item_id       = isset($data['id']) ? $data['id'] : 0;
        $add->price         = isset($data['price']) ? $data['price'] : 0;
        $add->qty_type      = isset($data['qtype']) ? $data['qtype'] : 0;

        if($data['type'] == 0)
        {
            $add->qty = $add->qty + 1;
        }
        else
        {
            $add->qty = $add->qty - 1;
        }

        $add->save();

        Cart::where('qty',0)->delete();

        $addon = new CartAddon;
        $addon->addNew($data,$add->id);

        return [
        'error' => false,
        'count' => Cart::where('cart_no',$data['cart_no'])->count(),
        'cart'  => $this->getItemQty($data['cart_no'])

        ];
    }

    public function updateCart($id,$type)
    {
        if(isset($_GET['cart_no']))
        {
            $res            = Cart::where('cart_no',$_GET['cart_no'])->where('item_id',$id)->first();
            $qty            = $res->qty;
            $res->qty       = $qty - 1;
            $res->save();

            if($res->qty == 0)
            {
                $res->delete();
            }

            return [

                'data' => $this->getItemQty($_GET['cart_no']),
                'count' => Cart::where('cart_no',$_GET['cart_no'])->count()
            ];
        }
        else
        {
            $res            = Cart::find($id);
            $qty            = $res->qty;
            $res->qty       = $type == 0 ? $qty - 1 : $qty + 1;
            $res->save();

            if($res->qty == 0)
            {
                $res->delete();
            }

            CartCoupen::where('cart_no',$res->cart_no)->delete();

            return [

                'data' => $this->getCart($res->cart_no),
            ];
        }
    }

    public function getItemQty($cart_no)
    {
        $id = Cart::select('item_id')->distinct()->where('cart_no',$cart_no)->get();

        $data = [];

        foreach($id as $i)
        {
            $qty = Cart::where('cart_no',$cart_no)->where('item_id',$i->item_id)->sum('qty');

            $data[] = ['item_id' => $i->item_id,'qty' => $qty];
        }

        return $data;
    }

    public function getCart($cartNo)
    {
        $res = Cart::join('item','cart.item_id','=','item.id')
                   ->select('item.name as item','item.img','cart.*','item.unit1','item.unit2','item.unit3')
                   ->where('cart.cart_no',$cartNo)
                   ->get();

        $data       = [];

        foreach($res as $row)
        {
            if($row->qty_type == 1)
            {
                $qtyName = $row->unit1;
            }
            elseif($row->qty_type == 2)
            {
                $qtyName = $row->unit2;
            }
            else
            {
                $qtyName = $row->unit3;
            }

            $item   = new Item;

            $data[] = [

            'id'       => $row->id,
            'store_id' => $row->store_id,
            'item_id'  => $row->item_id,
            'price'    => $row->price,
            'qtype'    => $row->qty_type,
            'qty'      => $row->qty,
            'item'     => $item->getLang($row->item_id)['name'],
            'img'      => $row->img ? Asset('upload/item/'.$row->img) : null,
            'qtyName'  => $qtyName,
            'addon'    => $this->cartAddon($row->id,$row->item_id)

            ];
        }

       $item_total = $this->getTotal($cartNo);
       $discount   = CartCoupen::where('discount_type',0)->where('cart_no',$cartNo)->sum('amount');
       $hasOffer   = CartCoupen::where('cart_no',$cartNo)->first();
       $d_charges  = $this->d_charges($item_total,$cartNo);
       $total      = ($item_total - $discount) + $d_charges;
       $sid        = Cart::where('cart_no',$cartNo)->select('store_id')->distinct()->first();
       $store      = isset($sid->store_id) ? Store::find($sid->store_id) : new Store;
       $taxValue   = 0;

       if($store->tax_value > 0)
       {
         $taxValue = round($item_total * $store->tax_value / 100);
       }

       $total      = $total + $taxValue;

       if($store->delivery_time)
       {
         $date    = date("Y-m-d",strtotime(date("Y-m-d")." + ".$store->delivery_time." days"));
       }
       else
       {
        $date     = date("Y-m-d");
       }

       return [

       'data'           => $data,
       'item_total'     => $item_total,
       'd_charges'      => $d_charges,
       'total'          => $total,
       'discount'       => $discount,
       'currency'       => User::find(1)->currency,
       'open'           => isset($store->id) ? $store->storeOpen($store) : true,
       'store'          => $store,
       'pay_info'       => str_replace("\n","<br>", $store->pay_info),
       'date'           => $date,
       'hasOffer'       => $hasOffer,
       'tax_name'       => $store->getLang($store->id)['tax'],
       'tax_value'      => $taxValue
       ];
    }

    public function cartAddon($id,$item_id)
    {
        return CartAddon::join('addon','cart_addon.addon_id','=','addon.id')
                        ->select('addon.*','cart_addon.qty')
                        ->where('cart_addon.cart_id',$id)
                        ->where('cart_addon.item_id',$item_id)
                        ->get();
    }

    public function checkStore($data,$sid)
    {
        $count = Cart::where('cart_no',$data['cart_no'])->orderBy('id','DESC')->first();

        if(isset($count->id))
        {
            
            Cart::where('cart_no',$data['cart_no'])->where('store_id','!=',$sid)->delete();
        }
    }

    public function d_charges($total,$cartNo)
    {
        $cart       = Cart::where('cart_no',$cartNo)->first();
        $store      = isset($cart->id) ? Store::find($cart->store_id) : new Store;
        $distance   = $this->distance($store->lat,$store->lng,$_GET['lat'],$_GET['lng']);
        $val        = 0;

        if(isset($cart->id))
        {
            if($distance <= $store->fix_km)
            {
                $val = $store->fix_amount;
            }
            else
            {
                $bal = $distance - $store->fix_km;
                $val = $bal * $store->per_km;
                $val = $store->fix_amount + $val;
            }
        }
        else
        {
            $val = 0;
        }


        return round($val);
    }

    public function getTotal($cartNo)
    {
        $total = [];
        $res = Cart::where('cart_no',$cartNo)->get();
        foreach($res as $row)
        {
            $total[] = $row->price * $row->qty;

            foreach($this->cartAddon($row->id,$row->item_id) as $addon)
            {
                $total[] = $addon->price * $addon->qty;
            }
        }
        
        return array_sum($total);
    }

    public function distance($lat1, $lon1, $lat2, $lon2) 
    { 
        $pi80 = M_PI / 180; 
        $lat1 *= $pi80; 
        $lon1 *= $pi80; 
        $lat2 *= $pi80; 
        $lon2 *= $pi80; 
        $r = 6372.797; // mean radius of Earth in km 
        $dlat = $lat2 - $lat1; 
        $dlon = $lon2 - $lon1; 
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
        $km = $r * $c; 
        return ceil($km); 
    }

    public function checkStock()
    {
        $error = [];

        if(isset($_GET['cart_no']) && $_GET['cart_no'] > 0)
        {
            foreach(Cart::where('cart_no',$_GET['cart_no'])->get() as $cart)
            {
                $store = new Store;

                if(!$store->hasStock($cart->item_id))
                {
                    $cart->delete();
                    
                    $error[] = 1;
                }
            }
        }

        return count($error) > 0 ? false : true;
    }
}
