<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
class ItemAddon extends Authenticatable
{
    protected $table = "item_addon";

    public function addNew($data)
    {
        ItemAddon::where('item_id',$data['id'])->delete();

        $a = isset($data['chk']) ? $data['chk'] : [];

        for($i=0;$i<count($a);$i++)
        {
            $add            = new ItemAddon;
            $add->item_id   = $data['id'];
            $add->addon_id  = $a[$i];
            $add->save();
        }
    }

    public function getAssigned($id)
    {
        return ItemAddon::where('item_id',$id)->pluck('addon_id')->toArray();
    }

    public function getLang($id)
    {
        $lang = new Language;
        $lid  = $lang->getLang();
        $data = Addon::find($id);

        if($lid == 0)
        {
            return ['name' => $data->name];
        }
        else
        {
            $data = unserialize($data->s_data);

            return ['name' => isset($data[$lid]) ? $data[$lid] : null];
        }
    }
}
