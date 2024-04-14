<div class="card-content">
<div class="card-body">

@include('language.header')
<div class="tab-content">
@foreach(DB::table('language')->where('status',0)->orderBy('sort_no','ASC')->get() as $l)
<div class="tab-pane" id="tabs_{{ $l->id }}" aria-labelledby="home-tab" role="tabpanel">

<input type="hidden" name="lid[]" value="{{ $l->id }}">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_name')</label>
{!! Form::text('l_name[]',$data->getSData($data->s_data,$l->id,0),['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_desc')</label>
{!! Form::text('l_desc[]',$data->getSData($data->s_data,$l->id,1),['id' => 'code','class' => 'form-control'])!!}
</div>
</div>


</div>
@endforeach

<div class="tab-pane active" id="tabs_0" aria-labelledby="home-tab" role="tabpanel">
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.select_cate')</label>
<select name="category_id" class="form-control" required="required">
<option value="">@lang('app.select')</option>
@foreach($cates as $cate)
<option value="{{ $cate->id }}" @if($cate->id == $data->category_id) selected @endif>{{ $cate->name }}</option>
@endforeach
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_name')</label>
{!! Form::text('name',null,['required' => 'required','class' => 'form-control',])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_desc')</label>
{!! Form::text('description',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.sort_order')</label>
{!! Form::text('sort_no',null,['id' => 'code','class' => 'form-control'])!!}
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
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.image')</label>
<input type="file" name="img" class="form-control">
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_mrp')</label>
{!! Form::text('mrp',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">Manage Inventory</label>
<select name="inv" class="form-control">
<option value="0" @if($data->inv == 0) selected @endif>No</option>
<option value="1" @if($data->inv == 1) selected @endif>Yes</option>
</select>
</div>
</div>

<h4>@lang('app.price_title')</h4>

<!--Small Price-->
<div class="row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.select_unit')</label>
<select name="unit1" class="form-control">
<option value="">@lang('app.select')</option>
@foreach($units as $unit)
<option value="{{ $unit }}" @if($data->unit1 == $unit) selected @endif>{{ $unit }}</option>
@endforeach
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_price')</label>
{!! Form::text('small_price',null,['id' => 'code','class' => 'form-control'])!!}
</div>
</div>

<!--Medium Price-->
<div class="row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.select_unit')</label>
<select name="unit2" class="form-control">
<option value="">@lang('app.select')</option>
@foreach($units as $unit)
<option value="{{ $unit }}" @if($data->unit2 == $unit) selected @endif>{{ $unit }}</option>
@endforeach
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_price')</label>
{!! Form::text('medium_price',null,['id' => 'code','class' => 'form-control'])!!}
</div>
</div>

<!--Large Price-->
<div class="row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.select_unit')</label>
<select name="unit3" class="form-control">
<option value="">@lang('app.select')</option>
@foreach($units as $unit)
<option value="{{ $unit }}" @if($data->unit3 == $unit) selected @endif>{{ $unit }}</option>
@endforeach
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_price')</label>
{!! Form::text('large_price',null,['id' => 'code','class' => 'form-control'])!!}
</div>
</div>

</div>
</div>


<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>

</div>
</div>