<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
use Excel;
class Address extends Authenticatable
{
    protected $table = "address";
    
    public function addNew($data)
    {
        $address          = $data['address'];

        if(isset($data['landmark']))
        {
            $address .= " - ".$data['landmark'];
        }

        $add              = new Address;
        $add->user_id     = $data['user_id'];
        $add->lat         = $data['lat'];
        $add->lng         = $data['lng'];
        $add->address     = $address;
        $add->save();
    }

}
