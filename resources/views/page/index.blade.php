@extends('layout.main')

@section('title') @lang('app.page_text') @endsection

@section('content')



<section id="basic-input">
<div class="row">
<div class="col-md-12">
<form action="{{ $form_url }}" method="post" enctype="multipart/form-data">

{!! csrf_field() !!}

<div class="card-content">
<div class="card-body">

@include('language.header')
<div class="tab-content">
@foreach(DB::table('language')->where('status',0)->orderBy('sort_no','ASC')->get() as $l)
<div class="tab-pane" id="tabs_{{ $l->id }}" aria-labelledby="home-tab" role="tabpanel">

<input type="hidden" name="lid[]" value="{{ $l->id }}">

<div class="card">
<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.about_us') <small>(@lang('app.html'))</small></label>
<textarea name="l_about_us[]" class="form-control">{{ $data->getSData($data->s_data,$l->id,0) }}</textarea>
</div>
</div>
</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">
<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.contact_us') <small>(@lang('app.html'))</small></label>
<textarea name="l_contact_us[]" class="form-control">{{ $data->getSData($data->s_data,$l->id,1) }}</textarea>
</div>
</div>
</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">
<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.faq') <small>(@lang('app.html'))</small></label>
<textarea name="l_faq[]" class="form-control">{{ $data->getSData($data->s_data,$l->id,2) }}</textarea>
</div>
</div>
</div>
</div>
</div>

</div>
@endforeach

<div class="tab-pane active" id="tabs_0" aria-labelledby="home-tab" role="tabpanel">

<div class="card">
<div class="card-content">
<div class="card-body">

<h4>@lang('app.about_us')</h4>

<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.about_us') <small>(@lang('app.html'))</small></label>
<textarea name="about_us" class="form-control">{{ $data->about_us }}</textarea>
</div>
</div>


</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.contact_us') <small>(@lang('app.html'))</small></label>
<textarea name="contact_us" class="form-control">{{ $data->contact_us }}</textarea>
</div>
</div>
</div>
</div>
</div>

<div class="card">
<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.faq') <small>(@lang('app.html'))</small></label>
<textarea name="faq" class="form-control">{{ $data->faq }}</textarea>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.save')</button>


</div>
</div>

</form>

</div>
</div>
</section>

@endsection