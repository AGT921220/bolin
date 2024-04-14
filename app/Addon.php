<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
class Addon extends Authenticatable
{
    protected $table = "addon";

     /*
    |--------------------------------------
    |Add/Update Data
    |--------------------------------------
    */
    public function addNew($data,$addon)
    {
        $a                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_name']) : [];
        $add                = $addon === 'add' ? new Addon : Addon::find($addon);
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->store_id      = Auth::guard('store')->user()->id;
        $add->price         = isset($data['price']) ? $data['price'] : 0;
        $add->cate_id       = isset($data['cate_id']) ? $data['cate_id'] : 0;
        $add->s_data        = serialize($a);
        $add->save();
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($cid = 0)
    {
        return Addon::where(function($query) use($cid){

            if($cid > 0)
            {
                $query->where('addon.cate_id',$cid);
            }

        })->join('addon_cate','addon.cate_id','=','addon_cate.id')
                    ->select('addon_cate.name as cate','addon.*')
                    ->where('addon_cate.store_id',Auth::guard('store')->user()->id)
                    ->orderBy('addon_cate.id','DESC')->get();
        
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);

        return isset($data[$id]) ? $data[$id] : null;
    }

    public function getAllAssign()
    {
        $cate = AddonCate::where('store_id',Auth::guard('store')->user()->id)->orderBy('sort_order','ASC')->get();
        $data = [];

        foreach($cate as $c)
        {
            $data[] = ['name' => $c->name,'item' => $this->getAll($c->id)];
        }

        return $data;
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

            return ['name' => $data[$lid]];
        }
    }
}
