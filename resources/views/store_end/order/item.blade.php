<style type="text/css">

.c
{
  margin-top: 20px;
}  

</style>

<div class="row">
<div class="col-md-12">
<select name="cate_id[]" class="form-control select2" onchange="filterData(this.value,{{ $all }})">
<option value="">@lang('app.search_item')</option>
@foreach($items as $it)
<option value="{{ $it['id'] }}">{{ $it['name'] }} - {{ $c.$it['price'] }}</option>
@endforeach
</select>
</div>
</div>
<br>
<div>

<a href="javascript::void()" onClick="filterData(0,{{ $all }},0)">
<div class="chip chip-primary mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.all_item')</span>
</div>
</div>
</a>

@foreach($cate as $ct)

<a href="javascript::void()" onClick="filterData(0,{{ $all }},{{ $ct['id'] }})">
<div class="chip chip-success mr-1">
<div class="chip-body">
<span class="chip-text">{{ $ct['name'] }}</span>
</div>
</div>
</a>
@endforeach
</div>

<div class="row" style="height: 500px;overflow-y: scroll;">

@foreach($items as $item)

<div class="col-md-2 c" id="item_id_{{ $item['id'] }}">
<img src="{{ $item['img'] }}" width="100%">

<span style="display: block;margin-top: 10px;font-size: 14px">{{ $item['name'] }}</span>

@if($item['count'] == 1)

<div class="row" style="margin-top: 5px;font-size: 14px">
<div class="col-md-6">{{ $c.$item['price'] }}</div>
<div class="col-md-6">
@if($item['stock'])
<a href="javascript::void()" onClick="addItem({{ json_encode($item) }},{{ $item['price'] }},0)">
<div class="chip chip-primary mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.add')</span>
</div>
</div>
</a>
@else
<small style="color:red;font-size: 10px">Out of stock</small>
@endif
</div>
</div>

 
@elseif($item['count'] > 1)

<div class="row" style="margin-top: 5px;font-size: 14px">
<div class="col-md-6">{{ $c.$item['price'] }}</div>
<div class="col-md-6">
@if($item['stock'])
<a data-toggle="modal" data-placement="top" href="javascript::void()" data-target="#addon{{ $item['id'] }}">
<div class="chip chip-primary mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.add')</span>
</div>
</div>
</a>
@else
<small style="color:red;font-size: 10px">Out of stock</small>
@endif
</div>
</div>

@endif

</div>

@include('store_end.order.addon')

@endforeach
  
</div>
<script type="text/javascript">

function filterData(item_id,all,cate_id = 0)
{
  for(var i =0;i<all.length;i++)
  {           
    if(item_id > 0 && cate_id == 0 || item_id == 0 && cate_id > 0)
    {
      var tr      = document.getElementById("item_id_"+all[i].id); 
      var att     = document.createAttribute("style");
      att.value   = "display:none";
      tr.setAttributeNode(att);
    }
    else
    {
      var trial  = document.getElementById("item_id_"+all[i].id); 
      trial.removeAttribute("style");
    }
  }

   if(item_id > 0 && cate_id == 0)
   {
     var trial  = document.getElementById("item_id_"+item_id); 
     trial.removeAttribute("style");
   }
   else if(cate_id > 0 && item_id == 0)
   {      
     for(var i = 0;i<all.length;i++)
     {
       if(all[i].cate_id == cate_id)
       {
         var trial  = document.getElementById("item_id_"+all[i].id); 
         trial.removeAttribute("style");
       }
     }
   }
}

function showAll(all)
{
  for(var i =0;i<all.length;i++)
  {           
    var trial  = document.getElementById("item_id_"+all[i].id); 
    trial.removeAttribute("style");
  }

  var show      = document.getElementById("show"); 
  var att     = document.createAttribute("style");
  att.value   = "display:none";
  show.setAttributeNode(att);
}

</script>