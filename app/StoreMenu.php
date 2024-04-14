<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
class StoreMenu extends Authenticatable
{
    protected $table = "store_menu";

    public function addNew($data,$id)
    {
        $img = isset($data['menu']) ? $data['menu'] : [];

        for($i=0;$i<count($img);$i++)
        {
            $add            = new StoreMenu;
            $add->store_id  = $id;
            
            if(isset($img[$i]))
            {
                $filename   = time().rand(111,699).'.' .$img[$i]->getClientOriginalExtension(); 
                $img[$i]->move("upload/store/menu/", $filename);   
                $add->file = $filename;   
            }

            $add->save();
        }
    }
}
