@extends('layout.main')

@section('title') @lang('app.home_slider') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.slider') <a href="{{ Asset($link.'add') }}" class="btn btn-primary" style="float: right">@lang('app.add_new')</a></h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.image')</th>
<th>@lang('app.banner_type')</th>
<th>@lang('app.link_to')</th>
<th>@lang('app.status')</th>
<th>@lang('app.option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="20%"><img src="{{ Asset('upload/slider/'.$row->img) }}" width="50px"></td>
<td width="20%">{{ $row->getType($row->type) }}</td>
<td width="20%">{{ $row->getLink($row->link_to) }}</td>
<td width="20%">
<a href="{{ Asset('slider/status/'.$row->id) }}" onclick="return confirm('Are you sure?')">
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
</td>

<td width="20%">

<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Edit Entry" href="{{ Asset($link.$row->id.'/edit') }}"><i class="feather icon-edit"></i></a>

<a type="button" class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="Delete Entry" onclick="confirmAlert('{{ Asset($link.'delete/'.$row->id) }}')"><i class="feather icon-trash-2"></i></a>

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