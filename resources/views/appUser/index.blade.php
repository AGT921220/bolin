@extends('layout.main')

@section('title') @lang('app.app_user') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.app_user')</h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.name')</th>
<th>@lang('app.phone')</th>
<th>@lang('app.email')</th>
<th>@lang('app.reg_date')</th>
<th>@lang('app.total_order')</th>
<th>@lang('app.wallet')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="17%">{{ $row->name }}</td>
<td width="17%">{{ $row->phone }}</td>
<td width="17%">{{ $row->email }}</td>
<td width="20%">{{ date('Y-m-d',strtotime($row->created_at)) }} - {{ date('h:i:A',strtotime($row->created_at)) }}</td>
<td width="15%">{{ $row->totalOrder($row->id) }}</td>
<td width="17%">
<a data-toggle="modal" data-placement="top" data-original-title="Add Addons" href="javascript::void()" data-target="#wallet{{ $row->id }}">
<div class="chip chip-success mr-1">
<div class="chip-body">
<span class="chip-text">&nbsp;&nbsp;{{ $row->wallet }}</span>
</div>
</div>
</a>
</td>
</tr>

@include('appUser.wallet')

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

@endsection