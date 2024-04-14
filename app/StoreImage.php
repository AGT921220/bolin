<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
class StoreImage extends Authenticatable
{
    protected $table = "store_image";

    public function addNew($data,$id)
    {
        $img = isset($data['gallery']) ? $data['gallery'] : [];

        for($i=0;$i<count($img);$i++)
        {
            $add            = new StoreImage;
            $add->store_id  = $id;
            
            if(isset($img[$i]))
            {
                $filename   = time().rand(111,699).'.' .$img[$i]->getClientOriginalExtension(); 
                $img[$i]->move("upload/store/gallery/", $filename);   
                $add->img = $filename;   
            }

            $add->save();
        }
    }
}
