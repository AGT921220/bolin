<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class Slider extends Authenticatable
{
    protected $table = "slider";

     /*
    |--------------------------------------
    |Add/Update Data
    |--------------------------------------
    */
    public function addNew($data,$type)
    {
        $add                = $type === 'add' ? new Slider : Slider::find($type);
        $add->sort_no       = isset($data['sort_no']) ? $data['sort_no'] : 0;
        $add->link_to       = isset($data['link_to']) ? $data['link_to'] : 0;
        $add->link_id       = isset($data['link_id']) ? $data['link_id'] : 0;
        $add->type          = isset($data['type']) ? $data['type'] : 0;

        if(isset($data['img']))
        {
            $filename   = time().rand(111,699).'.' .$data['img']->getClientOriginalExtension(); 
            $data['img']->move("upload/slider/", $filename);   
            $add->img = $filename;   
        }

        $add->save();
    }

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($type = "all")
    {
        return Slider::where(function($query) use($type){

        if($type !== "all")
        {
            $query->where('type',$type)->where('status',0);
        }

        })->orderBy('sort_no','ASC')->get();
    }

    public function getAppData($type)
    {
        $data = [];

        foreach($this->getAll($type) as $row)
        {
            $data[] = [

            'img'       => Asset('upload/slider/'.$row->img),
            'link_to'   => $row->link_to,
            'link_id'   => $row->link_id

            ];
        }

        return $data;
    }

    public function getLink($link)
    {
        if($link == 0)
        {
            $return = \Lang::get('app.none');
        }
        elseif($link == 1)
        {
            $return = \Lang::get('app.store');
        }
        elseif($link == 2)
        {
            $return = \Lang::get('app.category');
        }
        elseif($link == 3)
        {
            $return = \Lang::get('app.custom');
        }
        
        return $return;
    }

    public function getType($type)
    {
        return $type == 0 ? "Slider" : "Static Banner";
    }
}
