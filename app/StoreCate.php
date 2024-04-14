<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class StoreCate extends Authenticatable
{
    protected $table = "store_cate";

    public function addNew($data,$id)
    {
        $cate_id = isset($data['cate_id']) ? $data['cate_id'] : [];

        StoreCate::where('store_id',$id)->delete();

        for($i=0;$i<count($cate_id);$i++)
        {
            $add            = new StoreCate;
            $add->store_id  = $id;
            $add->cate_id   = $cate_id[$i];
            $add->Save();
        }
    }
}
