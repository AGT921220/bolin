@extends('store_end.layout.main')

@section('title') @lang('app.store_user') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.store_user')</h4> </div>
<div class="table-responsive">

<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.user')</th>
<th>@lang('app.phone')</th>
<th>@lang('app.email')</th>
<th>@lang('app.last_order')</th>
<th>@lang('app.total_order')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="20%">{{ $row->name }}</td>
<td width="20%">{{ $row->phone }}</td>
<td width="20%">{{ $row->email }}</td>
<td width="20%">{{ $row->getLastOrder($row->id) }}</td>
<td width="20%">{{ $row->getTotalOrder($row->id) }}</td>
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