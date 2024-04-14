@extends('layout.main')

@section('title') @lang('app.sub_plan') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.sub_plan') <a href="{{ Asset($link.'add') }}" class="btn btn-primary" style="float: right">@lang('app.add_new')</a></h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.name')</th>
<th>@lang('app.price')</th>
<th>@lang('app.time_period') </th>
<th>@lang('app.item_limit') </th>
<th>POS</th>
<th>@lang('app.status')</th>
<th class="text-right">@lang('app.option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="15%">{{ $row->name }}</td>
<td width="10%">{{ Auth::user()->currency }}{{ $row->price }}</td>
<td width="10%"> {{ $row->valid_value }} {{ $row->getValidType($row->valid_type) }}</td>
<td width="10%">@if($row->item_limit == 0) Unlimted @else {{ $row->item_limit }} @endif</td>
<td width="10%">@if($row->pos == 0) Yes @else <span style="color:red">No</span> @endif</td>
<td width="14%">

<a href="{{ Asset('plan/status/'.$row->id) }}" onclick="return confirm('Are you sure?')">
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

</td>
<td width="16%" class="text-right">

<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.edit')" href="{{ Asset($link.$row->id.'/edit') }}"><i class="feather icon-edit"></i></a>

<a type="button" class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.delete')" onclick="confirmAlert('{{ Asset($link.'delete/'.$row->id) }}')"><i class="feather icon-trash-2"></i></a>

</td>
</tr>
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