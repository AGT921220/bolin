<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
use Excel;
class Inv extends Authenticatable
{
    protected $table = "inv";
    
    public function addNew($data)
    {
        $res            = new Inv;
        $res->item_id   = $data['id'];
        $res->qty       = $data['qty'];
        $res->type      = $data['type'];
        $res->notes     = isset($data['notes']) ? $data['notes'] : null;
        $res->save();
    }

    public function getAll($id)
    {
        return Inv::where('from_order',0)->where('item_id',$id)->orderBy('id','DESC')->get();
    }

}
