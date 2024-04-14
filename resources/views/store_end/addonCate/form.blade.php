<div class="card-content">
<div class="card-body">

@include('language.header')
<div class="tab-content">
@foreach(DB::table('language')->where('status',0)->orderBy('sort_no','ASC')->get() as $l)
<div class="tab-pane" id="tabs_{{ $l->id }}" aria-labelledby="home-tab" role="tabpanel">

<input type="hidden" name="lid[]" value="{{ $l->id }}">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.name')</label>
{!! Form::text('l_name[]',$data->getSData($data->s_data,$l->id,'l_name'),['id' => 'code','class' => 'form-control'])!!}
</div>
</div>


</div>
@endforeach

<div class="tab-pane active" id="tabs_0" aria-labelledby="home-tab" role="tabpanel">
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.name')</label>
{!! Form::text('name',null,['id' => 'code','placeholder' => 'Name','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.status')</label>
<select name="status" class="form-control">
	<option value="0" @if($data->status == 0) selected @endif>Active</option>
	<option value="1" @if($data->status == 1) selected @endif>Disbaled</option>
</select>
</div>
</div>

<div class="row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.type')</label>
<select name="type" class="form-control">
	<option value="0" @if($data->type == 0) selected @endif>@lang('app.multiple') </option>
	<option value="1" @if($data->type == 1) selected @endif>@lang('app.only')</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.required')</label>
<select name="req" class="form-control">
	<option value="0" @if($data->req == 0) selected @endif>No</option>
	<option value="1" @if($data->req == 1) selected @endif>Yes</option>
</select>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.sort_order')</label>
{!! Form::number('sort_order',null,['id' => 'code','placeholder' => 'Name','class' => 'form-control'])!!}
</div>
</div>
</div>
<button type="submit" class="btn btn-success btn-cta">@lang('app.save')</button>
</div>
</div>