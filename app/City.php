<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
class City extends Authenticatable
{
    protected $table = "city";
  
    /*
    |--------------------------------
    |Create/Update user
    |--------------------------------
    */

    public function addNew($data,$type)
    {
        $a                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_name']) : [];
        $add                = $type === 'add' ? new City : City::find($type);
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->status        = isset($data['status']) ? $data['status'] : null;
        $add->sort_no       = isset($data['sort_no']) ? $data['sort_no'] : 0;
        $add->s_data        = serialize($a);
        $add->save();
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($status = "all",$ids = [])
    {
        return City::where(function($query) use($status,$ids){

            if($status !== "all")
            {
                $query->where('status',$status);
            }

            if(is_array($ids) && count($ids) > 0)
            {
                $query->whereIn('id',$ids);
            }

        })->orderBy('sort_no','ASC')->get();
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);

        return isset($data[$id]) ? $data[$id] : null;
    }

    public function getAppData($ids = [])
    {
        $data = [];

        foreach($this->getAll(0,$ids) as $row)
        {
            $data[] = [

            'id'    => $row->id,
            'name'  => $this->getLang($row->id)['name'],

            ];
        }

        return $data;
    }

    public function getLang($id)
    {
        $lang = new Language;
        $lid  = $lang->getLang();
        $data = City::find($id);

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
