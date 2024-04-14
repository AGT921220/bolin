@extends('layout.main')

@section('title') Add New @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Add New Language</h4>
</div>

{!! Form::model($data, ['url' => [$form_url],'files' => true]) !!}

@include('category.form')

</form>
</div>
</div>
</div>
</section>

@endsection