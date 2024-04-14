<a class="btn btn-icon btn-info mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.order_vdetail')" href="{{ Asset('orderView?id='.$row->id) }}" target="_blank"><i class="fa fa-eye"></i></a>


@if($row->status == 0)

<a class="btn btn-icon btn-success mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.confirm_order')" href="{{ Asset('orderStatus?status=1&id='.$row->id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-check"></i></a>

<a class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.cancel_order')" href="{{ Asset('orderStatus?status=2&id='.$row->id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-times"></i></a>

@elseif($row->status == 1)

@if($row->delivery_by == 0 && $row->type == 1)
<a class="btn btn-icon btn-dark mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-placement="top" data-original-title="Add Addons" href="javascript::void()" data-target="#assign{{ $row->id }}"><i class="fa fa-link"></i></a>

@include('order.assign')

@endif

@elseif($row->status == 3 || $row->status == 4 || $row->type != 1)

<a class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top" data-original-title="@lang('app.complete_order')" href="{{ Asset('orderStatus?status=5&id='.$row->id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-check"></i></a>

@endif