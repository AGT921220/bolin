@extends('store_end.layout.main')

@section('title') @lang('app.order_manage_order') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.order_manage_order')</h4> </div>
<div class="table-responsive">

@include('store_end.order.table')

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection