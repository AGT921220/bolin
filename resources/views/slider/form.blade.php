<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.image')</label>
<input type="file" name="img" class="form-control" @if(!$data->id) required="required" @endif>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.sort_no')</label>
{!! Form::number('sort_no',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.link_to')</label>
<select name="link_to" class="form-control">
<option value="0" @if($data->link_to == 0) selected @endif>@lang('app.none')</option>
<option value="1" @if($data->link_to == 1) selected @endif>@lang('app.store')</option>
<option value="2" @if($data->link_to == 2) selected @endif>@lang('app.category')</option>
<option value="3" @if($data->link_to == 3) selected @endif>@lang('app.custom')</option>
</select>
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.link_id') <small style="float: right;color:red"> &nbsp;@lang('app.link_desc')</small></label>
{!! Form::number('link_id',null,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.banner_type')</label>
<select name="type" class="form-control">
<option value="0" @if($data->type == 0) selected @endif>@lang('app.slider')</option>
<option value="1" @if($data->type == 1) selected @endif>@lang('app.Static')</option>
</select>
</div>

</div>

<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>

</div>
</div>