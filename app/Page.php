<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class Page extends Authenticatable
{
    protected $table = "page";

    public function addNew($data)
    {
        $a                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_about_us']) : [];
        $b                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_faq']) : [];
        $c                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_contact_us']) : [];

        $add                = Page::find(1);
        $add->about_us      = isset($data['about_us']) ? $data['about_us'] : null;
        $add->faq           = isset($data['faq']) ? $data['faq'] : null;
        $add->contact_us    = isset($data['contact_us']) ? $data['contact_us'] : null;
        $add->s_data        = serialize([$a,$b,$c]);

        if(isset($data['done_img']))
        {
            $filename   = time().rand(111,699).'.' .$data['done_img']->getClientOriginalExtension(); 
            $data['done_img']->move("upload/page/", $filename);   
            $add->done_img = $filename;   
        }

        $add->save();
    }

    public function getAppData()
    {
        $res  = Page::find(1);
        $lang = new Language;
        $lid  = $lang->getLang();

        $about          = $lid > 0 ? $this->getSData($res->s_data,$lid,0) : $res->about_us;
        $contact_us     = $lid > 0 ? $this->getSData($res->s_data,$lid,1) : $res->contact_us;
        $faq            = $lid > 0 ? $this->getSData($res->s_data,$lid,2) : $res->faq;
        
        $data = [

        'about_us'        => $about,
        'faq'             => $faq,
        'contact_us'      => $contact_us,

        ];

        return $data;
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);

        return isset($data[$field][$id]) ? $data[$field][$id] : null;
    }
}
