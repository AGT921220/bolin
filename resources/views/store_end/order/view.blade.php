<title>@lang('app.ov_order_detail')</title>

@if(Auth::guard('store')->user()->print_type == 0)

<style type="text/css">
td
{
	padding:10px 10px;
}
</style>

<h1 align="center">@lang('app.ov_order_no') #{{ $data->id }}</h1>
<table width="60%" cellpadding="0" cellspacing="0" border="1" align="center">
<tr>
<td width="40%"><b>@lang('app.ov_order_store')</b></td>
<td width="60%">{{ $data->store }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_user')</b></td>
<td width="60%">{{ $data->name }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_phone')</b></td>
<td width="60%">{{ $data->name }}</td>
</tr>

@if($data->address)
<tr>
<td width="40%"><b>@lang('app.ov_address')</b></td>
<td width="60%">{{ $data->address }}</td>
</tr>
@endif

<tr>
<td width="40%"><b>Order Type</b></td>
<td width="60%">@if($data->type == 1) Delivery @else Pickup/Dinein @endif</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_order_date')</b></td>
<td width="60%">{{ date('d-M-Y h:i:A',strtotime($data->created_at)) }}</td>
</tr>

</table>

<br><br>
<b style="margin-left: 20%;">@lang('app.ov_order_items')</b>
<br><br>
<table width="60%" cellpadding="0" cellspacing="0" border="1" align="center">
<tr>
<td width="15%"><b>@lang('app.ov_s_no')</b></td>
<td width="40%"><b>@lang('app.ov_item')</b></td>
<td width="15%"><b>Price</b></td>
<td width="15%">@lang('app.ov_qty')</b></td>
<td width="15%"><b>@lang('app.ov_total')</b></td>
</tr>
@php($i = 0)
@php($total = [])
@foreach($item->getItem($data->id) as $row)
@php($i++)
@php($total[] = $row['price'] * $row['qty'])
<tr>
<td width="15%">{{ $i }}</td>
<td width="40%">{{ $row['item'] }}</td>
<td width="15%">{{ $c.$row['price'] }}</td>
<td width="15%">{{ $row['qty'] }}</td>
<td width="15%">{{ $c.$row['price'] * $row['qty'] }}</td>
</tr>
@php($a = 0)
@foreach($row['addon'] as $addon)
@php($a++)
@php($total[] = $addon->price * $addon->qty)
<tr>
<td width="15%">{{ $a }}</td>
<td width="40%">{{ $addon->addon }}</td>
<td width="15%">{{ $c.$addon->price }}</td>
<td width="15%">1</td>
<td width="15%">{{ $c.$addon->price * $addon->qty }}</td>
</tr>
@endforeach

@endforeach

<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.ov_sub_total')</b></td>
<td width="15%">{{ $c.array_sum($total) }}</td>
</tr>

@if($data->discount > 0)
<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>Discount</b></td>
<td width="15%">{{ $c.$data->discount }}</td>
</tr>
@endif

@if($data->d_charges > 0)
<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.view_delivery')</b></td>
<td width="15%">{{ $c.$data->d_charges }}</td>
</tr>
@endif

@if($data->d_charges > 0)
<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.ov_delivery_charges')</b></td>
<td width="15%">{{ $c.$data->d_charges }}</td>
</tr>
@endif

<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.ov_grand_total')</b></td>
<td width="15%">{{ $c.$data->total }}</td>
</tr>

<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>Payment Method</b></td>
<td width="15%">

@if($data->payment_method == 1)

Cash on Delivery

@elseif($data->payment_method == 2 || $data->payment_method == 3)

Online Paid

@endif

@if($data->total == $data->ecash)
Paid with eCash
@elseif($data->ecash > 0)
<p>eCash Paid {{ $data->ecash }}</p>
<p>Payable Balance {{ $data->total - $data->ecash }}</p>
@endif

</td>
</tr>

</table>

@else

<!--For thermal printer-->
<table width="272px" border="1" cellspacing="0" cellpadding="0">

<tr>
<td>
<table width="100%" cellpadding="2" cellspacing="2" align="center" style="font-size: 12px">
<tr>
<td width="40%"><b>Order ID</b></td>
<td width="60%">{{ $data->id }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_order_store')</b></td>
<td width="60%">{{ $data->store }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_user')</b></td>
<td width="60%">{{ $data->name }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_phone')</b></td>
<td width="60%">{{ $data->name }}</td>
</tr>

@if($data->address)
<tr>
<td width="40%"><b>@lang('app.ov_address')</b></td>
<td width="60%">{{ $data->address }}</td>
</tr>
@endif

<tr>
<td width="40%"><b>Order Type</b></td>
<td width="60%">@if($data->type == 1) Delivery @else Pickup/Dinein @endif</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.ov_order_date')</b></td>
<td width="60%">{{ date('d-M-Y h:i:A',strtotime($data->created_at)) }}</td>
</tr>

</table>

<hr>

<table width="100%" cellpadding="2" cellspacing="2" style="font-size: 12px">
<tr>
<td width="15%"><b>@lang('app.ov_s_no')</b></td>
<td width="40%"><b>@lang('app.ov_item')</b></td>
<td width="15%">@lang('app.ov_qty')</b></td>
<td width="15%"><b>Price</b></td>

</tr>
@php($i = 0)
@php($total = [])
@foreach($item->getItem($data->id) as $row)
@php($i++)
@php($total[] = $row['price'] * $row['qty'])
<tr>
<td width="10%">{{ $i }}</td>
<td width="60%">{{ $row['item'] }}</td>
<td width="15%">{{ $row['qty'] }}</td>
<td width="15%">{{ $c.$row['price'] }}</td>

</tr>
@php($a = 0)
@foreach($row['addon'] as $addon)
@php($a++)
@php($total[] = $addon->price * $addon->qty)
<tr>
<td width="10%">{{ $a }}</td>
<td width="60%">{{ $addon->addon }}</td>
<td width="15%">{{ $addon->qty }}</td>
<td width="15%">{{ $c.$addon->price }}</td>
</tr>
@endforeach

@endforeach

<tr>
<td width="10%">&nbsp;</td>
<td width="60%">&nbsp;</td>
<td width="15%"><b>@lang('app.ov_sub_total')</b></td>
<td width="15%">{{ $c.array_sum($total) }}</td>
</tr>

@if($data->discount > 0)
<tr>
<td width="10%">&nbsp;</td>
<td width="60%">&nbsp;</td>
<td width="15%"><b>Discount</b></td>
<td width="15%">{{ $c.$data->discount }}</td>
</tr>
@endif

@if($data->d_charges > 0)
<tr>
<td width="10%">&nbsp;</td>
<td width="60%">&nbsp;</td>
<td width="15%"><b>@lang('app.ov_delivery_charges')</b></td>
<td width="15%">{{ $c.$data->d_charges }}</td>
</tr>
@endif

<tr>
<td width="10%">&nbsp;</td>
<td width="60%">&nbsp;</td>
<td width="15%"><b>@lang('app.ov_grand_total')</b></td>
<td width="15%">{{ $c.$data->total }}</td>
</tr>

<tr>
<td width="10%">&nbsp;</td>
<td width="60%">&nbsp;</td>
<td width="15%"><b>Payment Method</b></td>
<td width="15%">

@if($data->payment_method == 1)

Cash on Delivery

@elseif($data->payment_method == 2 || $data->payment_method == 3)

Online Paid

@endif

@if($data->total == $data->ecash)
Paid with eCash
@elseif($data->ecash > 0)
<p>eCash Paid {{ $data->ecash }}</p>
<p>Payable Balance {{ $data->total - $data->ecash }}</p>
@endif

</td>
</tr>

</table>

</td>
</tr>

</table>

@endif