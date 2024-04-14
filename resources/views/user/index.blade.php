@extends('layout.main')

@section('title') @lang('app.menu_user') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="row" id="table-head">
<div class="col-12">
<div class="card">
<div class="card-content">

<div class="card-body"><h4 class="card-title">@lang('app.user')</h4> </div>
<div class="table-responsive">
<table class="table mb-0">
<thead >
<tr>
<th>@lang('app.u_name')</th>
<th>@lang('app.u_phone')</th>
<th>@lang('app.u_whatsapp')</th>
<th>@lang('app.u_email')</th>
<th>@lang('app.apt')</th>
<th class="text-right">@lang('app.option')</th>
</tr>
</thead>
<tbody>

@foreach($data as $row)
<tr>
<td width="15%"><a href="{{ Asset('getReport?id='.$row->id) }}" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="View all Appointment by this user">{{ $row->name }}</a></td>
<td width="15%">{{ $row->phone }}</td>
<td width="15%">{{ $row->whatsapp_no }}</td>
<td width="15%">{{ $row->email }}<br><small>Password : {{ $row->password }}</small></td>
<td width="15%" style="font-size: 14px">
Today : {{ $row->getBooking($row->id)['today'] }} | 
Total : {{ $row->getBooking($row->id)['total'] }}
</td>
<td width="20%" class="text-right">

<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.edit')" href="{{ Asset('user/edit/'.$row->id) }}"><i class="feather icon-edit"></i></a>

<a type="button" class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.edit')" onclick="confirmAlert('{{ Asset('user/delete/'.$row->id) }}')"><i class="feather icon-trash-2"></i></a>

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