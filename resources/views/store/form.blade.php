<div class="card-content">
<div class="card-body">

@include('language.header')
<div class="tab-content">
@foreach(DB::table('language')->where('status',0)->orderBy('sort_no','ASC')->get() as $l)
<div class="tab-pane" id="tabs_{{ $l->id }}" aria-labelledby="home-tab" role="tabpanel">

<input type="hidden" name="lid[]" value="{{ $l->id }}">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_title')</label>
{!! Form::text('l_name[]',$data->getSData($data->s_data,$l->id,0),['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_address')</label>
{!! Form::text('l_address[]',$data->getSData($data->s_data,$l->id,1),['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">Tax Name</label>
{!! Form::text('l_tax[]',$data->getSData($data->s_data,$l->id,2),['id' => 'code','class' => 'form-control'])!!}
</div>

</div>


</div>
@endforeach

<div class="tab-pane active" id="tabs_0" aria-labelledby="home-tab" role="tabpanel">
<div class="form-row">

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_select_cat')</label>
<select name="cate_id[]" class="form-control select2"  multiple="true">
<option value="">@lang('app.store_select')</option>
@foreach($cates as $cate)
<option value="{{ $cate->id }}" @if(in_array($cate->id,$array)) selected @endif>{{ $cate->name }}</option>
@endforeach
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_title')</label>
{!! Form::text('name',null,['required' => 'required','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">Do Delivery</label>
<select name="delivery" class="form-control">
<option value="0" @if($data->delivery == 0) selected @endif>Yes</option>
<option value="1" @if($data->delivery == 1) selected @endif>No</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">Dinein</label>
<select name="dinein" class="form-control">
<option value="0" @if($data->dinein == 0) selected @endif>Yes</option>
<option value="1" @if($data->dinein == 1) selected @endif>No</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_phone')</label>
{!! Form::text('phone',null,['required' => 'required','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
@if($data->id)
<label for="inputEmail6">@lang('app.store_change_pass')</label>
<input type="password" name="password" class="form-control">
@else
<label for="inputEmail6">@lang('app.store_choose_pass')</label>
<input type="password" name="password" class="form-control">
@endif
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_address')</label>
{!! Form::text('address',null,['required' => 'required','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_whatsapp')</label>
{!! Form::text('whatsapp',null,['required' => 'required','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.new_msg')</label>
<select name="whatsapp_new_order" class="form-control">
<option value="0">@lang('app.yes')</option>
<option value="1">@lang('app.no')</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_main_image')</label>
<input type="file" name="img" class="form-control">
</div>

<div class="form-group col-md-3">
<label for="inputEmail6">@lang('app.store_gal_images')</label>
<input type="file" name="gallery[]" class="form-control" multiple="true">
</div>

<div class="form-group col-md-3">
<label for="inputEmail6">Upload Store Menu Images (Only for dinein)</label>
<input type="file" name="menu[]" class="form-control" multiple="true">
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.store_avg_del_time')</label>
{!! Form::text('delivery_time',null,['class' => 'form-control'])!!}
</div>

<div class="form-group col-md-3">
<label for="inputEmail6">@lang('app.store_avg_ppc')</label>
{!! Form::text('per_person_cost',null,['class' => 'form-control'])!!}
</div>

<div class="form-group col-md-3">
<label for="inputEmail6">@lang('app.can_msg')</label>
<select name="chat" class="form-control">
<option value="0" @if($data->chat == 0) selected @endif>No</option>
<option value="1" @if($data->chat == 1) selected @endif>Yes</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.print_bill')</label>
<select name="print_type" class="form-control">
<option value="0" @if($data->print_type == 0) selected @endif>@lang('app.a4')</option>
<option value="1" @if($data->print_type == 1) selected @endif>@lang('app.thermal')</option>
</select>
</div>

<div class="col-xl-12">
<fieldset class="form-group">
<label for="basicInput">@lang('app.store_units')</label>
<input type="text" name="unit" class="form-control" value="{{ $data->unit }}">
</fieldset>
</div>
</div>

<br>
<h4 class="sep">@lang('app.payment_setting') <small style="font-size: 12px">@lang('app.setting_desc')</small></h4>
<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_pay_clinic')</label>
<select name="cod" class="form-control">
<option value="">@lang('app.s_select')</option>
<option value="1" @if($data->cod == 1) selected @endif>@lang('app.yes')</option>
<option value="2" @if($data->cod == 2) selected @endif>@lang('app.no')</option>
</select>
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_razor_pay')</label>
<input type="text" name="razor_key" class="form-control" value="{{ $data->razor_key }}">
</fieldset>
</div>
</div>

<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_stripe_api')</label>
<input type="text" name="stripe_key" class="form-control" value="{{ $data->stripe_key }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_stripe_sec')</label>
<input type="text" name="stripe_skey" class="form-control" value="{{ $data->stripe_skey }}">
</fieldset>
</div>

</div>

@if(isset($admin))
<br>
<h4 class="sep">@lang('app.commision') <span style="font-size: 12px">@lang('app.com_desc')</span></h4>
<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.com_type')</label>
<select name="com_type" class="form-control">
<option value="0" @if($data->com_type == 0) selected @endif>@lang('app.fix_amount')</option>
<option value="1" @if($data->com_type == 1) selected @endif>@lang('app.in_per')</option>
</select>
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.com_value')</label>
<input type="text" name="com_value" class="form-control" value="{{ $data->com_value }}">
</fieldset>
</div>
</div>
@endif

<br>
<h4 class="sep">@lang('app.delivery_charges')</h4>
<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.delivery_by')</label>
<select name="delivery_by" class="form-control">
<option value="0" @if($data->delivery_by == 0) selected @endif>@lang('app.by_admin')</option>
<option value="1" @if($data->delivery_by == 1) selected @endif>@lang('app.by_store')</option>
</select>
</fieldset>
</div>

<div class="col-xl-3">
<fieldset class="form-group">
<label for="basicInput">@lang('app.km_fix') </label>
<input type="text" name="fix_km" class="form-control" value="{{ $data->fix_km }}">
</fieldset>
</div>

<div class="col-xl-3">
<fieldset class="form-group">
<label for="basicInput">@lang('app.amount_fix') </label>
<input type="text" name="fix_amount" class="form-control" value="{{ $data->fix_amount }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.amount_per_km') </label>
<input type="text" name="per_km" class="form-control" value="{{ $data->per_km }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.max_area')  <small style="color:red">@lang('app.max_area_desc') </small></label>
<input type="text" name="max_km" class="form-control" value="{{ $data->max_km }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">Tax Name</label>
<input type="text" name="tax_name" class="form-control" value="{{ $data->tax_name }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">Tax Value in %</label>
<input type="text" name="tax_value" class="form-control" value="{{ $data->tax_value }}">
</fieldset>
</div>

</div>

<br>
<h4 class="sep">@lang('app.geo')</h4>
@include('store.google')


<br>
<h4 class="sep">@lang('app.working_hr')</h4>

@include('store.time')

</div>

<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>

@if(count($images))

<div class="row">
<div class="col-md-12"><b>Gallery Images</b></div>
@foreach($images as $img)

<div class="col-md-2"><img src="{{ Asset('upload/store/gallery/'.$img->img) }}" height="60px"><br>

@if(isset($hasStore))

<a href="{{ Asset(env('store').'/removeImage?id='.$img->id) }}" onclick="return confirm('Are you sure?')" style="color:red">Remove</a>

@else

<a href="{{ Asset('removeImage?id='.$img->id) }}" onclick="return confirm('Are you sure?')" style="color:red">Remove</a>

@endif

</div>

@endforeach

</div>

@endif


@if(count($menu))

<div class="row">
<div class="col-md-12"><b>Menu Images</b></div>
@foreach($menu as $img)

<div class="col-md-2"><img src="{{ Asset('upload/store/menu/'.$img->file) }}" height="60px"><br>

@if(isset($hasStore))

<a href="{{ Asset(env('store').'/removeImage?type=menu&id='.$img->id) }}" onclick="return confirm('Are you sure?')" style="color:red">Remove</a>

@else

<a href="{{ Asset('removeImage?type=menu&id='.$img->id) }}" onclick="return confirm('Are you sure?')" style="color:red">Remove</a>

@endif

</div>

@endforeach

</div>

@endif

</div>
</div>

<style type="text/css">
.sep
{
	color:black;
	font-size: 25px;
	font-weight: bold
}
</style>