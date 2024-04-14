<div class="modal fade text-left" id="inv{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header bg-primary">
<h4 class="modal-title" id="myModalLabel33">Add New Stock</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ Asset(env('store').'/inv') }}" method="post" enctype="multipart/form-data">
<div class="modal-body">

{{ csrf_field() }}

<input type="hidden" name="id" value="{{ $row->id }}">

<div class="row">
<div class="col-xl-2">
<select name="type" class="form-control">
<option value="0">Add + </option>
<option value="1">Deduct - </option>
</select>
</div>

<div class="col-xl-3">
<input type="number" name="qty" class="form-control" placeholder="Enter Stock Quantity">
</div>

<div class="col-xl-5">
<input type="text" name="notes" class="form-control" placeholder="Any Notes">
</div>

<div class="col-xl-2">
<button type="submit" class="btn btn-primary">@lang('app.save')</button>
</div>
</div>

@if(count($inv->getAll($row->id)) > 0)
<br>
<div class="row" style="padding: 10px 10px;border-bottom: 1px solid #f3f3f3">
<div class="col-xl-2"><b>Date</b></div>
<div class="col-xl-2"><b>Quantity</b></div>
<div class="col-xl-2"><b>Type</b></div>
<div class="col-xl-6"><b>Notes 

<span style="float: right;color:blue">Total Stock Left : {{ $row->getStock($row->id) }}</span>

</b></div>
</div>

@foreach($inv->getAll($row->id) as $row)

<div class="row" style="padding: 10px 10px;border-bottom: 1px solid #f3f3f3">
<div class="col-xl-2">{{ date('d-M-Y',strtotime($row->created_at)) }}</div>
<div class="col-xl-2">{{ $row->qty }}</div>
<div class="col-xl-2">@if($row->type == 0) <span style="color:green">Added</span> @else <span style="color:red">Deducted</span>@endif</div>
<div class="col-xl-6">{{ $row->notes }}</div>
</div>

@endforeach
@endif
</div>

</form>
</div>
</div>
</div>
