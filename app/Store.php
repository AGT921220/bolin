<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Auth;
use DB;
class Store extends Authenticatable
{
    protected $table = "store";

    public function addNew($data,$type,$status = 0)
    {
        $a                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_name']) : [];
        $b                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_address']) : [];
        $c                  = isset($data['lid']) ? array_combine($data['lid'], $data['l_tax']) : [];
        $add                = $type == "add" ? new Store : Store::find($type);
        $add->city_id       = isset($data['city_id']) ? $data['city_id'] : 0;
        $add->name          = isset($data['name']) ? $data['name'] : null;
        $add->phone         = isset($data['phone']) ? $data['phone'] : null;
        $add->status        = $status;
        
        if(isset($data['password']))
        {
            $add->password         = bcrypt($data['password']);
            $add->shw_password     = $data['password'];
        }

        $add->address               = isset($data['address']) ? $data['address'] : null;
        $add->whatsapp              = isset($data['whatsapp']) ? $data['whatsapp'] : null;
        $add->whatsapp_new_order    = isset($data['whatsapp_new_order']) ? $data['whatsapp_new_order'] : 0;
        $add->per_person_cost       = isset($data['per_person_cost']) ? $data['per_person_cost'] : null;
        $add->delivery_time         = isset($data['delivery_time']) ? $data['delivery_time'] : null;
        $add->unit                  = isset($data['unit']) ? $data['unit'] : null;
        $add->s_open_time           = isset($data['s_open_time']) ? $data['s_open_time'] : null;
        $add->s_close_time          = isset($data['s_close_time']) ? $data['s_close_time'] : null;
        $add->m_open_time           = isset($data['m_open_time']) ? $data['m_open_time'] : null;
        $add->m_close_time          = isset($data['m_close_time']) ? $data['m_close_time'] : null;
        $add->t_open_time           = isset($data['t_open_time']) ? $data['t_open_time'] : null;
        $add->t_close_time          = isset($data['t_close_time']) ? $data['t_close_time'] : null;
        $add->w_open_time           = isset($data['w_open_time']) ? $data['w_open_time'] : null;
        $add->w_close_time          = isset($data['w_close_time']) ? $data['w_close_time'] : null;
        $add->th_open_time          = isset($data['th_open_time']) ? $data['th_open_time'] : null;
        $add->th_close_time         = isset($data['th_close_time']) ? $data['th_close_time'] : null;
        $add->f_open_time           = isset($data['f_open_time']) ? $data['f_open_time'] : null;
        $add->f_close_time          = isset($data['f_close_time']) ? $data['f_close_time'] : null;
        $add->st_open_time          = isset($data['st_open_time']) ? $data['st_open_time'] : null;
        $add->st_close_time         = isset($data['st_close_time']) ? $data['st_close_time'] : null;
        $add->delivery_by           = isset($data['delivery_by']) ? $data['delivery_by'] : null;
        $add->fix_km                = isset($data['fix_km']) ? $data['fix_km'] : null;
        $add->fix_amount            = isset($data['fix_amount']) ? $data['fix_amount'] : null;
        $add->per_km                = isset($data['per_km']) ? $data['per_km'] : null;
        $add->max_km                = isset($data['max_km']) ? $data['max_km'] : null;
        $add->lat                   = isset($data['lat']) ? $data['lat'] : null;
        $add->lng                   = isset($data['lng']) ? $data['lng'] : null;
        $add->cod                   = isset($data['cod']) ? $data['cod'] : 0;
        $add->razor_key             = isset($data['razor_key']) ? $data['razor_key'] : null;
        $add->stripe_key            = isset($data['stripe_key']) ? $data['stripe_key'] : null;
        $add->stripe_skey           = isset($data['stripe_skey']) ? $data['stripe_skey'] : null;
        $add->chat                  = isset($data['chat']) ? $data['chat'] : 0;
        $add->print_type            = isset($data['print_type']) ? $data['print_type'] : 0;
        $add->delivery              = isset($data['delivery']) ? $data['delivery'] : 0;
        $add->dinein                = isset($data['dinein']) ? $data['dinein'] : 0;
        $add->tax_name              = isset($data['tax_name']) ? $data['tax_name'] : null;
        $add->tax_value             = isset($data['tax_value']) ? $data['tax_value'] : null;
        $add->s_data                = serialize([$a,$b,$c]);

        if(isset($data['com_type']))
        {
            $add->com_value          = isset($data['com_value']) ? $data['com_value'] : null;
            $add->com_value          = isset($data['com_value']) ? $data['com_value'] : null;
        }

        if(isset($data['img']))
        {
            $filename   = time().rand(111,699).'.' .$data['img']->getClientOriginalExtension(); 
            $data['img']->move("upload/store/", $filename);   
            $add->img = $filename;   
        }

        $add->save();

        $cate = new StoreCate;
        $cate->addNew($data,$add->id);

        $img = new StoreImage;
        $img->addNew($data,$add->id);

        $menu = new StoreMenu;
        $menu->addNew($data,$add->id);

    }

