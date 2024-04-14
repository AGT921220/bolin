<div class="modal fade text-left" id="addon{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header bg-primary">
<h4 class="modal-title" id="myModalLabel33">@lang('app.select_option')</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div class="row" style="margin-top: 20px">

@if($item['s_price'])
<div class="col-xl-4">
<input type="radio" name="option_{{ $item['id'] }}" value="1" class="vs-radio-lg">
{{ $item['unit1'] }} - {{ $c.$item['s_price'] }}
</div>
@endif

@if($item['m_price'])
<div class="col-xl-4">
<input type="radio" name="option_{{ $item['id'] }}" value="2" class="vs-radio-lg">
{{ $item['unit2'] }} - {{ $c.$item['m_price'] }}
</div>
@endif

@if($item['l_price'])
<div class="col-xl-4">
<input type="radio" name="option_{{ $item['id'] }}" value="3" class="vs-radio-lg">
{{ $item['unit3'] }} - {{ $c.$item['l_price'] }}
</div>
@endif
</div>

@if(count($item['addon']) > 0)
<br>
<h4>Addon's</h4>

@foreach($item['addon'] as $addonCate)

<div class="row" style="margin-bottom: 20px">

<div class="col-xl-12" style="color:blue;margin-bottom: 10px;margin-top: 10px">{{ $addonCate['name'] }} 

@if($addonCate['req'] == 1)<small style="color:red">@lang('app.select_one')</small>@endif

</div>

@if($addonCate['type'] == 0)

@foreach($addonCate['item'] as $addonItem)

<div class="col-xl-4"><input type="checkbox" class="addon_{{ $item['id'] }}" name="chk_{{ $item['id'] }}[]" value="{{ $addonItem['id'] }},{{ $addonItem['name'] }},{{ $addonItem['price'] }}"> {{ $addonItem['name'] }} - {{ $c.$addonItem['price'] }}</div>

@endforeach

@endif


@if($addonCate['type'] == 1)

@foreach($addonCate['item'] as $addonItem)

<div class="col-xl-4"><input type="radio"  class="addon_{{ $item['id'] }}" name="radio_{{ $item['id'] }}_{{ $addonCate['id'] }}[]" value="{{ $addonItem['id'] }},{{ $addonItem['name'] }},{{ $addonItem['price'] }}"> {{ $addonItem['name'] }} - {{ $c.$addonItem['price'] }}</div>

@endforeach

@endif

</div>

@endforeach

@endif
</div>

<div class="modal-footer">
<button type="button" class="btn btn-primary" onClick="addonData({{ json_encode($item) }},{{ $item['id'] }})" data-dismiss="modal">@lang('app.add')</button>
</div>

</div>
</div>
</div>