@extends('store_end.layout.main')

@section('title') @lang('app.report') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Reporting</h4>
</div>

{!! Form::open(['url' => [Asset('getReport')],'method' => 'GET','target' => '_blank']) !!}

<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">@lang('app.r_from')</label>
<input type="text" name="from" class="form-control pickadate" required="required">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">@lang('app.r_to')</label>
<input type="text" name="to" class="form-control pickadate" required="required">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">@lang('app.dboy')</label>
<select name="dboy" class="form-control">
<option value="">@lang('app.all')</option>
@foreach($dboy as $db)
<option value="{{ $db->id }}">{{ $db->name }}</option>
@endforeach
</select>
</div>
</div>


<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.get_report')</button>


</div>
</div>

</form>
</div>
</div>
</div>
</section>

@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/editors/quill/quill.bubble.css') }}">
<link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">

@endsection

@section('js')
<script src="{{Asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{Asset('app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{Asset('app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{Asset('app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{Asset('app-assets/js/scripts/pages/app-email.js') }}"></script>

<script src="{{Asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{Asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{Asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{Asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{Asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
@endsection