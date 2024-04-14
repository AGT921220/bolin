@extends('layout.main')

@section('title') @lang('app.setting') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<form action="{{ $form_url }}" method="post">

<div class="card">
<div class="card-content">
<div class="card-body">

<h4 class="card-title">@lang('app.setting')</h4>

{{ csrf_field() }}

<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_name')</label>
<input type="text" class="form-control" id="basicInput" value="{{ $data->name }}" required="required" name="name">
</fieldset>
</div>
<div class="col-xl-6">
<fieldset class="form-group">
<label for="helpInputTop">@lang('app.s_email')</label>
<input type="email" class="form-control" id="helpInputTop" value="{{ $data->email }}" required="required" name="email">
</fieldset>
</div>
<div class="col-xl-6">
<fieldset class="form-group">
<label for="disabledInput">@lang('app.s_username')</label>
<input type="text" class="form-control" required="required" value="{{ $data->username }}" name="username">
</fieldset>
</div>
</div>
</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<h4 class="card-title">@lang('app.s_app_setting')</h4>

<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_app_lang')</label>
<select name="lang" class="form-control">
<option value="">@lang('app.s_select')</option>
<option value="0" @if($data->lang == 0) selected @endif>English</option>
@foreach($lang as $l)
<option value="{{ $l->id }}" @if($data->lang == $l->id) selected @endif>{{ $l->name }}</option>
@endforeach
</select>
</fieldset>
</div>

<div class="col-xl-3">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_currency')</label>
<input type="text" name="currency" class="form-control" value="{{ $data->currency }}">
</fieldset>
</div>

<div class="col-xl-3">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_currency_code')</label>
<input type="text" name="currency_code" class="form-control" value="{{ $data->currency_code }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.web_app_url')</label>
<input type="text" name="web_app" class="form-control" value="{{ $data->web_app }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.refral')</label>
<input type="text" name="point_who" class="form-control" value="{{ $data->point_who }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.ref_point')</label>
<input type="text" name="point_use" class="form-control" value="{{ $data->point_use }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">Terms & Condition URL</label>
<input type="text" name="term" class="form-control" value="{{ $data->term }}">
</fieldset>
</div>

<div class="col-xl-12">
<fieldset class="form-group">
<label for="basicInput">Bank Transfer Detail</label>
<textarea name="bank_transfer" class="form-control">{!! $data->bank_transfer !!}</textarea>
</fieldset>
</div>
</div>

</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<h4 class="card-title">@lang('app.s_payment_api') <small style="font-size: 12px;float: right">@lang('app.s_api_msg')</small></h4>

<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_pay_clinic')</label>
<select name="cod" class="form-control">
<option value="">@lang('app.s_select')</option>
<option value="0" @if($data->cod == 0) selected @endif>Yes</option>
<option value="1" @if($data->cod == 1) selected @endif>No</option>
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

<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">Paypal ID</label>
<input type="text" name="paypal_id" class="form-control" value="{{ $data->paypal_id }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">PayStack ID</label>
<input type="text" name="paystack_id" class="form-control" value="{{ $data->paystack_id }}">
</fieldset>
</div>
</div>

</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<h4 class="card-title">@lang('app.s_push_api') <small style="font-size: 12px;float: right">@lang('app.s_push_get') <a href="https://onesignal.com/" target="_blank">from here</a></small></h4>

<b>@lang('app.user_app')</b>

<div class="row">
<div class="col-xl-4">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_app_api')</label>
<input type="text" name="push_app_id" class="form-control" value="{{ $data->push_app_id }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_rest_api')</label>
<input type="text" name="push_rest_api" class="form-control" value="{{ $data->push_rest_api }}">
</fieldset>
</div>

<div class="col-xl-2">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_google_api')</label>
<input type="text" name="push_google" class="form-control" value="{{ $data->push_google }}">
</fieldset>
</div>
</div>

<b>@lang('app.delivery_app')</b>

<div class="row">
<div class="col-xl-4">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_app_api')</label>
<input type="text" name="d_push_app_id" class="form-control" value="{{ $data->d_push_app_id }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_rest_api')</label>
<input type="text" name="d_push_rest_api" class="form-control" value="{{ $data->d_push_rest_api }}">
</fieldset>
</div>

<div class="col-xl-2">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_google_api')</label>
<input type="text" name="d_push_google" class="form-control" value="{{ $data->d_push_google }}">
</fieldset>
</div>
</div>

<b>@lang('app.store_app')</b>

<div class="row">
<div class="col-xl-4">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_app_api')</label>
<input type="text" name="s_push_app_id" class="form-control" value="{{ $data->s_push_app_id }}">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_rest_api')</label>
<input type="text" name="s_push_rest_api" class="form-control" value="{{ $data->s_push_rest_api }}">
</fieldset>
</div>

<div class="col-xl-2">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_push_google_api')</label>
<input type="text" name="s_push_google" class="form-control" value="{{ $data->s_push_google }}">
</fieldset>
</div>
</div>

</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<h4 class="card-title">@lang('app.s_choose_password')</h4>


<div class="row">
<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_current_password') <small>(@lang('app.s_save_msg'))</small></label>
<input type="password" class="form-control" required="required" name="password">
</fieldset>
</div>

<div class="col-xl-6">
<fieldset class="form-group">
<label for="basicInput">@lang('app.s_change_password') <small>(@lang('app.s_change_pass_msg'))</small></label>
<input type="password" class="form-control" name="new_password">
</fieldset>
</div>
</div>

<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.s_save')</button>
</div>
</div>
</div>
</form>

</div>
</div>
</section>

@endsection