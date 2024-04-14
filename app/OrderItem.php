<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
class OrderItem extends Authenticatable
{
   protected $table = 'order_item';

   public function addNew($id,$cartNo)
   {
      $res = Cart::where('cart_no',$cartNo)->get();
      foreach($res as $row)
      {
        $order              = Order::find($id);
        $add                = new OrderItem;
        $add->order_id      = $id;
        $add->item_id       = $row->item_id;
        $add->price         = $row->price;
        $add->qty           = $row->qty;
        $add->qty_type      = $row->qty_type;
        $add->save();

        //inventory

        if(Item::find($row->item_id)->inv == 1)
        {
          $inv            = new Inv;
          $inv->item_id   = $row->item_id;
          $inv->order_id  = $id;
          $inv->qty       = $row->qty;
          $inv->type      = 1;
          $inv->save();
        }

        foreach(CartAddon::where('cart_id',$row->id)->get() as $ca)
        {
            $addC             = new OrderAddon;
            $addC->order_id   = $id;
            $addC->item_id    = $ca->item_id;
            $addC->addon_id   = $ca->addon_id;
            $addC->qty        = 1;
            $addC->save();
        }

        CartAddon::where('cart_id',$row->id)->delete();
      }
   }

   public function addPos($data,$id)
   {
     $item_id = isset($data['item_id']) ? $data['item_id'] : [];
     $qty     = isset($data['qty']) ? $data['qty'] : [];
     $type    = isset($data['qty_type']) ? $data['qty_type'] : [];
     $price   = isset($data['price']) ? $data['price'] : [];

     OrderItem::where('order_id',$id)->delete();
     OrderAddon::where('order_id',$id)->delete();

     for($i = 0;$i<count($item_id);$i++)
     {
        $add                = new OrderItem;
        $add->order_id      = $id;
        $add->item_id       = $item_id[$i];
        $add->price         = $price[$i];
        $add->qty           = $qty[$i];
        $add->qty_type      = $type[$i];
        $add->save();

        $addon = isset($data['addon_id_'.$item_id[$i]]) ? $data['addon_id_'.$item_id[$i]] : [];

        for($a = 0;$a<count($addon);$a++)
        {
            $addC             = new OrderAddon;
            $addC->order_id   = $id;
            $addC->item_id    = $item_id[$i];
            $addC->addon_id   = $addon[$a];
            $addC->qty        = 1;
            $addC->save();
        }
     }
   }

   public function getItem($id)
   {
     $res = OrderItem::join('item','order_item.item_id','=','item.id')
                     ->select('item.name as item','order_item.*','item.unit1','item.unit2','item.unit3')
                     ->where('order_item.order_id',$id)->get();
     $data = [];

     foreach($res as $row)
     {
        if($row->qty_type == 1)
        {
          $type = $row->unit1;
        }
        elseif($row->qty_type == 2)
        {
          $type = $row->unit2;
        }
        else
        {
          $type = $row->unit3;
        }

        $u   = new Item;
        $lid = isset($_GET['lid']) ? $_GET['lid'] : 0;

        $data[] = [

        'item'    => $u->getLang($row->item_id)['name'],
        'price'   => $row->price,
        'qty'     => $row->qty,
        'type'    => $type,
        'id'      => $row->item_id,
        'addon'   => $this->getAddon($row->item_id,$row->order_id),
        'qty_type' => $row->qty_type
        
        ];
     }

     return $data;
   }

   public function getAddon($id,$oid)
   {
      return OrderAddon::join('addon','order_addon.addon_id','=','addon.id')
                       ->select('addon.name as addon','order_addon.*','addon.price')
                       ->where('order_addon.item_id',$id)
                       ->where('order_addon.order_id',$oid)
                       ->get();
   }

   public function editOrder($data,$id)
   {
      OrderItem::where('order_id',$id)->delete();

      $item = isset($data['item_id']) ? $data['item_id'] : [];
      $unit = isset($data['unit']) ? $data['unit'] : [];
      $qty  = isset($data['qty']) ? $data['qty'] : [];

      for($i=0;$i<count($item);$i++)
      {
          $it = Item::find($item[$i]);

          if($unit[$i] == 1)
          {
            $price = $it->small_price;
          }
          elseif($unit[$i] == 2)
          {
            $price = $it->medium_price;
          }
          else
          {
            $price = $it->large_price;
          }

          $add              = new OrderItem;
          $add->order_id    = $id;
          $add->item_id     = $item[$i];
          $add->qty         = $qty[$i];
          $add->qty_type    = $unit[$i];
          $add->price       = $price;
          $add->save();
      }
   }

   public function getTotal($id)
   {
      $count = [];

      foreach($this->detail($id) as $i)
      {
        $count[] = $i->price * $i->qty;
      }

      return array_sum($count);
   }

   public function detail($id)
   {
      return OrderItem::join('item','order_item.item_id','=','item.id')
                     ->select('item.name as item','order_item.*')
                     ->where('order_item.order_id',$id)->get();
   }
}
