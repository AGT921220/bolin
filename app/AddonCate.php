<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
class AddonCate extends Authenticatable
{
    protected $table = "addon_cate";

     /*
    |--------------------------------------
    |Add/Update Data
    |--------------------------------------
    */
    public function addNew($data,$addon)
    {
        $a                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_name']) : [];
        $add                = $addon === 'add' ? new AddonCate : AddonCate::find($addon);
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->store_id      = Auth::guard('store')->user()->id;
        $add->sort_order    = isset($data['sort_order']) ? $data['sort_order'] : 0;
        $add->type          = isset($data['type']) ? $data['type'] : 0;
        $add->req           = isset($data['req']) ? $data['req'] : 0;
        $add->s_data        = serialize($a);
        $add->save();
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll()
    {
        return AddonCate::where('store_id',Auth::guard('store')->user()->id)->orderBy('id','DESC')->get();
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);

        return isset($data[$id]) ? $data[$id] : null;
    }

    public function getLang($id)
    {
        $lang = new Language;
        $lid  = $lang->getLang();
        $data = AddonCate::find($id);

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
