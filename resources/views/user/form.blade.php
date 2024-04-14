<div class="card-content">
<div class="card-body">


<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.u_name')</label>
{!! Form::text('name',$data->name,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.u_phone')</label>
{!! Form::number('phone',$data->phone,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.u_whatsapp')</label>
{!! Form::text('whatsapp_no',$data->whatsapp_no,['id' => 'code','class' => 'form-control'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.b_email')</label>
{!! Form::email('email',$data->email,['id' => 'code','class' => 'form-control','required' => 'required'])!!}
</div>

<div class="form-group col-md-6">
<label for="inputEmail6">@lang('app.s_change_password')</label>
<input type="password" name="password" class="form-control">
</div>
</div>

<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>


</div>
</div>