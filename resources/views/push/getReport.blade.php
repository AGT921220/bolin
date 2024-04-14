<title>@lang('app.getr_report')</title>

@if(isset($_GET['from']))

<h1 align="center">From {{ $_GET['from'] }} To {{ $_GET['to'] }}</h1>

@endif

<style type="text/css">

td
{
	padding: 10px 10px;
}

</style>

<table width="100%" cellspacing="0" cellpadding="0" border="1">
	
<tr>
<th>@lang('app.getr_s_n')</th>
<th>@lang('app.getr_order_id')</th>
<th>@lang('app.getr_store')</th>
<th>@lang('app.getr_user')</th>
<th>@lang('app.getr_phone')</th>
<th>@lang('app.getr_date')</th>
<th>@lang('app.getr_order_amt')</th>
<th>Admin Fee</th>
</tr>
@php($i = 0)
@php($total = [])
@php($fee = [])
@foreach($data as $row)
@php($total[] = $row['amount'])
@php($fee[] = $row['fee'])
@php($i++)
<tr>
<td width="5%">{{ $i }}</td>
<td width="8%">{{ $row['id'] }}</td>
<td width="12%">{{ $row['store'] }}</td>
<td width="12%">{{ $row['user'] }}</td>
<td width="15%">{{ $row['phone'] }}</td>
<td width="15%">{{ date('d-M-Y',strtotime($row['date'])) }}<br>

<small style="color:red">Deliver by {{ $row['dboy'] }}</small>

</td>
<td width="15%">{{ $c.$row['amount'] }}</td>
<td width="10%">{{ $c.$row['fee'] }}</td>
</tr>
@endforeach
<tr>
<td width="5%">&nbsp;</td>
<td width="8%">&nbsp;</td>
<td width="12%">&nbsp;</td>
<td width="12%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="15%"><b>{{ $c.array_sum($total) }}</b></td>
<td width="10%">{{ $c.array_sum($fee) }}</td>
</tr>
</table>
</table>