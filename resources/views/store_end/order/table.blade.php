<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.order_id')</th>
<th>@lang('app.order_store')</th>
<th>@lang('app.order_user')</th>
<th>@lang('app.order_phone')</th>
<th>@lang('app.order_address')</th>
<th>@lang('app.order_tamount')</th>
<th class="text-right">@lang('app.option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="10%">{{ $row->id }}</td>

<td width="15%"><a href="{{ Asset(env('store').'/getReport?id='.$row->store_id) }}" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="View all orders from {{ $row->store }}">{{ $row->store }}</a>

<br>
@if($row->status == 0)

<small style="color:blue">@lang('app.new_order')</small>

@elseif($row->status == 1)

<small style="color:green">@lang('app.order_confirm')</small>

@elseif($row->status == 2)

<small style="color:red">@lang('app.order_cancel')</small>

@elseif($row->status == 3)

<small style="color:red">@lang('app.delivery_assign')</small>

@elseif($row->status == 4)

<small style="color:blue">@lang('app.on_the_way')</small>

@elseif($row->status == 5)

<small style="color:red">@lang('app.completed')</small>

@endif

</td>
<td width="12%">{{ $row->name }}<br>

@if($row->otype == 1)
<small style="color:red">Delivery</small>
@else
<small style="color:green">Pickup/Dinein</small>
@endif
</td>
<td width="12%">{{ $row->phone }}</td>
<td width="18%">{{ $row->address }}

<br><small style="color:green">{{ date('d-M-Y h:i:A',strtotime($row->created_at)) }}</small>

@if($row->odate == 2)

<br><small style="color:red">Delivery Date : {{ date('d-M-Y',strtotime($row->order_date)) }} | {{ $row->order_time }}</small>

@endif

</td>
<td width="10%">{{ $c }}{{ $row->total }}</td>

<td width="25%" class="text-right">
@include('store_end.order.button')
<br>
</td>
</tr>
@endforeach

</tbody>
</table>