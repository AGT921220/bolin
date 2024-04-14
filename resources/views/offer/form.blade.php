<div class="card-content">
<div class="card-body">

@include('language.header')
<div class="tab-content">
@foreach(DB::table('language')->where('status',0)->orderBy('sort_no','ASC')->get() as $l)
<div class="tab-pane" id="tabs_{{ $l->id }}" aria-labelledby="home-tab" role="tabpanel">

<input type="hidden" name="lid[]" value="{{ $l->id }}">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.desc')</label>
{!! Form::text('l_desc[]',$data->getSData($data->s_data,$l->id,'l_desc'),['id' => 'code','class' => 'form-control'])!!}
</div>
</div>


</div>
@endforeach

<div class="tab-pane active" id="tabs_0" aria-labelledby="home-tab" role="tabpanel">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.code')</label>
{!! Form::text('code',null,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.desc')</label>
{!! Form::text('description',null,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.min_cart')</label>
{!! Form::number('min_cart_value',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.d_type')</label>
<select name="type" class="form-control">
	<option value="0" @if($data->type == 0) selected @endif>@lang('app.per')</option>
	<option value="1" @if($data->type == 1) selected @endif>@lang('app.fix')</option>
</select>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.value')</label>
{!! Form::number('value',null,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.upto')</label>
{!! Form::number('upto',null,['id' => 'code','class' => 'form-control',])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.discount_type')</label>
<select name="discount_type" class="form-control">
<option value="0" @if($data->discount_type == 0) selected @endif>@lang('app.inst_discount')</option>
<option value="1" @if($data->discount_type == 1) selected @endif>@lang('app.cashback')</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.select_store')</label>
<select name="store_id[]" class="form-control select2" multiple="true">
<option value="all">@lang('app.all_store')</option>
@foreach($store as $s)
<option value="{{ $s->id }}" @if(in_array($s->id,$array)) selected @endif>{{ $s->name }}</option>
@endforeach
</select>
</div>

</div>
</div>
<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>


</div>
</div>