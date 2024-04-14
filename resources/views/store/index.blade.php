@extends('layout.main')

@section('title') @lang('app.manage_store') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.manage_store') <a href="{{ Asset($link.'add') }}" class="btn btn-primary" style="float: right">@lang('app.add_new')</a></h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>ID</th>
<th>@lang('app.store_image')</th>
<th>@lang('app.store_name')</th>
<th>@lang('app.store_logins')</th>
<th>@lang('app.status_plan')</th>
<th>@lang('app.type')</th>
<th class="text-right">@lang('app.store_option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="5%">{{ $row->id }}</td>
<td width="5%">@if($row->img) <img src="{{ Asset('upload/store/'.$row->img) }}" height="60px"> @endif</td>
<td width="12%">{{ $row->name }}

@if($row->signup_by)
<br><small style="color:red">@lang('app.from_app')</small>
@endif

</td>
<td width="12%">@lang('app.store_username') {{ $row->phone }}<br><small>@lang('app.store_password') {{ $row->shw_password }}</small></td>
<td width="10%">

<a href="{{ Asset('storeAction?action=status&id='.$row->id) }}" onclick="return confirm('Are you sure?')">
@if($row->status == 0)

<div class="chip chip-success mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.active')</span>
</div>
</div>

@else

<div class="chip chip-danger mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.disbale')</span>
</div>
</div>

@endif
</a>	
@php($checkPlan = $row->checkPlan($row->id))
<a data-toggle="modal" data-placement="top" data-original-title="Add Addons" href="javascript::void()" data-target="#assign{{ $row->id }}">
@if($checkPlan == 0)

<div class="chip chip-danger mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.assign')</span>
</div>
</div>

@elseif($checkPlan == 1)

<div class="chip chip-success mr-1">
<div class="chip-body">
<span class="chip-text">{{ $row->plan }}</span>
</div>
</div>

@elseif($checkPlan == 2)

<div class="chip chip-dark mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.plan_expir')</span>
</div>
</div>

@elseif($checkPlan == 3)

<div class="chip chip-warning mr-1">
<div class="chip-body">
<span class="chip-text">@lang('app.payment_pending')</span>
</div>
</div>

@endif
</a>	

</td>

<td width="10%">
@if($row->delivery == 0) <p>Delivery</p> @endif
@if($row->dinein == 0) <p style="color:green">Dinein</p> @endif
</td>

<td width="28%" class="text-right">

<a class="btn btn-icon btn-warning mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.login_store')" href="{{ Asset('loginAsStore?id='.$row->id) }}" target="_blank"><i class="fa fa-sign-in"></i></a>

<a class="btn btn-icon btn-dark mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.gen_qr')" href="{{ Asset('qr?id='.$row->id) }}" target="_blank"><i class="fa fa-qrcode"></i></a>

<a class="btn btn-icon @if($row->trend == 0) btn-primary @else btn-danger @endif mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@if($row->trend == 1) @lang('app.in_trend') @else @lang('app.make_trend') @endif" href="{{ Asset('storeAction?action=trend&id='.$row->id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-line-chart"></i></a>

<a class="btn btn-icon @if($row->open == 0) btn-success @else btn-danger @endif mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@if($row->open == 0) Store is Open Now @else Store is Closed Now @endif" href="{{ Asset('storeAction?action=open&id='.$row->id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-clock-o"></i></a>

<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.edit')" href="{{ Asset($link.$row->id.'/edit') }}"><i class="feather icon-edit"></i></a>

<a type="button" class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.delete')" onclick="confirmAlert('{{ Asset($link.'delete/'.$row->id) }}')"><i class="feather icon-trash-2"></i></a>

</td>
</tr>

@include('store.plan')

@endforeach

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<script type="text/javascript">

function paid(pay,id)
{
	if(pay > 0)
	{
		window.location.href = "{{ Asset('pay?pay=') }}"+pay+"&id="+id;
	}
}

</script>

@endsection