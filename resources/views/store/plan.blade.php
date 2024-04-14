<div class="modal fade text-left" id="assign{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header bg-primary">
<h4 class="modal-title" id="myModalLabel33">@lang('app.sub_plan') - {{ $row->name }}</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

@if(count($storePlan->getAll($row->id)) > 0)
<h4> @lang('app.assign_plan')</h4>

<div class="row" style="border:1px solid #ccc;padding: 10px 10px">
<div class="col-xl-3"><b>@lang('app.plan')</b></div>
<div class="col-xl-2"><b>@lang('app.price')</b></div>
<div class="col-xl-2"><b>@lang('app.time_period')</b></div>
<div class="col-xl-2"><b>@lang('app.valid_till')</b></div>
<div class="col-xl-3"><b>@lang('app.payment_method')</b></div>
</div>

@foreach($storePlan->getAll($row->id) as $splan)

<div class="row" style="border:1px solid #ccc;padding: 10px 10px">
<div class="col-xl-3">{{ $splan['plan'] }}</div>
<div class="col-xl-2">{{ $splan['price'] }}</div>
<div class="col-xl-2">{{ $splan['time'] }}</div>
<div class="col-xl-2">{{ $splan['valid'] }}</div>
<div class="col-xl-3">

@if($splan['status'] == 0 || $splan['payment'] == 0)

<select name="mm" class="form-control" onchange="paid(this.value,{{ $splan['id'] }})">
<option value="0">@lang('app.payment_pending')</option>
<option value="1">@lang('app.via_cash')</option>
<option value="3">@lang('app.via_bank')</option>
</select>

@else
{{ $splan['payment'] }}
@endif

</div>
</div>

@endforeach

@else
<h4 style="color:red">@lang('app.no_plan')</h4>
@endif


<div style="margin-top: 10%">
<h4>@lang('app.assign_plan')</h4>

<form action="{{ Asset('storePlan') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
{{ csrf_field() }}

<input type="hidden" name="id" value="{{ $row->id }}">

<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.sub_plan')</label>
<select name="plan_id" class="form-control" required="required">
<option value="">@lang('app.select')</option>
@foreach($plan as $pl)
<option value="{{ $pl->id }}">{{ $pl->name }} - {{ $pl->valid_value }} {{ $pl->getValidType($pl->valid_type) }} - {{ Auth::user()->currency.$pl->price }}</option>
@endforeach
</select>
</fieldset>
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">&nbsp;</label>
<button type="submit" class="btn btn-primary" style="margin-top: 20px">@lang('app.assign')</button>
</div>
</form>
</div>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
