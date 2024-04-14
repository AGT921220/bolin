@extends('layout.main')

@section('title') @lang('app.edit_form') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">@lang('app.edit_form')</h4>
</div>

{!! Form::open(['url' => [Asset('user/edit/'.$data->id)],'files' => true]) !!}

@include('user.form')

</form>

</div>
</div>
</div>
</section>

@endsection