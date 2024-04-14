<div class="row">
<div class="col-md-9">

<div class="card">
<div class="card-content">
<div class="card-body">
<h4 class="card-title">@lang('app.select_item')

<a href="{{ Asset(env('store').'/home') }}" style="float: right;font-size: 16px"><i class="fa fa-undo"></i> @lang('app.go_back')</a>

</h4>

@include('store_end.order.item')

</div>
</div>
</div>
</div>

<div class="col-md-3">

<div class="card">
<div class="card-content">
<div class="card-body">
<h4 class="card-title">@lang('app.selected_item')</h4>

@if(isset($edit))
@php($item_total = [])
@foreach($edit as $row)
@php($item_total[] = $row['price'] * $row['qty'])
<input type="hidden" name="item_id[]" value="{{ $row['id'] }}">
<input type="hidden" name="qty_type[]" value="{{ $row['qty_type'] }}">

<div class="row cartClass" id="cart_{{ $row['id'] }}">

<div class="col-md-6">{{ $row['item'] }}</div>
<div class="col-md-2"><input type="text" name="qty[]" value="{{ $row['qty'] }}" class='cartInput' onKeyup='calTotal()'></div>
<div class='col-md-2'><input type='text' name='price[]' value="{{ $row['price'] }}" class='cartInput' onKeyup='calTotal()'></div>
<div class='col-md-2'><a href='javascript::void()' onClick="removeItem(cart_{{ $row['id'] }})" class='cartRemove'><i class='fa fa-times'></i></a></div>
</div>

@foreach($row['addon'] as $addon)
<input type="hidden" name="addon_id_{{ $addon->addon_id }}[]" value="{{ $row['id'] }}">

<div class="row cartClass" id="cart_{{ $addon->addon_id }}">

<div class="col-md-6">{{ $addon->addon }}</div>
<div class="col-md-2"><input type="text" name="qty[]" value="{{ $addon->qty }}" class='cartInput' onKeyup='calTotal()'></div>
<div class='col-md-2'><input type='text' name='price[]' value="{{ $addon->price }}" class='cartInput' onKeyup='calTotal()'></div>
<div class='col-md-2'><a href='javascript::void()' onClick="removeItem(cart_{{ $addon->addon_id }})" class='cartRemove'><i class='fa fa-times'></i></a></div>
</div>
@endforeach

@endforeach

@endif

<div id="myList" style="font-size: 12px">

</div>

<div class="row" style="margin-bottom: 10px">
<div class="col-md-8"><b>@lang('app.total_amount')</b></div>
@if(isset($edit))
<div class="col-md-4" id="total" style="font-size: 14px;">{{ $c.array_sum($item_total) }}</div>
@else
<div class="col-md-4" id="total" style="font-size: 14px;"></div>
@endif
</div>

</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<h4 class="card-title">@lang('app.cust_detail')</h4>
<br>

<div class="row" style="margin-bottom: 10px">
<div class="col-md-12"><input type="text" name="name" class="form-control" required="required" placeholder="Name" value="{{ $data->name }}"></div>
</div>

<div class="row" style="margin-bottom: 10px">
<div class="col-md-12"><input type="text" name="phone" class="form-control" required="required" placeholder="Phone" value="{{ $data->phone }}"></div>
</div>

<div class="row" style="margin-bottom: 10px">
<div class="col-md-12">
<select name="otype" class="form-control" onchange="showField(this.value)">
<option value="2" @if($data->type == 2) selected @endif>@lang('app.pickup_dinein')</option>
<option value="1" @if($data->type == 1) selected @endif>@lang('app.delivery')</option>
</select>
</div>
</div>

<div class="row" @if(!isset($edit)) style="margin-bottom: 20px;display: none" @endif id="address">
<div class="col-md-12"><input type="text" name="address" class="form-control" placeholder="@lang('app.d_address')" value="{{ $data->address }}"></div>
</div>

<div class="row" style="margin-bottom: 10px">
<div class="col-md-12"><input type="text" name="notes" class="form-control" placeholder="@lang('app.onotes')" value="{{ $data->notes }}"></div>
</div>

<div class="row" style="margin-bottom: 10px;margin-top: 20px">
<div class="col-md-8"><b>@lang('app.odiscount')</b></div>
<div class="col-md-4"><input type="number" id="discount" name="discount" class="form-control" onkeyup="calTotal()" value="{{ $data->discount }}"></div>
</div>

<div class="row" @if(!isset($edit)) style="display: none" @endif id="delivery">
<div class="col-md-8"><b>@lang('app.d_charges')</b></div>
<div class="col-md-4"><input type="number" id="d_charges" name="d_charges" class="form-control" onkeyup="calTotal()" value="{{ $data->d_charges }}"></div>
</div>

<div class="row" style="margin-bottom: 10px;margin-top: 20px">
<div class="col-md-8"><b>@lang('app.gtotal')</b></div>
@if(isset($edit))
<div class="col-md-4" id="grand" style="font-size: 18px;font-weight: bold">{{ $c.$data->total }}</div>

@else
<div class="col-md-4" id="grand" style="font-size: 18px;font-weight: bold"></div>
@endif
</div>

<input type="hidden" name="total_amount" id="total_amount" @if(isset($edit)) value="{{ $data->total }}" @endif>

<div class="row" style="margin-bottom: 10px;margin-top: 20px">
<div class="col-md-8"><button type="submit" class="btn btn-success">@lang('app.add_order')</button></div>
</div>

</div>
</div>
</div>


</div>
</div>

@include('store_end.order.js')