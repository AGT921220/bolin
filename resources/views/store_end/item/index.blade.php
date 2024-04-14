@extends('store_end.layout.main')

@section('title') @lang('app.product') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.product')

@if($hasItem['item'])
<a href="{{ Asset($link.'add') }}" class="btn btn-primary" style="float: right">@lang('app.add_new')</a>

@else

<span style="font-size: 14px;color:red;float: right">@lang('app.no_limit')</span>

@endif

</h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.image')</th>
<th>@lang('app.category')</th>
<th>@lang('app.item_name')</th>
<th>@lang('app.status')</th>
<th>Stock</th>
<th class="text-right">@lang('app.option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="10%">@if($row->img) <img src="{{ Asset('upload/item/'.$row->img) }}" height="50"> @endif</td>
<td width="17%">{{ $row->cate }}</td>
<td width="18%">{{ $row->name }}</td>
<td width="15%">

<a href="{{ Asset('itemStatus?id='.$row->id) }}" onclick="return confirm('Are you sure?')">
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
<td width="15%">@if($row->inv == 1) {{ $row->getStock($row->id) }} @else --- @endif</td>
<td width="25%" class="text-right">

@if($row->inv == 1)
<a class="btn btn-icon btn-dark mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-placement="top" data-original-title="Add Stock" href="javascript::void()" data-target="#inv{{ $row->id }}"><i class="fa fa-plus"></i></a>

@endif

<a class="btn btn-icon btn-warning mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-placement="top" data-original-title="Add Addons" href="javascript::void()" data-target="#addon{{ $row->id }}"><i class="fa fa-link"></i></a>

<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.edit')" href="{{ Asset($link.$row->id.'/edit') }}"><i class="feather icon-edit"></i></a>

<a type="button" class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.delete')" onclick="confirmAlert('{{ Asset($link.'delete/'.$row->id) }}')"><i class="feather icon-trash-2"></i></a>

</td>
</tr>

@include('store_end.item.addon')

@if($row->inv == 1)
@include('store_end.item.inv')
@endif

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