    public function getAll()
    {
        return Store::leftjoin('plan','store.plan_id','=','plan.id')
                    ->select('store.*','plan.name as plan')
                    ->orderBy('store.id','DESC')->get();
                    
    }

    public function getSData($data,$id,$field)
    {
        $data = unserialize($data);
 
        return isset($data[$field][$id]) ? $data[$field][$id] : null;
    }

    public function getAppData($trend = 0)
    {
        $data  = [];
        $lat   = isset($_GET['lat']) ? $_GET['lat'] : 0;
        $lon   = isset($_GET['lng']) ? $_GET['lng'] : 0;
        $admin = User::find(1);
        $res   = Store::where(function($query) use($trend){

                if($trend > 0)
                {
                    $query->where('trend',1);
                }

                if(isset($_GET['cate_id']) && $_GET['cate_id'] > 0 && $trend == 0)
                {
                    $sid = StoreCate::where('cate_id',$_GET['cate_id'])->pluck('store_id')->toArray();
                    $query->whereIn('id',$sid);
                }

                $query->where('status',0);

                if(isset($_GET['store_type']))
                {
                    if($_GET['store_type'] == 0)
                    {
                        $query->where('delivery',0);
                    }
                    elseif($_GET['store_type'] == 1)
                    {
                        $query->where('dinein',0);
                    }
                }

              })->select('store.*',DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                * cos(radians(store.lat)) 
                * cos(radians(store.lng) - radians(" . $lon . ")) 
                + sin(radians(" .$lat. ")) 
                * sin(radians(store.lat))) AS distance"))
                ->orderBy('distance','ASC')->get();

        foreach($res as $row)
        {
            $hasPlan = app('App\Http\Controllers\Controller')->hasPlan($row->id);            

            if($row->max_km >= $row->distance || $row->max_km == 0 && $hasPlan->id)
            {
                $totalRate    = Rate::where('store_id',$row->id)->count();
                $totalRateSum = Rate::where('store_id',$row->id)->sum('star');
                
                if($totalRate > 0)
                {
                    $avg          = $totalRateSum / $totalRate;
                }
                else
                {
                    $avg           = 0 ;
                }

                $data[] = [

                'id'         => $row->id,
                'name'       => $this->getLang($row->id)['name'],
                'address'    => $this->getLang($row->id)['address'],
                'open'       => $this->storeOpen($row),
                'img'        => Asset("upload/store/".$row->img),
                'cates'      => $this->storeCate($row->id),
                'dtime'      => $row->delivery_time,
                'km'         => number_format($row->distance,1),
                'rating'     => $avg > 0 ? number_format($avg, 1) : '0.0',
                'price'      => $row->per_person_cost,
                'currency'   => $admin->currency

                ];
            }
        }

        return $data;
    }

    public function getRating($id)
    {
        $res =  Rate::join('app_user','rate.user_id','=','app_user.id')
                   ->select('app_user.name as user','rate.*')
                   ->where('rate.store_id',$id)
                   ->orderBy('rate.id','DESC')
                   ->get();
        $data = [];

        foreach($res as $row)
        {
            $data[] = ['user' => $row->user,'star' => $row->star,'comment' => $row->comment,'date' => date('d-M-Y',strtotime($row->created_at))];
        }

        return $data;
    }

    public function storeOpen($row)
    {
        $time  = date('H:i:s');

        $day   = date('D');

        if($day == "Sun")
        {
            $openTime  = $row->s_open_time;
            $closeTime = $row->s_close_time;
        }
        elseif($day == "Mon")
        {
            $openTime  = $row->m_open_time;
            $closeTime = $row->m_close_time;
        }
        elseif($day == "Tue")
        {
            $openTime  = $row->t_open_time;
            $closeTime = $row->t_close_time;
        }
        elseif($day == "Wed")
        {
            $openTime  = $row->w_open_time;
            $closeTime = $row->w_close_time;
        }
        elseif($day == "Thu")
        {
            $openTime  = $row->th_open_time;
            $closeTime = $row->th_close_time;
        }
        elseif($day == "Fri")
        {
            $openTime  = $row->f_open_time;
            $closeTime = $row->f_close_time;
        }
        elseif($day == "Sat")
        {
            $openTime  = $row->st_open_time;
            $closeTime = $row->st_close_time;
        }

        $openTime  = date("H:i:s",strtotime($openTime));
        $closeTime = date("H:i:s",strtotime($closeTime));

        if($time >= $openTime && $time <= $closeTime)
        {
            if($row->open == 0)
            {
                $open = true;
            }
            else
            {
                $open = false;
            }
        }
        else
        {
            $open = false;
        }

        return $open;
    }

