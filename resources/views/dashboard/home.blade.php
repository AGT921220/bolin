@extends('layout.main')

@section('title') Dashboard @endsection

@section('content')
<style type="text/css">
.card
{
	padding: 10px 10px;
}
</style>
<section id="dashboard-ecommerce">

<div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="card">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-primary p-50 m-0">
<div class="avatar-content">
<i class="fa fa-user-plus fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h2 class="text-bold-700 mt-1">@lang('app.total_store')</h2>
<p class="mb-0">{{ $data['store'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-1"></div>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="card">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-success p-50 m-0">
<div class="avatar-content">
<i class="fa fa-mobile fa-5" style="color:black;font-size: 20px"></i>
</div>
</div>
<h2 class="text-bold-700 mt-1">@lang('app.app_user')</h2>
<p class="mb-0">{{ $data['user'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-2"></div>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="card">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-danger p-50 m-0">
<div class="avatar-content">
<i class="feather icon-shopping-cart text-danger font-medium-5"></i>
</div>
</div>
<h2 class="text-bold-700 mt-1">@lang('app.total_orders')</h2>
<p class="mb-0">{{ $data['order'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-3"></div>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="card">
<div class="card-header d-flex flex-column align-items-start pb-0">
<div class="avatar bg-rgba-warning p-50 m-0">
<div class="avatar-content">
<i class="fa fa-map-marker fa-5" style="color:black;font-size: 20px"></i>

</div>
</div>
<h2 class="text-bold-700 mt-1">@lang('app.delivery_staff')</h2>
<p class="mb-0">{{ $data['delivery'] }}</p>
</div>
<div class="card-content">
<div id="line-area-chart-4"></div>
</div>
</div>
</div>
</div>

@include('dashboard.chart')

<div class="row">
<div class="col-md-12">
<div class="card">
@include('order.table',['data' => $order,'c' => $c])

</div>

</div>
</div>

</section>



@endsection