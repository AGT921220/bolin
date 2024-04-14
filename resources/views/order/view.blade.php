<title>@lang('app.view_order_detail')</title>

<style type="text/css">
td
{
	padding:10px 10px;
}
</style>

<h1 align="center">@lang('app.view_order_no') #{{ $data->id }}</h1>
<table width="60%" cellpadding="0" cellspacing="0" border="1" align="center">
<tr>
<td width="40%"><b>@lang('app.view_store')</b></td>
<td width="60%">{{ $data->store }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.view_user')</b></td>
<td width="60%">{{ $data->name }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.view_phone')</b></td>
<td width="60%">{{ $data->name }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.view_address')</b></td>
<td width="60%">{{ $data->address }}</td>
</tr>

<tr>
<td width="40%"><b>@lang('app.view_order_date')</b></td>
<td width="60%">{{ date('d-M-Y h:i:A',strtotime($data->created_at)) }}</td>
</tr>

@if($data->odate == 2)

<tr>
<td width="40%"><b>Delivery Date</b></td>
<td width="60%">{{ date('d-M-Y',strtotime($data->order_date)) }} | {{ $data->order_time }}</td>
</tr>

@endif

</table>

<br><br>
<b style="margin-left: 20%;">@lang('app.view_order_items')</b>
<br><br>
<table width="60%" cellpadding="0" cellspacing="0" border="1" align="center">
<tr>
<td width="15%"><b>@lang('app.view_s_no')</b></td>
<td width="40%"><b>@lang('app.view_item')</b></td>
<td width="15%"><b>@lang('app.view_price')</b></td>
<td width="15%"><b>@lang('app.view_qty')</b></td>
<td width="15%"><b>@lang('app.view_total')</b></td>
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
@php($total[] = $addon->price * 1)
<tr>
<td width="15%">{{ $a }}</td>
<td width="40%">{{ $addon->name }}</td>
<td width="15%">{{ $c.$addon->price }}</td>
<td width="15%">1</td>
<td width="15%">{{ $c.$addon->price * 1 }}</td>
</tr>
@endforeach

@endforeach

<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.view_sub_total')</b></td>
<td width="15%">{{ $c.array_sum($total) }}</td>
</tr>

@if($data->discount > 0)
<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.view_discount')</b></td>
<td width="15%">{{ $c.$data->discount }}</td>
</tr>
@endif

@if($data->tax_value > 0)
<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>{{ $data->tax_name }}</b></td>
<td width="15%">{{ $c.$data->tax_value }}</td>
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

<tr>
<td width="15%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>@lang('app.view_grand_total')</b></td>
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
@else
<p>eCash Paid {{ $data->ecash }}</p>
<p>Payable Balance {{ $data->total - $data->ecash }}</p>
@endif

</td>
</tr>

</table>