    public function storeCate($id)
    {
        $ids = StoreCate::where('store_id',$id)->pluck('cate_id')->toArray();

        $cate = Cate::whereIn('id',$ids)->pluck('name')->toArray();

        return implode(" | ", $cate);
    }

    public function getLang($id)
    {
        $lang = new Language;
        $lid  = $lang->getLang();
        $data = Store::find($id);

        if($lid == 0)
        {
            return ['name' => $data->name,'address' => $data->address,'tax' => $data->tax_name];
        }
        else
        {
                        return ['name' => $data->name,'address' => $data->address,'tax' => $data->tax_name];
            $data = unserialize($data->s_data);

            return ['name' => $data[0][$lid],'address' => $data[1][$lid],'tax' => $data[2][$lid]];
        }
    }

    public function item($store_id = 0)
    {
        $store_id  = $store_id > 0 ? $store_id : $_GET['store_id'];
        $cateData  = [];
        $itemData  = [];
        $storeData = [];
        $store     = Store::find($store_id);
        $cid       = Item::where('store_id',$store->id)->pluck('category_id')->toArray();
        $cates     = Category::whereIn('id',array_unique($cid))->where('status',0)->orderBy('sort_no','ASC')
                             ->get();

        //Item's category data                   
        foreach($cates as $cate)
        {
            $cateData[] = [

            'id'    => $cate->id,
            'name'  => $cate->getLang($cate->id)['name'],

            ];
        }

        //items data
        $items = Item::where(function($query){

        if(!isset($_GET['for_store']))
        {
            $query->where('status',0);
        }

        })->where('store_id',$store->id)->orderBy('sort_no','ASC')->get();

        $count = [];

        foreach($items as $i)
        {
            if($i->small_price && $i->unit1_status == 0)
            {
                $price = $i->small_price;
                $unit  = $i->unit1;
                $qtype = 1;
            }
            elseif(!$i->small_price || $i->unit1_status == 1 && $i->medium_price && $i->unit2_status == 0)
            {
                $price = $i->medium_price;
                $unit  = $i->unit2;
                $qtype = 2;
            }
            elseif(!$i->small_price || $i->unit1_status == 1 && !$i->medium_price || $i->unit2_status == 1 && $i->unit3_status == 0)
            {
                $price = $i->large_price;
                $unit  = $i->unit3;
                $qtype = 3;
            }

            if($i->small_price && $i->unit1_status == 0)
            {
                $count[] = $i->small_price;
            }

            if($i->medium_price && $i->unit2_status == 0)
            {
                $count[] = $i->medium_price;
            }

            if($i->large_price && $i->unit3_status == 0)
            {
                $count[] = $i->large_price;
            }

            $itemData[] = [

            'id'            => $i->id,
            'name'          => $i->getLang($i->id,$_GET['lid'])['name'],
            'img'           => $i->img ? Asset('upload/item/'.$i->img) : null,
            'desc'          => $i->getLang($i->id,$_GET['lid'])['desc'],
            's_price'       => $i->small_price,
            'm_price'       => $i->medium_price,
            'l_price'       => $i->large_price,
            'price'         => $price,
            'count'         => count($count),
            'unit'          => $unit,
            'qtype'         => $qtype,
            'unit1'         => $i->unit1,
            'unit2'         => $i->unit2,
            'unit3'         => $i->unit3,
            'mrp'           => $i->mrp,
            'cate_id'       => $i->category_id,
            'addon'         => $this->addon($i->id),
            'status'        => $i->status,
            'stock'         => $this->hasStock($i->id)
            ];

            unset($count);
        }

        
        //Store data

        $gallery    = [];

        foreach(StoreImage::where('store_id',$store->id)->get() as $img)
        {
            $gallery[] = [Asset('upload/store/gallery/'.$img->img)];
        }

        $totalRate    = Rate::where('store_id',$store->id)->count();
        $totalRateSum = Rate::where('store_id',$store->id)->sum('star');
        
        if($totalRate > 0)
        {
            $avg          = $totalRateSum / $totalRate;
        }
        else
        {
            $avg           = 0 ;
        }
        $today     = $this->getTodayOpen($store);

        $menu      = [];

        foreach(StoreMenu::where('store_id',$store->id)->get() as $row)
        {
            $menu[] = [Asset('upload/store/menu/'.$row->file)];
        }

        $storeData = [

        'id'         => $store->id,
        'name'       => $this->getLang($store->id)['name'],
        'address'    => $this->getLang($store->id)['address'],
        'open'       => $this->storeOpen($store),
        'open_time'  => date('h:i:A',strtotime($store->open_time)),
        'close_time' => date('h:i:A',strtotime($store->close_time)),
        'img'        => Asset("upload/store/".$store->img),
        'cates'      => $this->storeCate($store->id),
        'dtime'      => $store->delivery_time,
        'gallery'    => $gallery,
        'per_person' => $store->per_person_cost,
        'phone'      => $store->phone,
        'whatsapp'   => $store->whatsapp,
        'ratings'    => $this->getRating($store->id),
        'rating'     => $avg > 0 ? number_format($avg, 1) : '0.0',
        'lat'        => $store->lat,
        'lng'        => $store->lng,
        'today_open' => $today['open'],
        'today_close' => $today['close'],
        'menu'       => $menu

        ];

        return ['store' => $storeData,'cate' => $cateData,'item' => $itemData];  
    }

