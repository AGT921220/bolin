@extends('layout.main')

@section('title') @lang('app.report') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
{{-- <h4 class="card-title">@lang('app.deposit_title')</h4> --}}
<h4 class="card-title">Depositos</h4>

</div>


<div class="card-content">
<div class="card-body">


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
