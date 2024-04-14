@extends('layout.main')

@section('title') @lang('app.coupon') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.coupon') <a href="{{ Asset($link.'add') }}" class="btn btn-primary" style="float: right">@lang('app.add_new')</a></h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.code')</th>
<th>@lang('app.desc')</th>
<th>@lang('app.type')</th>
<th>@lang('app.value')</th>
<th class="text-right">@lang('app.option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="20%">{{ $row->code }}</td>
<td width="20%">{{ $row->description }}</td>
<td width="20%">@if($row->type == 0) in % @else @lang('app.flat_discount') @endif

<br>
@if($row->discount_type == 0)
<span style="color:blue">@lang('app.inst_discount')</span>
@else
<span style="color:red">@lang('app.cashback')</span>
@endif

</td>
<td width="20%">{{ $row->value }}</td>

<td width="20%" class="text-right">

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