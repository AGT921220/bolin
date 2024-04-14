@extends('layout.main')

@section('title') @lang('app.fiance') @endsection

@section('content')

<section id="basic-input">

<h2> @lang('app.overall_income')</h2><br>

<div class="row" >
<div class="col-lg-4" >
<div class="card" style="padding: 10px 0px">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-money fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h3 class="text-bold-700 mt-1">@lang('app.order_income')</h3>
<p class="mb-0" style="font-size: 20px">{{ Auth::user()->currency.$data['com'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>

<div class="col-lg-4" >
<div class="card" style="padding: 10px 0px">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-credit-card-alt fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h3 class="text-bold-700 mt-1">@lang('app.sub_income')</h3>
<p class="mb-0" style="font-size: 20px">{{ Auth::user()->currency.$data['plan'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>

<div class="col-lg-4" >
<div class="card" style="padding: 10px 0px">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-money fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h3 class="text-bold-700 mt-1">@lang('app.total_income')</h3>
<p class="mb-0" style="font-size: 20px">{{ Auth::user()->currency.$data['total'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>

</div>

<br><hr><br>
<h2>@lang('app.income_month') <span style="font-size: 18px">(1 {{ date('M') }} @lang('app.to') {{ date('d M') }})</span></h2><br>

<div class="row" >
<div class="col-lg-4" >
<div class="card" style="padding: 10px 0px">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-money fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h3 class="text-bold-700 mt-1">@lang('app.order_income')</h3>
<p class="mb-0" style="font-size: 20px">{{ Auth::user()->currency.$month['com'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>

<div class="col-lg-4" >
<div class="card" style="padding: 10px 0px">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-credit-card-alt fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h3 class="text-bold-700 mt-1">@lang('app.sub_income')</h3>
<p class="mb-0" style="font-size: 20px">{{ Auth::user()->currency.$month['plan'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>

<div class="col-lg-4" >
<div class="card" style="padding: 10px 0px">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-money fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h3 class="text-bold-700 mt-1">@lang('app.total_income')</h3>
<p class="mb-0" style="font-size: 20px">{{ Auth::user()->currency.$month['total'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>

</div>

<br><hr><br>
<h2> @lang('app.sub_expiry')</h2><br>
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.store')</th>
<th>@lang('app.plan')</th>
<th>@lang('app.price')</th>
<th>@lang('app.valid_till')</th>
<th class="text-right">@lang('app.option')</th>
</tr>

@foreach($store as $row)

<tr>
<td width="20%">{{ $row->store }}</td>
<td width="20%">{{ $row->plan }}</td>
<td width="15%">{{ Auth::user()->currency.$row->price }}</td>
<td width="25%">{{ date('d-M-Y',strtotime($row->valid_till)) }}

@if($row->last_notify)
<br>
<small style="color:red">Last Notify on @lang('app.last_notify') {{ $row->last_notify }}</small>
@endif

</td>
<td width="20%" class="text-right">

<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.send_alert')" href="{{ Asset('sendAlert?pid='.$row->id.'&id='.$row->store_id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-bell"></i></a>

<a class="btn btn-icon btn-dark mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-placement="top" data-original-title="Add Addons" href="javascript::void()" data-target="#assign{{ $row->store_id }}"><i class="fa fa-link"></i></a>

</td>
</tr>

@include('store.plan',['row' => DB::table('store')->where('id',$row->store_id)->first()])

@endforeach

</thead>
<tbody>
</tbody>
</table>
</div>
</div>
</div>
</section>

@endsection