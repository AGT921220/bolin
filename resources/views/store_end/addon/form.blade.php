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
<label for="inputEmail6">@lang('app.category')</label>
<select name="cate_id" class="form-control" required="required">
<option value="">@lang('app.select')</option>
@foreach($cates as $cate)
<option value="{{ $cate->id }}" @if($data->cate_id == $cate->id) selected @endif>{{ $cate->name }}</option>
@endforeach
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.name')</label>
{!! Form::text('name',null,['required' => 'required','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.item_price')</label>
{!! Form::text('price',null,['class' => 'form-control'])!!}
</div>
</div>


</div>
</div>
<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>


</div>
</div>