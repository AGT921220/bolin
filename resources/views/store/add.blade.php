@extends('layout.main')

@section('title') @lang('app.add_new') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">@lang('app.add_new')</h4>
</div>

{!! Form::model($data, ['url' => [$form_url],'files' => true]) !!}

@include('store.form')

</form>
</div>
</div>
</div>
</section>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('js')
<script src="{{ Asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ Asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
@endsection