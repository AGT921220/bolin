<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class Offer extends Authenticatable
{
    protected $table = "offer";

   

    /*
    |--------------------------------
    |Create/Update city
    |--------------------------------
    */

    public function addNew($data,$type)
    {
        $b                      = isset($data['lid']) ? array_combine($data['lid'], $data['l_desc']) : [];
        $add                    = $type === 'add' ? new Offer : Offer::find($type);
        $add->code              = isset($data['code']) ? $data['code'] : null;
        $add->description       = isset($data['description']) ? $data['description'] : null;
        $add->min_cart_value    = isset($data['min_cart_value']) ? $data['min_cart_value'] : 0;
        $add->upto              = isset($data['upto']) ? $data['upto'] : null;
        $add->type              = isset($data['type']) ? $data['type'] : 0;
        $add->value             = isset($data['value']) ? $data['value'] : 0;
        $add->status            = isset($data['status']) ? $data['status'] : 0;
        $add->discount_type     = isset($data['discount_type']) ? $data['discount_type'] : 0;
        $add->s_data            = serialize($b);
        $add->save();

        $offer = new StoreOffer;
        $offer->addNew($data,$add->id);        
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($store = 0)
    {
        return Offer::orderBy('id','DESC')->get();
    }

    public function getOffer($cartNo)
    {
        $cart = Cart::where('cart_no',$cartNo)->first();
        $id   = StoreOffer::where('store_id',$cart->store_id)->pluck('offer_id')->toArray();
        $res  = Offer::whereIn('id',$id)->where('status',0)->get();
        $data = [];

        foreach($res as $row)
        {
            $data[] = [

            'id'        => $row->id,
            'code'      => $row->code,
            'desc'      => $row->description,
            'min_cart'  => $row->min_cart_value,
            'type'      => $row->type,
            'value'     => $row->value

            ];
        }

        return $data;
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);

        return isset($data[$id]) ? $data[$id] : null;
    }
}
