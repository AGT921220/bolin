<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class StoreOffer extends Authenticatable
{
    protected $table = "store_offer";

    public function addNew($data,$id)
    {
        $store_id = isset($data['store_id']) ? $data['store_id'] : [];

        if(count($store_id) == 0 || in_array("all", $store_id))
        {
            $store_id = Store::pluck('id')->toArray();
        }

        StoreOffer::where('offer_id',$id)->delete();

        for($i=0;$i<count($store_id);$i++)
        {
            $add            = new StoreOffer;
            $add->offer_id  = $id;
            $add->store_id  = $store_id[$i];
            $add->Save();
        }
    }
}