    public function getTodayOpen($row)
    {
        $day   = date('D');

        if($day == "Sun")
        {
            $openTime  = $row->s_open_time;
            $closeTime = $row->s_close_time;
        }
        elseif($day == "Mon")
        {
            $openTime  = $row->m_open_time;
            $closeTime = $row->m_close_time;
        }
        elseif($day == "Tue")
        {
            $openTime  = $row->t_open_time;
            $closeTime = $row->t_close_time;
        }
        elseif($day == "Wed")
        {
            $openTime  = $row->w_open_time;
            $closeTime = $row->w_close_time;
        }
        elseif($day == "Thu")
        {
            $openTime  = $row->th_open_time;
            $closeTime = $row->th_close_time;
        }
        elseif($day == "Fri")
        {
            $openTime  = $row->f_open_time;
            $closeTime = $row->f_close_time;
        }
        elseif($day == "Sat")
        {
            $openTime  = $row->st_open_time;
            $closeTime = $row->st_close_time;
        }


        return ['open' => $openTime,'close' => $closeTime];
    }

    public function hasStock($id)
    {
        $row = Item::find($id);

        if($row->inv == 1)
        {
            if($row->getStock($row->id) > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }

    public function addon($id)
    {
       $aid      = ItemAddon::where('item_id',$id)->pluck('addon_id')->toArray();
       $cid      = Addon::whereIn('id',$aid)->pluck('cate_id')->toArray();
       $data     = [];
       $itemData = [];

       foreach(array_unique($cid) as $c)
       {
         $cate = AddonCate::find($c);
         $item = ItemAddon::join('addon','item_addon.addon_id','=','addon.id')
                        ->select('addon.*')
                        ->where('item_addon.item_id',$id)
                        ->where('addon.cate_id',$c)
                        ->get();

        foreach($item as $i)
        {
            $itemData[] = [

            'id'    => $i->id,
            'name'  => $i->getLang($i->id)['name'],
            'price' => $i->price

            ];
        }

        if(isset($cate->id))
        {
            $data[] = [

            'id'    => $c,
            'name'  => $cate->getLang($cate->id)['name'],
            'item'  => $itemData,
            'type'  => $cate->type,
            'req'   => $cate->req
            ];

            unset($itemData);
        }
        
       }
       
       return $data;
    }

    public function overview()
    {
        $weekDate   = date('Y-m-d',strtotime(date('Y-m-d').' - 7 days'));
        $monthDate  = date('Y-m-d',strtotime(date('Y-m-d').' - 30 days'));
        $total      = Order::where('store_id',Auth::guard('store')->user()->id)->count();
        $week       = Order::where('store_id',Auth::guard('store')->user()->id)
                      ->whereDate('created_at','>=',$weekDate)->count();
        $month      = Order::where('store_id',Auth::guard('store')->user()->id)
                      ->whereDate('created_at','>=',$monthDate)->count();

        return [

        'total' => $total,
        'week'  => $week,
        'month' => $month,
        'item'  => Item::where('store_id',Auth::guard('store')->user()->id)->count()

        ];
    }

    public function userSignup($data)
    {
        $chk = Store::where('phone',$data['phone'])->count();

        if($chk > 0)
        {
            return ['msg' => "Sorry! This phone number is already registered with us."];
        }
        else
        {
            $this->addNew($data,"add",1);

            return ['msg' => "done"];
        }
    }

   public function login($data)
   {
     $chk = Store::where('status',0)->where('phone',$data['phone'])->where('shw_password',$data['password'])->first();

     if(isset($chk->id))
     {
        return ['msg' => 'done','user' => $chk];
     }
     else
     {
        return ['msg' => 'Opps! Invalid login details'];
     }
   }

   public function checkPlan($id)
   {
      $store  = Store::find($id);
      $return = 0;

      if($store->plan_id > 0)
      {

        $storePlan = StorePlan::where('store_id',$id)->where('plan_id',$store->plan_id)
                              ->orderBy('id','DESC')
                              ->first();

        if(isset($storePlan->id))
        {
            if($storePlan->status == 1 && $store->valid_till >= date('Y-m-d'))
            {
                $return = 1;
            }
            elseif($storePlan->status == 1 && $store->valid_till < date('Y-m-d'))
            {
                $return = 2;
            }
            else
            {
                $return = 3;
            }
        }
      }
      return $return;
   }

   public function signup($data)
   {
        $formData                    = $data['data'];
        $res                         = new Store;
        $res->name                   = $formData['name'];
        $res->phone                  = $formData['phone'];
        $res->address                = $formData['address'];
        $res->password               = bcrypt($formData['password']);
        $res->shw_password           = $formData['password'];
        $res->status                 = 1;
        $res->signup_by              = 1;
        $res->save();

        $plan = new StorePlan;
        $plan->addNew($data['plan_id'],$res->id,$data);

        return ['data' => 'done'];
   }

   public function getSearchData()
   {
        $storeName = Store::where('status',0)->get();
        $storeData = [];

        foreach($storeName as $s)
        {
            $hasPlan = app('App\Http\Controllers\Controller')->hasPlan($s->id);            

            if($hasPlan->id)
            {
                $storeData[] = [

                'id'    => $s->id,
                'name'  => $this->getLang($s->id)['name'],
                'img'   => Asset('upload/store/'.$s->img),
                'item'  => false

                ];
            }
        }

       $itemName = [];
       $itemID   = [];

       foreach(Item::where('status',0)->get() as $it)
       {
         array_push($itemName,$it->getLang($it->id,$_GET['lid'])['name']);
         array_push($itemID,$it->id);
       }

       $id = 0;
       foreach(array_unique($itemName) as $i)
       {
         $storeData[] = [

                'id'    => $itemID[$id],
                'name'  => $i,
                'img'   => Asset('upload/item/'.Item::find($itemID[$id])->img),
                'item'  => true

          ];

          $id++;
       }

        return $storeData;
   }

   public function getSearch()
   {
      $data     = [];
      $name     = Item::find($_GET['item_id'])->name;
      $store_id = [];

      foreach(Item::where('status',0)->where('name',$name)->get() as $i)
      {
        array_push($store_id,$i->store_id);
      }

      $store_id = count($store_id) > 0 ? array_unique($store_id) : [];

      foreach(Store::where('status',0)->whereIn('id',$store_id)->get() as $s)
      {
          $hasPlan = app('App\Http\Controllers\Controller')->hasPlan($s->id);            

            if($hasPlan->id)
            {
                $data[] = [

                'id'      => $s->id,
                'name'    => $this->getLang($s->id)['name'],
                'address' => $this->getLang($s->id)['address'],
                'img'     => Asset('upload/store/'.$s->img),
                'open'    => $this->storeOpen($s),

                ];
            }
      }

      return $data;
   }

   public function getRandom()
   {
      $data = [];

      $res = Store::where(function($query){

        if(isset($_GET['store_type']))
        {
            if($_GET['store_type'] == 0)
            {
                $query->where('delivery',0);
            }
            elseif($_GET['store_type'] == 1)
            {
                $query->where('dinein',0);
            }
        }

      })->where('status',0)->inRandomOrder()->take(5)->get();

      foreach($res as $s)
      {
          $hasPlan = app('App\Http\Controllers\Controller')->hasPlan($s->id);            

            if($hasPlan->id)
            {
                $totalRate    = Rate::where('store_id',$s->id)->count();
                $totalRateSum = Rate::where('store_id',$s->id)->sum('star');
                
                if($totalRate > 0)
                {
                    $avg          = $totalRateSum / $totalRate;
                }
                else
                {
                    $avg           = 0 ;
                }

                $data[] = [

                'id'      => $s->id,
                'name'    => $this->getLang($s->id)['name'],
                'img'     => Asset('upload/store/'.$s->img),
                'open'    => $this->storeOpen($s),
                'cates'   => $this->storeCate($s->id),
                'rating'  => $avg > 0 ? number_format($avg,1) : '0:0'


                ];
            }
      }

      return $data;
   }
}
