<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.lang_name')</label>
{!! Form::text('name',null,['id' => 'code','required' => 'required','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.type')</label>
<select name="type" class="form-control">
	<option value="0" @if($data->type == 0) selected @endif>Left To Right</option>
	<option value="1" @if($data->type == 1) selected @endif>Right To Left</option>
</select>
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.icon') <small>(512x512)</small></label>
<input type="file" name="img" class="form-control">
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.sort_no')</label>
{!! Form::number('sort_no',null,['id' => 'code','class' => 'form-control'])!!}
</div>
</div>


<div class="row">
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

<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>


</div>
</div>