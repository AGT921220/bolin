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
{!! Form::text('l_name[]',$data->getSData($data->s_data,$l->id,0),['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.desc')</label>
{!! Form::text('l_desc[]',$data->getSData($data->s_data,$l->id,1),['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.feat')</label>
{!! Form::text('l_feat[]',$data->getSData($data->s_data,$l->id,2),['id' => 'code','class' => 'form-control'])!!}
</div>

</div>


</div>
@endforeach

<div class="tab-pane active" id="tabs_0" aria-labelledby="home-tab" role="tabpanel">
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.name')</label>
{!! Form::text('name',null,['id' => 'code','class' => 'form-control','required'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.desc')</label>
{!! Form::text('description',null,['id' => 'code','class' => 'form-control','required'])!!}
</div>

<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.feat')</label>
{!! Form::text('feat',null,['id' => 'code','class' => 'form-control','required'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.plan_price')</label>
{!! Form::text('price',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-3">
<label for="inputEmail6">@lang('app.plan_item')</label>
{!! Form::text('item_limit',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="col-xl-3">
<fieldset class="form-group">
<label for="basicInput">POS</label>
<select name="pos" class="form-control" required="required">
<option value="0" @if($data->pos == 0) selected @endif>Yes</option>
<option value="1" @if($data->pos == 1) selected @endif>No</option>
</select>
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.plan_time_type')</label>
<select name="valid_type" class="form-control" required="required">
<option value="0" @if($data->valid_type == 0) selected @endif>@lang('app.days')</option>
<option value="1" @if($data->valid_type == 1) selected @endif>@lang('app.month')</option>
<option value="2" @if($data->valid_type == 2) selected @endif>@lang('app.year')</option>
</select>
</fieldset>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6"> @lang('app.plan_time_value')</label>
{!! Form::text('valid_value',null,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.sort_no')</label>
{!! Form::number('sort_no',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.status')</label>
<select name="status" class="form-control">
<option value="0" @if($data->status == 0) selected @endif>@lang('app.active')</option>
<option value="1" @if($data->status == 1) selected @endif>@lang('app.disbale')</option>
</select>
</fieldset>
</div>
</div>
</div>
</div>
<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>


</div>
</div>